<?php
/**
 * Tools > Import TSD posts
 * Imports a "tsd-import.zip" bundle (posts.json + images/) prepared from The Social Dust's
 * Instagram posts. Posts are created in small batches so large imports don't time out,
 * and posts already imported (same Instagram ID) are skipped, so running it twice is safe.
 *
 * posts.json: [ { "ig_id", "date" (ISO 8601), "category" (business|tech|youth|sports|health|world),
 *   "title", "title_bn", "bite_en", "bite_bn", "content", "content_bn", "highlight", "highlight_bn",
 *   "source_name", "source_url", "image_credit", "social_url", "tags": [], "image" (file name in images/) } ]
 *
 * @package thesocialdust
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TSD_IMPORT_BATCH', 8 );

function tsd_import_dir() {
	$up = wp_upload_dir();
	return trailingslashit( $up['basedir'] ) . 'tsd-import';
}

function tsd_import_menu() {
	add_management_page( 'Import TSD posts', 'Import TSD posts', 'manage_options', 'tsd-import', 'tsd_import_page' );
}
add_action( 'admin_menu', 'tsd_import_menu' );

/** Find an already-imported post by Instagram ID. */
function tsd_import_exists( $ig_id ) {
	$q = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'any',
			'meta_key'       => 'tsd_ig_id', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'     => $ig_id, // phpcs:ignore WordPress.DB.SlowDBQuery
			'fields'         => 'ids',
			'posts_per_page' => 1,
		)
	);
	return $q ? (int) $q[0] : 0;
}

