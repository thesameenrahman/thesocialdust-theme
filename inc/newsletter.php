<?php
/**
 * Newsletter: stores signups in the site's database and lists them under
 * Dashboard > Newsletter, with CSV download and remove buttons.
 *
 * @package thesocialdust
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TSD_NL_DB_VERSION', '1' );

function tsd_nl_table() {
	global $wpdb;
	return $wpdb->prefix . 'tsd_subscribers';
}

/** Create / upgrade the subscribers table. */
function tsd_nl_install() {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$table   = tsd_nl_table();
	$charset = $wpdb->get_charset_collate();
	dbDelta(
		"CREATE TABLE {$table} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			email varchar(190) NOT NULL,
			lang varchar(5) NOT NULL DEFAULT 'en',
			created_at datetime NOT NULL,
			PRIMARY KEY  (id),
			UNIQUE KEY email (email)
		) {$charset};"
	);
	update_option( 'tsd_nl_db_version', TSD_NL_DB_VERSION );
}
add_action( 'after_switch_theme', 'tsd_nl_install' );

function tsd_nl_maybe_install() {
	if ( get_option( 'tsd_nl_db_version' ) !== TSD_NL_DB_VERSION ) {
		tsd_nl_install();
	}
}
add_action( 'init', 'tsd_nl_maybe_install' );

/**
 * Validate and save a signup. Returns ok | exists | invalid | error.
 */
function tsd_nl_save( $email, $lang ) {
	global $wpdb;
	$email = sanitize_email( $email );
	if ( ! $email || ! is_email( $email ) ) {
		return 'invalid';
	}
	$table  = tsd_nl_table();
	$exists = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$table} WHERE email = %s", $email ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	if ( $exists ) {
		return 'exists';
	}
	$ok = $wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$table,
		array(
			'email'      => $email,
			'lang'       => 'bn' === $lang ? 'bn' : 'en',
			'created_at' => current_time( 'mysql' ),
		),
		array( '%s', '%s', '%s' )
	);
	return $ok ? 'ok' : 'error';
}

/** Basic flood protection: max 5 signup attempts per visitor per 10 minutes. */
function tsd_nl_rate_limited() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'tsd_nl_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= 5 ) {
		return true;
	}
	set_transient( $key, $n + 1, 10 * MINUTE_IN_SECONDS );
	return false;
}

