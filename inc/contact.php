<?php
/**
 * Contact form: emails each message to the right inbox and keeps a copy
 * under Dashboard > Messages (so nothing is lost if email delivery fails).
 *
 * @package thesocialdust
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TSD_CT_DB_VERSION', '1' );

/** Inboxes. Advertising messages go to the ad inbox, everything else to hello@. */
function tsd_contact_emails() {
	return array(
		'general' => 'hello@thesocialdust.com',
		'ads'     => 'ad@thesocialdust.com',
	);
}

/** Topic key => [English, Bangla, inbox]. */
function tsd_contact_topics() {
	return array(
		'general'     => array( 'General question', 'সাধারণ প্রশ্ন', 'general' ),
		'tip'         => array( 'News tip', 'খবরের তথ্য দিন', 'general' ),
		'feedback'    => array( 'Feedback or correction', 'মতামত বা সংশোধন', 'general' ),
		'partnership' => array( 'Partnership', 'অংশীদারত্ব', 'general' ),
		'advertising' => array( 'Advertising', 'বিজ্ঞাপন', 'ads' ),
	);
}

function tsd_ct_table() {
	global $wpdb;
	return $wpdb->prefix . 'tsd_messages';
}

function tsd_ct_install() {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$table   = tsd_ct_table();
	$charset = $wpdb->get_charset_collate();
	dbDelta(
		"CREATE TABLE {$table} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			name varchar(120) NOT NULL,
			email varchar(190) NOT NULL,
			organization varchar(160) NOT NULL DEFAULT '',
			topic varchar(30) NOT NULL DEFAULT 'general',
			message text NOT NULL,
			lang varchar(5) NOT NULL DEFAULT 'en',
			mailed tinyint(1) NOT NULL DEFAULT 0,
			created_at datetime NOT NULL,
			PRIMARY KEY  (id),
			KEY created_at (created_at)
		) {$charset};"
	);
	update_option( 'tsd_ct_db_version', TSD_CT_DB_VERSION );
}
add_action( 'after_switch_theme', 'tsd_ct_install' );

function tsd_ct_maybe_install() {
	if ( get_option( 'tsd_ct_db_version' ) !== TSD_CT_DB_VERSION ) {
		tsd_ct_install();
	}
}
add_action( 'init', 'tsd_ct_maybe_install' );

/**
 * Validate, store and email a message. Returns ok | invalid | error.
 *
 * @param array $data Raw fields: name, email, organization, topic, message, lang.
 */
function tsd_ct_process( $data ) {
	global $wpdb;
	$topics = tsd_contact_topics();
	$name   = mb_substr( sanitize_text_field( $data['name'] ?? '' ), 0, 120 );
	$email  = sanitize_email( $data['email'] ?? '' );
	$org    = mb_substr( sanitize_text_field( $data['organization'] ?? '' ), 0, 160 );
	$topic  = sanitize_key( $data['topic'] ?? 'general' );
	$msg    = mb_substr( sanitize_textarea_field( $data['message'] ?? '' ), 0, 5000 );
	$lang   = ( $data['lang'] ?? 'en' ) === 'bn' ? 'bn' : 'en';

	if ( ! isset( $topics[ $topic ] ) ) {
		$topic = 'general';
	}
	if ( '' === $name || ! $email || ! is_email( $email ) || mb_strlen( $msg ) < 5 ) {
		return 'invalid';
	}

	$saved = $wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		tsd_ct_table(),
		array(
			'name'         => $name,
			'email'        => $email,
			'organization' => $org,
			'topic'        => $topic,
			'message'      => $msg,
			'lang'         => $lang,
			'created_at'   => current_time( 'mysql' ),
		),
		array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
	);
	$id = $saved ? (int) $wpdb->insert_id : 0;

	$inboxes = tsd_contact_emails();
	$to      = $inboxes[ $topics[ $topic ][2] ];
	$subject = '[The Social Dust] ' . $topics[ $topic ][0] . ': ' . $name;
	$body    = "Topic: {$topics[ $topic ][0]}\n"
		. "Name: {$name}\n"
		. "Email: {$email}\n"
		. ( $org ? "Organization: {$org}\n" : '' )
		. 'Language: ' . ( 'bn' === $lang ? 'Bangla' : 'English' ) . "\n"
		. 'Sent: ' . current_time( 'j M Y, g:i a' ) . "\n\n"
		. $msg . "\n\n--\nSent from the contact form on " . home_url( '/' );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	$mailed  = wp_mail( $to, $subject, $body, $headers );

	if ( $id && $mailed ) {
		$wpdb->update( tsd_ct_table(), array( 'mailed' => 1 ), array( 'id' => $id ), array( '%d' ), array( '%d' ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	}
	// The message counts as received if it was stored or emailed.
	return ( $id || $mailed ) ? 'ok' : 'error';
}

/** Max 5 messages per visitor per 10 minutes. */
function tsd_ct_rate_limited() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'tsd_ct_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= 5 ) {
		return true;
	}
	set_transient( $key, $n + 1, 10 * MINUTE_IN_SECONDS );
	return false;
}