/** Create one post from a posts.json item. Returns post ID, 0 if skipped, or WP_Error. */
function tsd_import_item( $item, $dir, $status ) {
	$ig_id = sanitize_text_field( $item['ig_id'] ?? '' );
	if ( $ig_id && tsd_import_exists( $ig_id ) ) {
		return 0;
	}
	$cat_ids = array();
	$cat     = get_term_by( 'slug', sanitize_key( $item['category'] ?? 'world' ), 'category' );
	if ( $cat ) {
		$cat_ids[] = $cat->term_id;
	}
	$time = strtotime( $item['date'] ?? '' );
	$post = array(
		'post_type'     => 'post',
		'post_status'   => $status,
		'post_title'    => sanitize_text_field( $item['title'] ?? '' ),
		'post_content'  => wp_kses_post( $item['content'] ?? '' ),
		'post_excerpt'  => sanitize_textarea_field( $item['bite_en'] ?? '' ),
		'post_category' => $cat_ids,
		'tags_input'    => array_map( 'sanitize_text_field', (array) ( $item['tags'] ?? array() ) ),
	);
	if ( $time ) {
		$post['post_date_gmt'] = gmdate( 'Y-m-d H:i:s', $time );
		$post['post_date']     = get_date_from_gmt( $post['post_date_gmt'] );
	}
	$id = wp_insert_post( wp_slash( $post ), true );
	if ( is_wp_error( $id ) ) {
		return $id;
	}

	$meta = array(
		'tsd_title_bn'     => 'text',
		'tsd_bite_en'      => 'textarea',
		'tsd_bite_bn'      => 'textarea',
		'tsd_content_bn'   => 'textarea',
		'tsd_highlight'    => 'text',
		'tsd_highlight_bn' => 'text',
		'tsd_source_name'  => 'text',
		'tsd_source_url'   => 'url',
		'tsd_image_credit' => 'text',
		'tsd_social_url'   => 'url',
	);
	foreach ( $meta as $key => $type ) {
		$field = substr( $key, 4 );
		$val   = $item[ $field ] ?? '';
		if ( '' === $val ) {
			continue;
		}
		$val = 'url' === $type ? esc_url_raw( $val ) : ( 'textarea' === $type ? sanitize_textarea_field( $val ) : sanitize_text_field( $val ) );
		update_post_meta( $id, $key, $val );
	}
	if ( $ig_id ) {
		update_post_meta( $id, 'tsd_ig_id', $ig_id );
	}

	// Featured image.
	$file = isset( $item['image'] ) ? basename( $item['image'] ) : '';
	$path = $file ? trailingslashit( $dir ) . 'images/' . $file : '';
	if ( $path && file_exists( $path ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
		$tmp = wp_tempnam( $file );
		copy( $path, $tmp );
		$att = media_handle_sideload(
			array(
				'name'     => $file,
				'tmp_name' => $tmp,
			),
			$id,
			sanitize_text_field( $item['title'] ?? '' )
		);
		if ( ! is_wp_error( $att ) ) {
			set_post_thumbnail( $id, $att );
			update_post_meta( $att, '_wp_attachment_image_alt', sanitize_text_field( $item['title'] ?? '' ) );
		} elseif ( file_exists( $tmp ) ) {
			wp_delete_file( $tmp );
		}
	}
	return $id;
}

/** Handle the zip upload: unpack into uploads/tsd-import/ and start the batch run. */
function tsd_import_upload() {
	if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'tsd_import_upload' ) ) {
		wp_die( 'Not allowed.' );
	}
	$back = admin_url( 'tools.php?page=tsd-import' );
	if ( empty( $_FILES['bundle']['tmp_name'] ) ) {
		wp_safe_redirect( add_query_arg( 'tsd_err', 'nofile', $back ) );
		exit;
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	WP_Filesystem();
	$dir = tsd_import_dir();
	if ( is_dir( $dir ) ) {
		global $wp_filesystem;
		$wp_filesystem->delete( $dir, true );
	}
	wp_mkdir_p( $dir );
	$res = unzip_file( sanitize_text_field( $_FILES['bundle']['tmp_name'] ), $dir ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	if ( is_wp_error( $res ) ) {
		wp_safe_redirect( add_query_arg( 'tsd_err', 'unzip', $back ) );
		exit;
	}
	// Accept bundles zipped with or without a top-level folder.
	if ( ! file_exists( $dir . '/posts.json' ) ) {
		foreach ( (array) glob( $dir . '/*/posts.json' ) as $found ) {
			$dir = dirname( $found );
			break;
		}
	}
	$items = json_decode( (string) file_get_contents( $dir . '/posts.json' ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! is_array( $items ) ) {
		wp_safe_redirect( add_query_arg( 'tsd_err', 'json', $back ) );
		exit;
	}
	// Oldest first, so the newest post ends up on top of the home page.
	usort(
		$items,
		function ( $a, $b ) {
			return strcmp( $a['date'] ?? '', $b['date'] ?? '' );
		}
	);
	$status = ( isset( $_POST['publish'] ) && 'draft' === $_POST['publish'] ) ? 'draft' : 'publish';
	update_option(
		'tsd_import_job',
		array(
			'dir'      => $dir,
			'items'    => $items,
			'pos'      => 0,
			'status'   => $status,
			'created'  => 0,
			'skipped'  => 0,
			'errors'   => array(),
		),
		false
	);
	wp_safe_redirect( add_query_arg( 'tsd_run', 1, $back ) );
	exit;
}
add_action( 'admin_post_tsd_import_upload', 'tsd_import_upload' );

/** Folder with the Instagram stories that ship inside the theme. */
function tsd_bundled_dir() {
	return get_template_directory() . '/demo-content';
}

function tsd_bundled_count() {
	$file = tsd_bundled_dir() . '/posts.json';
	if ( ! file_exists( $file ) ) {
		return 0;
	}
	$items = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	return is_array( $items ) ? count( $items ) : 0;
}

/** Button handler: queue the bundled stories and start importing them. */
function tsd_import_bundled() {
	if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'tsd_import_bundled' ) ) {
		wp_die( 'Not allowed.' );
	}
	$dir   = tsd_bundled_dir();
	$items = json_decode( (string) file_get_contents( $dir . '/posts.json' ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! is_array( $items ) ) {
		wp_safe_redirect( admin_url( 'tools.php?page=tsd-import&tsd_err=json' ) );
		exit;
	}
	usort(
		$items,
		function ( $a, $b ) {
			return strcmp( $a['date'] ?? '', $b['date'] ?? '' );
		}
	);
	update_option(
		'tsd_import_job',
		array(
			'dir'     => $dir,
			'items'   => $items,
			'pos'     => 0,
			'status'  => 'publish',
			'created' => 0,
			'skipped' => 0,
			'errors'  => array(),
			'bundled' => true,
		),
		false
	);
	wp_safe_redirect( admin_url( 'tools.php?page=tsd-import&tsd_run=1' ) );
	exit;
}
add_action( 'admin_post_tsd_import_bundled', 'tsd_import_bundled' );

function tsd_import_bundled_url() {
	return wp_nonce_url( admin_url( 'admin-post.php?action=tsd_import_bundled' ), 'tsd_import_bundled' );
}

/** After activation, offer the one-click import at the top of every admin page until it's done. */
function tsd_import_bundled_notice() {
	if ( ! current_user_can( 'manage_options' ) || get_option( 'tsd_bundled_imported' ) || get_option( 'tsd_bundled_dismissed' ) ) {
		return;
	}
	if ( isset( $_GET['page'] ) && 'tsd-import' === $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	$n = tsd_bundled_count();
	if ( ! $n ) {
		return;
	}
	$dismiss = wp_nonce_url( admin_url( 'admin-post.php?action=tsd_import_dismiss' ), 'tsd_import_dismiss' );
	echo '<div class="notice notice-info" style="border-left-color:#FFE14D;padding:12px 14px"><p style="font-size:15px;margin:0 0 8px"><strong>The Social Dust:</strong> ' . esc_html( $n ) . ' stories from your Instagram are ready to go on the website.</p>';
	echo '<p style="margin:0"><a class="button button-primary button-hero" href="' . esc_url( tsd_import_bundled_url() ) . '">Import ' . esc_html( $n ) . ' stories now</a> &nbsp; <a href="' . esc_url( $dismiss ) . '">Not now</a></p></div>';
}
add_action( 'admin_notices', 'tsd_import_bundled_notice' );

function tsd_import_dismiss() {
	if ( current_user_can( 'manage_options' ) && check_admin_referer( 'tsd_import_dismiss' ) ) {
		update_option( 'tsd_bundled_dismissed', 1 );
	}
	wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
	exit;
}
add_action( 'admin_post_tsd_import_dismiss', 'tsd_import_dismiss' );

/** Process the next batch. Called on each reload of the importer page while a job runs. */
function tsd_import_run_batch() {
	$job = get_option( 'tsd_import_job' );
	if ( ! $job || $job['pos'] >= count( $job['items'] ) ) {
		return $job;
	}
	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 120 ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
	}
	$end = min( count( $job['items'] ), $job['pos'] + TSD_IMPORT_BATCH );
	for ( $i = $job['pos']; $i < $end; $i++ ) {
		$r = tsd_import_item( $job['items'][ $i ], $job['dir'], $job['status'] );
		if ( is_wp_error( $r ) ) {
			$job['errors'][] = ( $job['items'][ $i ]['title'] ?? '#' . $i ) . ': ' . $r->get_error_message();
		} elseif ( 0 === $r ) {
			$job['skipped']++;
		} else {
			$job['created']++;
		}
	}
	$job['pos'] = $end;
	update_option( 'tsd_import_job', $job, false );
	return $job;
}

function tsd_import_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$job     = get_option( 'tsd_import_job' );
	$running = isset( $_GET['tsd_run'] ) && $job && $job['pos'] < count( $job['items'] ); // phpcs:ignore WordPress.Security.NonceVerification
	if ( $running ) {
		$job = tsd_import_run_batch();
	}
	$total = $job ? count( $job['items'] ) : 0;
	$done  = $job && $job['pos'] >= $total;
	echo '<div class="wrap"><h1>Import TSD posts</h1>';

	$errs = array(
		'nofile' => 'Please choose the tsd-import.zip file.',
		'unzip'  => 'The zip file could not be opened. If it is large, your host\'s upload limit may be too small.',
		'json'   => 'posts.json was not found in the zip.',
	);
	if ( isset( $_GET['tsd_err'], $errs[ $_GET['tsd_err'] ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		echo '<div class="notice notice-error"><p>' . esc_html( $errs[ $_GET['tsd_err'] ] ) . '</p></div>'; // phpcs:ignore WordPress.Security.NonceVerification
	}

	if ( $running && ! $done ) {
		$pct = $total ? round( 100 * $job['pos'] / $total ) : 0;
		echo '<p><strong>Importing… ' . esc_html( $job['pos'] . ' of ' . $total ) . ' (' . esc_html( $pct ) . '%)</strong></p>';
		echo '<div style="background:#ddd;height:14px;border-radius:7px;max-width:500px"><div style="background:#111;height:14px;border-radius:7px;width:' . esc_attr( $pct ) . '%"></div></div>';
		echo '<p>Keep this page open. It continues automatically.</p>';
		echo '<meta http-equiv="refresh" content="1;url=' . esc_url( admin_url( 'tools.php?page=tsd-import&tsd_run=1' ) ) . '">';
		echo '</div>';
		return;
	}

	if ( $job && $done ) {
		echo '<div class="notice notice-success"><p><strong>Import finished.</strong> ' . esc_html( $job['created'] ) . ' posts created, ' . esc_html( $job['skipped'] ) . ' skipped (already imported).</p></div>';
		if ( $job['errors'] ) {
			echo '<div class="notice notice-warning"><p>Problems:</p><ul style="list-style:disc;margin-left:20px">';
			foreach ( $job['errors'] as $e ) {
				echo '<li>' . esc_html( $e ) . '</li>';
			}
			echo '</ul></div>';
		}
		echo '<p><a class="button" href="' . esc_url( admin_url( 'edit.php' ) ) . '">View posts</a></p>';
		// Clean up unpacked files.
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		global $wp_filesystem;
		if ( $wp_filesystem && is_dir( tsd_import_dir() ) ) {
			$wp_filesystem->delete( tsd_import_dir(), true );
		}
		if ( ! empty( $job['bundled'] ) ) {
			update_option( 'tsd_bundled_imported', 1 );
		}
		delete_option( 'tsd_import_job' );
		echo '<hr>';
	}
	?>
	<?php
	$tsd_n = tsd_bundled_count();
	if ( $tsd_n ) :
		?>
		<div style="background:#fff;border:1px solid #ddd;border-left:6px solid #FFE14D;padding:14px 18px;max-width:640px;margin:16px 0">
			<h2 style="margin-top:0">Stories included with the theme</h2>
			<p><?php echo esc_html( $tsd_n ); ?> stories from The Social Dust's Instagram come with this theme.<?php echo get_option( 'tsd_bundled_imported' ) ? ' They have already been imported; running it again skips them.' : ''; ?></p>
			<p><a class="button button-primary button-hero" href="<?php echo esc_url( tsd_import_bundled_url() ); ?>">Import <?php echo esc_html( $tsd_n ); ?> stories now</a></p>
		</div>
		<h2>Or upload a new batch</h2>
	<?php endif; ?>
	<p>Upload the <code>tsd-import.zip</code> file prepared from The Social Dust's Instagram posts. Each post becomes a news story with its graphic, category, summary and a link back to Instagram. Posts that were already imported are skipped.</p>
	<p>Maximum upload size on this site: <strong><?php echo esc_html( size_format( wp_max_upload_size() ) ); ?></strong>.</p>
	<form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="tsd_import_upload">
		<?php wp_nonce_field( 'tsd_import_upload' ); ?>
		<p><input type="file" name="bundle" accept=".zip" required></p>
		<p>
			<label><input type="radio" name="publish" value="publish" checked> Publish immediately</label><br>
			<label><input type="radio" name="publish" value="draft"> Save as drafts</label>
		</p>
		<p><button class="button button-primary">Upload and import</button></p>
	</form>
	</div>
	<?php
}