/** Shared handler for the form (page reload) and the fetch() request (no reload). */
function tsd_nl_handle() {
	$ajax = wp_doing_ajax();
	// No nonce on purpose: this is a public form and nonces break on cached pages.
	// Bots are stopped by the hidden honeypot field and the rate limit instead.
	if ( ! empty( $_POST['website'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$status = 'ok'; // Honeypot filled in: a bot. Pretend it worked, save nothing.
	} elseif ( tsd_nl_rate_limited() ) {
		$status = 'error';
	} else {
		$email  = isset( $_POST['email'] ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : '';
		$lang   = isset( $_POST['lang'] ) ? sanitize_key( $_POST['lang'] ) : 'en';
		$status = tsd_nl_save( $email, $lang );
	}

	if ( $ajax ) {
		wp_send_json( array( 'status' => $status ) );
	}
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'tsd_nl', $back );
	wp_safe_redirect( add_query_arg( 'tsd_nl', $status, $back ) . '#newsletter' );
	exit;
}
add_action( 'admin_post_nopriv_tsd_subscribe', 'tsd_nl_handle' );
add_action( 'admin_post_tsd_subscribe', 'tsd_nl_handle' );
add_action( 'wp_ajax_nopriv_tsd_subscribe', 'tsd_nl_handle' );
add_action( 'wp_ajax_tsd_subscribe', 'tsd_nl_handle' );

/** Pass the AJAX URL to the front-end script. */
function tsd_nl_script_data() {
	wp_localize_script( 'tsd-main', 'TSD', array( 'ajax' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'tsd_nl_script_data', 20 );

/* -------------------------------------------------------------------------
 * Admin: Dashboard > Newsletter
 * ---------------------------------------------------------------------- */
function tsd_nl_admin_menu() {
	add_menu_page( 'Newsletter subscribers', 'Newsletter', 'manage_options', 'tsd-newsletter', 'tsd_nl_admin_page', 'dashicons-email-alt', 26 );
}
add_action( 'admin_menu', 'tsd_nl_admin_menu' );

/** CSV download and remove actions run before the page renders. */
function tsd_nl_admin_actions() {
	global $wpdb;
	if ( ! isset( $_GET['page'] ) || 'tsd-newsletter' !== $_GET['page'] || ! current_user_can( 'manage_options' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	$table = tsd_nl_table();

	if ( isset( $_GET['tsd_export'] ) && check_admin_referer( 'tsd_nl_export' ) ) {
		$rows = $wpdb->get_results( "SELECT email, lang, created_at FROM {$table} ORDER BY created_at DESC", ARRAY_A ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		nocache_headers();
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=thesocialdust-subscribers-' . gmdate( 'Y-m-d' ) . '.csv' );
		$out = fopen( 'php://output', 'w' );
		fwrite( $out, "\xEF\xBB\xBF" ); // UTF-8 BOM so Excel opens it correctly.
		fputcsv( $out, array( 'email', 'language', 'subscribed_at' ) );
		foreach ( $rows as $r ) {
			fputcsv( $out, $r );
		}
		fclose( $out ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		exit;
	}

	if ( isset( $_GET['tsd_remove'] ) && check_admin_referer( 'tsd_nl_remove' ) ) {
		$wpdb->delete( $table, array( 'id' => absint( $_GET['tsd_remove'] ) ), array( '%d' ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		wp_safe_redirect( admin_url( 'admin.php?page=tsd-newsletter&removed=1' ) );
		exit;
	}
}
add_action( 'admin_init', 'tsd_nl_admin_actions' );

function tsd_nl_admin_page() {
	global $wpdb;
	$table  = tsd_nl_table();
	$search = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$paged  = max( 1, isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1 ); // phpcs:ignore WordPress.Security.NonceVerification
	$per    = 50;
	$where  = $search ? $wpdb->prepare( 'WHERE email LIKE %s', '%' . $wpdb->esc_like( $search ) . '%' ) : '';
	$total  = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} {$where}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$limit  = $wpdb->prepare( 'LIMIT %d OFFSET %d', $per, ( $paged - 1 ) * $per );
	$rows   = $wpdb->get_results( "SELECT * FROM {$table} {$where} ORDER BY created_at DESC {$limit}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$all    = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$export = wp_nonce_url( admin_url( 'admin.php?page=tsd-newsletter&tsd_export=1' ), 'tsd_nl_export' );
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Newsletter subscribers</h1>
		<a href="<?php echo esc_url( $export ); ?>" class="page-title-action">Download CSV</a>
		<hr class="wp-header-end">
		<?php if ( isset( $_GET['removed'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification ?>
			<div class="notice notice-success is-dismissible"><p>Subscriber removed.</p></div>
		<?php endif; ?>
		<p><strong><?php echo esc_html( number_format_i18n( $all ) ); ?></strong> subscribers in total. Download the CSV to import them into Mailchimp, Brevo or any other email service.</p>
		<form method="get">
			<input type="hidden" name="page" value="tsd-newsletter">
			<p class="search-box"><input type="search" name="s" value="<?php echo esc_attr( $search ); ?>" placeholder="Search email"> <button class="button">Search</button></p>
		</form>
		<table class="widefat striped">
			<thead><tr><th>Email</th><th>Language</th><th>Subscribed</th><th></th></tr></thead>
			<tbody>
			<?php if ( ! $rows ) : ?>
				<tr><td colspan="4">No subscribers yet.</td></tr>
			<?php else : ?>
				<?php foreach ( $rows as $r ) : ?>
					<tr>
						<td><?php echo esc_html( $r->email ); ?></td>
						<td><?php echo 'bn' === $r->lang ? 'বাংলা' : 'English'; ?></td>
						<td><?php echo esc_html( mysql2date( 'j M Y, g:i a', $r->created_at ) ); ?></td>
						<td><a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=tsd-newsletter&tsd_remove=' . (int) $r->id ), 'tsd_nl_remove' ) ); ?>" onclick="return confirm('Remove this subscriber?');" style="color:#b32d2e">Remove</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php
		$pages = (int) ceil( $total / $per );
		if ( $pages > 1 ) {
			echo '<div class="tablenav"><div class="tablenav-pages">';
			echo paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput
				array(
					'base'    => add_query_arg( 'paged', '%#%' ),
					'format'  => '',
					'current' => $paged,
					'total'   => $pages,
				)
			);
			echo '</div></div>';
		}
		?>
	</div>
	<?php
}