function tsd_ct_handle() {
	// Public form: no nonce (breaks on cached pages); a honeypot and rate limit stop bots.
	// phpcs:disable WordPress.Security.NonceVerification
	if ( ! empty( $_POST['website'] ) ) {
		$status = 'ok';
	} elseif ( tsd_ct_rate_limited() ) {
		$status = 'error';
	} else {
		$status = tsd_ct_process( wp_unslash( $_POST ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	}
	// phpcs:enable

	if ( wp_doing_ajax() ) {
		wp_send_json( array( 'status' => $status ) );
	}
	$back = wp_get_referer() ? remove_query_arg( 'tsd_ct', wp_get_referer() ) : home_url( '/contact/' );
	wp_safe_redirect( add_query_arg( 'tsd_ct', $status, $back ) . '#contact-form' );
	exit;
}
add_action( 'admin_post_nopriv_tsd_contact', 'tsd_ct_handle' );
add_action( 'admin_post_tsd_contact', 'tsd_ct_handle' );
add_action( 'wp_ajax_nopriv_tsd_contact', 'tsd_ct_handle' );
add_action( 'wp_ajax_tsd_contact', 'tsd_ct_handle' );

/* -------------------------------------------------------------------------
 * Admin: Dashboard > Messages
 * ---------------------------------------------------------------------- */
function tsd_ct_admin_menu() {
	add_menu_page( 'Contact messages', 'Messages', 'manage_options', 'tsd-messages', 'tsd_ct_admin_page', 'dashicons-format-chat', 25 );
}
add_action( 'admin_menu', 'tsd_ct_admin_menu' );

function tsd_ct_admin_actions() {
	global $wpdb;
	if ( ! isset( $_GET['page'] ) || 'tsd-messages' !== $_GET['page'] || ! current_user_can( 'manage_options' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	if ( isset( $_GET['tsd_delete'] ) && check_admin_referer( 'tsd_ct_delete' ) ) {
		$wpdb->delete( tsd_ct_table(), array( 'id' => absint( $_GET['tsd_delete'] ) ), array( '%d' ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		wp_safe_redirect( admin_url( 'admin.php?page=tsd-messages&deleted=1' ) );
		exit;
	}
}
add_action( 'admin_init', 'tsd_ct_admin_actions' );

function tsd_ct_admin_page() {
	global $wpdb;
	$table  = tsd_ct_table();
	$topics = tsd_contact_topics();
	$paged  = max( 1, isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1 ); // phpcs:ignore WordPress.Security.NonceVerification
	$per    = 30;
	$total  = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$limit  = $wpdb->prepare( 'LIMIT %d OFFSET %d', $per, ( $paged - 1 ) * $per );
	$rows   = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY created_at DESC {$limit}" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	?>
	<div class="wrap">
		<h1>Contact messages</h1>
		<?php if ( isset( $_GET['deleted'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification ?>
			<div class="notice notice-success is-dismissible"><p>Message deleted.</p></div>
		<?php endif; ?>
		<p>Every message sent through the Contact page is kept here and also emailed: advertising to <strong>ad@thesocialdust.com</strong>, everything else to <strong>hello@thesocialdust.com</strong>. "Not emailed" means the site could not send the email; set up an SMTP plugin if you see it.</p>
		<style>.tsd-msg{white-space:pre-wrap;max-width:640px}.tsd-warn{color:#b32d2e;font-weight:600}</style>
		<table class="widefat striped">
			<thead><tr><th style="width:180px">From</th><th style="width:140px">Topic</th><th>Message</th><th style="width:150px">Received</th><th style="width:60px"></th></tr></thead>
			<tbody>
			<?php if ( ! $rows ) : ?>
				<tr><td colspan="5">No messages yet.</td></tr>
			<?php else : ?>
				<?php foreach ( $rows as $r ) : ?>
					<tr>
						<td><strong><?php echo esc_html( $r->name ); ?></strong><br><a href="mailto:<?php echo esc_attr( $r->email ); ?>"><?php echo esc_html( $r->email ); ?></a><?php echo $r->organization ? '<br>' . esc_html( $r->organization ) : ''; ?></td>
						<td><?php echo esc_html( isset( $topics[ $r->topic ] ) ? $topics[ $r->topic ][0] : $r->topic ); ?><br><small><?php echo 'bn' === $r->lang ? 'বাংলা' : 'English'; ?></small></td>
						<td><div class="tsd-msg"><?php echo esc_html( $r->message ); ?></div></td>
						<td><?php echo esc_html( mysql2date( 'j M Y, g:i a', $r->created_at ) ); ?><?php echo $r->mailed ? '' : '<br><span class="tsd-warn">Not emailed</span>'; ?></td>
						<td><a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=tsd-messages&tsd_delete=' . (int) $r->id ), 'tsd_ct_delete' ) ); ?>" onclick="return confirm('Delete this message?');" style="color:#b32d2e">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php
		$pages = (int) ceil( $total / $per );
		if ( $pages > 1 ) {
			echo '<div class="tablenav"><div class="tablenav-pages">' . paginate_links( // phpcs:ignore WordPress.Security.EscapeOutput
				array(
					'base'    => add_query_arg( 'paged', '%#%' ),
					'format'  => '',
					'current' => $paged,
					'total'   => $pages,
				)
			) . '</div></div>';
		}
		?>
	</div>
	<?php
}

/** Create the Contact page (slug "contact"). Its layout comes from page-contact.php. */
function tsd_create_contact_page() {
	if ( get_page_by_path( 'contact' ) ) {
		return;
	}
	wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Contact Us',
			'post_name'    => 'contact',
			'post_content' => '<!-- wp:paragraph --><p>This page is designed by the theme (page-contact.php) and shows the contact form in English and Bangla.</p><!-- /wp:paragraph -->',
		)
	);
}
add_action( 'after_switch_theme', 'tsd_create_contact_page' );

function tsd_maybe_create_contact_page() {
	if ( ! get_option( 'tsd_contact_created' ) ) {
		tsd_create_contact_page();
		update_option( 'tsd_contact_created', 1 );
	}
}
add_action( 'admin_init', 'tsd_maybe_create_contact_page' );

/** Link to the Contact page, optionally preselecting a topic. */
function tsd_contact_url( $topic = '' ) {
	$page = get_page_by_path( 'contact' );
	$url  = $page ? get_permalink( $page ) : home_url( '/contact/' );
	return $topic ? add_query_arg( 'topic', $topic, $url ) . '#contact-form' : $url;
}
