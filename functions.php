<?php
/**
 * The Social Dust theme functions.
 *
 * @package thesocialdust
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TSD_VERSION', '1.3.0' );

require_once get_template_directory() . '/inc/newsletter.php';
require_once get_template_directory() . '/inc/contact.php';
require_once get_template_directory() . '/inc/importer.php';

/* -------------------------------------------------------------------------
 * Categories (slug => [English, Bangla])
 * ---------------------------------------------------------------------- */
function tsd_categories() {
	return array(
		'business' => array( 'Business', 'ব্যবসা' ),
		'tech'     => array( 'Tech', 'প্রযুক্তি' ),
		'youth'    => array( 'Youth', 'তারুণ্য' ),
		'sports'   => array( 'Sports', 'খেলা' ),
		'health'   => array( 'Health', 'স্বাস্থ্য' ),
		'world'    => array( 'World', 'বিশ্ব' ),
	);
}

/* -------------------------------------------------------------------------
 * Theme setup
 * ---------------------------------------------------------------------- */
function tsd_setup() {
	load_theme_textdomain( 'thesocialdust', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_image_size( 'tsd-square', 720, 720, true );
	add_image_size( 'tsd-hero', 1400, 900, true );
	register_nav_menus(
		array(
			'footer' => __( 'Footer menu', 'thesocialdust' ),
		)
	);
}
add_action( 'after_setup_theme', 'tsd_setup' );

/**
 * Create the six news categories when the theme is activated.
 */
function tsd_create_categories() {
	foreach ( tsd_categories() as $slug => $names ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term ) {
			$res = wp_insert_term( $names[0], 'category', array( 'slug' => $slug ) );
			if ( is_wp_error( $res ) ) {
				continue;
			}
			$term_id = $res['term_id'];
		} else {
			$term_id = $term->term_id;
		}
		if ( ! get_term_meta( $term_id, 'tsd_name_bn', true ) ) {
			update_term_meta( $term_id, 'tsd_name_bn', $names[1] );
		}
	}
	// Make "World" the default category instead of "Uncategorized".
	$world = get_term_by( 'slug', 'world', 'category' );
	if ( $world ) {
		update_option( 'default_category', $world->term_id );
	}
}
add_action( 'after_switch_theme', 'tsd_create_categories' );

/**
 * Create the About page (slug "about"). Its layout and bilingual text come from page-about.php.
 */
function tsd_create_about_page() {
	if ( get_page_by_path( 'about' ) ) {
		return;
	}
	wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'About',
			'post_name'    => 'about',
			'post_content' => '<!-- wp:paragraph --><p>This page is designed by the theme (page-about.php) and shows the About The Social Dust text in English and Bangla.</p><!-- /wp:paragraph -->',
		)
	);
}
add_action( 'after_switch_theme', 'tsd_create_about_page' );

/**
 * Publish the Privacy Policy page (slug "privacy-policy"; WordPress usually creates it as a draft)
 * and register it as the site's privacy policy page. Its text comes from page-privacy-policy.php.
 */
function tsd_create_privacy_page() {
	$content = '<!-- wp:paragraph --><p>This page is designed by the theme (page-privacy-policy.php) and shows the Privacy Policy in English and Bangla.</p><!-- /wp:paragraph -->';
	$page    = get_page_by_path( 'privacy-policy' );
	if ( $page ) {
		$page_id = $page->ID;
		if ( 'publish' !== $page->post_status ) {
			wp_update_post(
				array(
					'ID'           => $page_id,
					'post_status'  => 'publish',
					'post_title'   => 'Privacy Policy',
					'post_content' => $content,
				)
			);
		}
	} else {
		$page_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => 'Privacy Policy',
				'post_name'    => 'privacy-policy',
				'post_content' => $content,
			)
		);
	}
	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_option( 'wp_page_for_privacy_policy', (int) $page_id );
	}
}
add_action( 'after_switch_theme', 'tsd_create_privacy_page' );

/** Create the Terms & Conditions page (slug "terms-and-conditions"). Text comes from page-terms-and-conditions.php. */
function tsd_create_terms_page() {
	$page = get_page_by_path( 'terms-and-conditions' );
	if ( $page ) {
		if ( 'publish' !== $page->post_status ) {
			wp_update_post(
				array(
					'ID'          => $page->ID,
					'post_status' => 'publish',
				)
			);
		}
		return;
	}
	wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Terms & Conditions',
			'post_name'    => 'terms-and-conditions',
			'post_content' => '<!-- wp:paragraph --><p>This page is designed by the theme (page-terms-and-conditions.php) and shows the Terms &amp; Conditions in English and Bangla.</p><!-- /wp:paragraph -->',
		)
	);
}
add_action( 'after_switch_theme', 'tsd_create_terms_page' );

/** Also create the pages once on sites where the theme was already active before this version. */
function tsd_maybe_create_about_page() {
	if ( ! get_option( 'tsd_about_created' ) ) {
		tsd_create_about_page();
		update_option( 'tsd_about_created', 1 );
	}
	if ( ! get_option( 'tsd_privacy_created' ) ) {
		tsd_create_privacy_page();
		update_option( 'tsd_privacy_created', 1 );
	}
	if ( ! get_option( 'tsd_terms_created' ) ) {
		tsd_create_terms_page();
		update_option( 'tsd_terms_created', 1 );
	}
}
add_action( 'admin_init', 'tsd_maybe_create_about_page' );

/* -------------------------------------------------------------------------
 * Scripts & styles
 * ---------------------------------------------------------------------- */
function tsd_assets() {
	wp_enqueue_style(
		'tsd-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo+Black&family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'tsd-style', get_stylesheet_uri(), array( 'tsd-fonts' ), TSD_VERSION );
	wp_enqueue_script( 'tsd-main', get_template_directory_uri() . '/assets/js/main.js', array(), TSD_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'tsd_assets' );

function tsd_resource_hints( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'tsd_resource_hints', 10, 2 );

/**
 * Runs before anything paints: sets theme + language from storage so there is no flash.
 */
function tsd_head_boot() {
	$default_lang = get_theme_mod( 'tsd_default_lang', 'en' );
	?>
	<script>
	(function(){
		var d=document.documentElement;
		try{
			var t=localStorage.getItem('tsd_theme');
			if(!t){t=window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light';}
			d.setAttribute('data-theme',t);
		}catch(e){d.setAttribute('data-theme','light');}
		var q=new URLSearchParams(location.search).get('lang');
		var m=document.cookie.match(/(?:^|; )tsd_lang=(en|bn)/);
		var l=(q==='en'||q==='bn')?q:(m?m[1]:'<?php echo esc_js( $default_lang ); ?>');
		d.setAttribute('data-lang',l);
		d.setAttribute('lang',l==='bn'?'bn':'en');
	})();
	</script>
	<?php
}
add_action( 'wp_head', 'tsd_head_boot', 0 );

/**
 * Current language for server-side decisions (cookie / ?lang=).
 */
function tsd_lang() {
	if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'bn' ), true ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return sanitize_key( $_GET['lang'] ); // phpcs:ignore WordPress.Security.NonceVerification
	}
	if ( isset( $_COOKIE['tsd_lang'] ) && in_array( $_COOKIE['tsd_lang'], array( 'en', 'bn' ), true ) ) {
		return sanitize_key( $_COOKIE['tsd_lang'] );
	}
	return get_theme_mod( 'tsd_default_lang', 'en' );
}

/* -------------------------------------------------------------------------
 * Post fields (English + Bangla, source, credit)
 * ---------------------------------------------------------------------- */
function tsd_meta_fields() {
	return array(
		'tsd_title_bn'     => array( 'Headline (Bangla)', 'text' ),
		'tsd_bite_en'      => array( 'Bite-size summary (English, max ~30 words)', 'textarea' ),
		'tsd_bite_bn'      => array( 'Bite-size summary (Bangla)', 'textarea' ),
		'tsd_content_bn'   => array( 'Full story (Bangla, optional)', 'textarea_lg' ),
		'tsd_highlight'    => array( 'Highlight words (comma separated, shown in yellow)', 'text' ),
		'tsd_highlight_bn' => array( 'Highlight words, Bangla (comma separated)', 'text' ),
		'tsd_source_name'  => array( 'Source name (e.g. The Daily Star)', 'text' ),
		'tsd_source_url'   => array( 'Source article URL', 'url' ),
		'tsd_image_credit' => array( 'Image credit', 'text' ),
		'tsd_social_url'   => array( 'Social media post URL (Instagram / Facebook)', 'url' ),
	);
}

function tsd_register_meta() {
	foreach ( tsd_meta_fields() as $key => $field ) {
		register_post_meta(
			'post',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'url' === $field[1] ? 'esc_url_raw' : ( 0 === strpos( $field[1], 'textarea' ) ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
	register_term_meta(
		'category',
		'tsd_name_bn',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
}
add_action( 'init', 'tsd_register_meta' );

function tsd_add_meta_box() {
	add_meta_box( 'tsd_fields', __( 'The Social Dust: Bangla version & source', 'thesocialdust' ), 'tsd_render_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'tsd_add_meta_box' );

function tsd_render_meta_box( $post ) {
	wp_nonce_field( 'tsd_save_fields', 'tsd_fields_nonce' );
	echo '<style>.tsd-f{margin:0 0 14px}.tsd-f label{display:block;font-weight:600;margin-bottom:4px}.tsd-f input,.tsd-f textarea{width:100%}.tsd-f .n{color:#666;font-size:12px}</style>';
	foreach ( tsd_meta_fields() as $key => $field ) {
		$val = get_post_meta( $post->ID, $key, true );
		echo '<div class="tsd-f"><label for="' . esc_attr( $key ) . '">' . esc_html( $field[0] ) . '</label>';
		if ( 'textarea' === $field[1] ) {
			echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="3">' . esc_textarea( $val ) . '</textarea>';
		} elseif ( 'textarea_lg' === $field[1] ) {
			echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="8">' . esc_textarea( $val ) . '</textarea>';
		} else {
			$type = 'url' === $field[1] ? 'url' : 'text';
			echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '">';
		}
		echo '</div>';
	}
	echo '<p class="n">' . esc_html__( 'The post title and content above are the English version. If a Bangla field is empty, visitors see the English text.', 'thesocialdust' ) . '</p>';
}

function tsd_save_meta( $post_id ) {
	if ( ! isset( $_POST['tsd_fields_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tsd_fields_nonce'] ) ), 'tsd_save_fields' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( tsd_meta_fields() as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$raw = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		if ( 'url' === $field[1] ) {
			$val = esc_url_raw( $raw );
		} elseif ( 0 === strpos( $field[1], 'textarea' ) ) {
			$val = sanitize_textarea_field( $raw );
		} else {
			$val = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, $key, $val );
	}
}
add_action( 'save_post_post', 'tsd_save_meta' );

/* Bangla name field on Posts > Categories */
function tsd_cat_field_add() {
	echo '<div class="form-field"><label for="tsd_name_bn">Bangla name</label><input type="text" name="tsd_name_bn" id="tsd_name_bn"></div>';
}
add_action( 'category_add_form_fields', 'tsd_cat_field_add' );

function tsd_cat_field_edit( $term ) {
	$val = get_term_meta( $term->term_id, 'tsd_name_bn', true );
	echo '<tr class="form-field"><th scope="row"><label for="tsd_name_bn">Bangla name</label></th><td><input type="text" name="tsd_name_bn" id="tsd_name_bn" value="' . esc_attr( $val ) . '"></td></tr>';
}
add_action( 'category_edit_form_fields', 'tsd_cat_field_edit' );

function tsd_cat_field_save( $term_id ) {
	if ( isset( $_POST['tsd_name_bn'] ) && current_user_can( 'manage_categories' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		update_term_meta( $term_id, 'tsd_name_bn', sanitize_text_field( wp_unslash( $_POST['tsd_name_bn'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification
	}
}
add_action( 'created_category', 'tsd_cat_field_save' );
add_action( 'edited_category', 'tsd_cat_field_save' );

/* -------------------------------------------------------------------------
 * Customizer
 * ---------------------------------------------------------------------- */
function tsd_customize( $wp_customize ) {
	$wp_customize->add_section( 'tsd_options', array( 'title' => 'The Social Dust', 'priority' => 30 ) );

	$wp_customize->add_setting( 'tsd_default_lang', array( 'default' => 'en', 'sanitize_callback' => 'tsd_sanitize_lang' ) );
	$wp_customize->add_control(
		'tsd_default_lang',
		array(
			'label'   => 'Default language for new visitors',
			'section' => 'tsd_options',
			'type'    => 'radio',
			'choices' => array( 'en' => 'English', 'bn' => 'বাংলা (Bangla)' ),
		)
	);

	$wp_customize->add_setting( 'tsd_logo_dark', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'tsd_logo_dark',
			array(
				'label'     => 'Logo for dark mode (white logo)',
				'section'   => 'tsd_options',
				'mime_type' => 'image',
			)
		)
	);

	$text = array(
		'tsd_about_en' => array( 'Footer about text (English)', 'Bite-size news from Bangladesh and the world. Fast, clear, and straight from social.' ),
		'tsd_about_bn' => array( 'Footer about text (Bangla)', 'বাংলাদেশ ও বিশ্বের সংক্ষিপ্ত খবর। দ্রুত, স্পষ্ট, সরাসরি সোশ্যাল মিডিয়া থেকে।' ),
	);
	foreach ( $text as $id => $t ) {
		$wp_customize->add_setting( $id, array( 'default' => $t[1], 'sanitize_callback' => 'sanitize_textarea_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $t[0], 'section' => 'tsd_options', 'type' => 'textarea' ) );
	}

	foreach ( tsd_social_networks() as $id => $label ) {
		$defaults = tsd_social_defaults();
		$wp_customize->add_setting(
			'tsd_social_' . $id,
			array(
				'default'           => isset( $defaults[ $id ] ) ? $defaults[ $id ] : '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control( 'tsd_social_' . $id, array( 'label' => $label . ' URL', 'section' => 'tsd_options', 'type' => 'url' ) );
	}
}
add_action( 'customize_register', 'tsd_customize' );

function tsd_sanitize_lang( $v ) {
	return in_array( $v, array( 'en', 'bn' ), true ) ? $v : 'en';
}

/** The Social Dust's own accounts, used unless changed in Customize. */
function tsd_social_defaults() {
	return array(
		'facebook'  => 'https://www.facebook.com/thesocialdust',
		'instagram' => 'https://www.instagram.com/thesocialdust',
	);
}

function tsd_social_link( $id ) {
	$defaults = tsd_social_defaults();
	return get_theme_mod( 'tsd_social_' . $id, isset( $defaults[ $id ] ) ? $defaults[ $id ] : '' );
}

function tsd_social_icon( $id ) {
	$icons = array(
		'facebook'  => '<path d="M14 8.5V6.8c0-.8.5-1 1-1h2.3V2.1L14.2 2C10.8 2 10 4.5 10 6.2v2.3H7.5v3.8H10V22h4v-9.7h3l.4-3.8H14z"/>',
		'instagram' => '<path d="M12 7.3a4.7 4.7 0 1 0 0 9.4 4.7 4.7 0 0 0 0-9.4zm0 7.7a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm4.9-8.9a1.1 1.1 0 1 0 0 2.2 1.1 1.1 0 0 0 0-2.2zM20.9 8c-.1-1.5-.4-2.8-1.5-3.9S17.5 2.7 16 2.6c-1.5-.1-6.1-.1-7.7 0-1.5.1-2.8.4-3.9 1.5S2.7 6.5 2.6 8c-.1 1.5-.1 6.1 0 7.7.1 1.5.4 2.8 1.5 3.9s2.4 1.4 3.9 1.5c1.5.1 6.1.1 7.7 0 1.5-.1 2.8-.4 3.9-1.5s1.4-2.4 1.5-3.9c.1-1.6.1-6.1-.2-7.7zm-2 9.4c-.3.8-1 1.5-1.8 1.8-1.3.5-4.2.4-5.6.4s-4.3.1-5.6-.4c-.8-.3-1.5-1-1.8-1.8-.5-1.3-.4-4.2-.4-5.6s-.1-4.3.4-5.6c.3-.8 1-1.5 1.8-1.8 1.3-.5 4.2-.4 5.6-.4s4.3-.1 5.6.4c.8.3 1.5 1 1.8 1.8.5 1.3.4 4.2.4 5.6s.1 4.3-.4 5.6z"/>',
	);
	if ( ! isset( $icons[ $id ] ) ) {
		return '';
	}
	return '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">' . $icons[ $id ] . '</svg>';
}

function tsd_social_networks() {
	return array(
		'facebook'  => 'Facebook',
		'instagram' => 'Instagram',
		'youtube'   => 'YouTube',
		'tiktok'    => 'TikTok',
		'x'         => 'X',
		'linkedin'  => 'LinkedIn',
	);
}

/* -------------------------------------------------------------------------
 * Bilingual helpers
 * ---------------------------------------------------------------------- */

/**
 * Print text in both languages; CSS shows the active one.
 * Both strings must already be escaped / safe HTML.
 */
function tsd_t( $en, $bn = '' ) {
	if ( '' === $bn || null === $bn ) {
		return $en;
	}
	return '<span class="t-en">' . $en . '</span><span class="t-bn" lang="bn">' . $bn . '</span>';
}

function tsd_e( $en, $bn = '' ) {
	echo tsd_t( esc_html( $en ), esc_html( $bn ) ); // phpcs:ignore WordPress.Security.EscapeOutput
}

/** Wrap highlight words in <mark>. Input is plain text; returns escaped HTML. */
function tsd_highlight( $text, $words ) {
	$html = esc_html( $text );
	if ( ! $words ) {
		return $html;
	}
	foreach ( array_filter( array_map( 'trim', explode( ',', $words ) ) ) as $w ) {
		$w_html = esc_html( $w );
		$html   = preg_replace( '/' . preg_quote( $w_html, '/' ) . '/iu', '<mark>$0</mark>', $html, 1 );
	}
	return $html;
}

function tsd_title_html( $post_id = null, $highlight = true ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$en      = get_the_title( $post_id );
	$en      = wp_strip_all_tags( html_entity_decode( $en, ENT_QUOTES, 'UTF-8' ) );
	$bn      = get_post_meta( $post_id, 'tsd_title_bn', true );
	$en_html = $highlight ? tsd_highlight( $en, get_post_meta( $post_id, 'tsd_highlight', true ) ) : esc_html( $en );
	$bn_html = $bn ? ( $highlight ? tsd_highlight( $bn, get_post_meta( $post_id, 'tsd_highlight_bn', true ) ) : esc_html( $bn ) ) : '';
	return tsd_t( $en_html, $bn_html );
}

function tsd_bite_html( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$en      = get_post_meta( $post_id, 'tsd_bite_en', true );
	if ( ! $en ) {
		$en = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 30, '…' );
	}
	$bn = get_post_meta( $post_id, 'tsd_bite_bn', true );
	return tsd_t( esc_html( $en ), $bn ? esc_html( $bn ) : '' );
}

/** Plain text versions for meta tags / sharing. */
function tsd_bite_text( $post_id = null ) {
	return wp_strip_all_tags( str_replace( '</span><span', '</span> <span', tsd_bite_html( $post_id ) ) );
}

function tsd_bn_digits( $str ) {
	return strtr( (string) $str, array( '0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯' ) );
}

/** "3 hours ago" / "৩ ঘণ্টা আগে" */
function tsd_time_ago( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$t       = get_post_time( 'U', true, $post_id );
	$diff    = time() - $t;
	if ( $diff < 0 ) {
		$diff = 0;
	}
	if ( $diff < HOUR_IN_SECONDS ) {
		$n  = max( 1, (int) floor( $diff / MINUTE_IN_SECONDS ) );
		$en = $n . ' min ago';
		$bn = tsd_bn_digits( $n ) . ' মিনিট আগে';
	} elseif ( $diff < DAY_IN_SECONDS ) {
		$n  = (int) floor( $diff / HOUR_IN_SECONDS );
		$en = $n . ( 1 === $n ? ' hour ago' : ' hours ago' );
		$bn = tsd_bn_digits( $n ) . ' ঘণ্টা আগে';
	} elseif ( $diff < 7 * DAY_IN_SECONDS ) {
		$n  = (int) floor( $diff / DAY_IN_SECONDS );
		$en = $n . ( 1 === $n ? ' day ago' : ' days ago' );
		$bn = tsd_bn_digits( $n ) . ' দিন আগে';
	} else {
		$en = get_the_date( 'j M Y', $post_id );
		$bn = tsd_bn_date( $t );
	}
	return '<time datetime="' . esc_attr( get_the_date( 'c', $post_id ) ) . '">' . tsd_t( esc_html( $en ), esc_html( $bn ) ) . '</time>';
}

function tsd_bn_date( $timestamp ) {
	$months = array( 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );
	$d      = (int) wp_date( 'j', $timestamp );
	$m      = (int) wp_date( 'n', $timestamp );
	$y      = wp_date( 'Y', $timestamp );
	return tsd_bn_digits( $d ) . ' ' . $months[ $m - 1 ] . ' ' . tsd_bn_digits( $y );
}

function tsd_today_html() {
	$days_bn = array( 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার' );
	$now     = time();
	$en      = wp_date( 'l, j F Y', $now );
	$bn      = $days_bn[ (int) wp_date( 'w', $now ) ] . ', ' . tsd_bn_date( $now );
	return tsd_t( esc_html( $en ), esc_html( $bn ) );
}

/** Return the TSD category of a post (first of the six, else first category). */
function tsd_post_cat( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$cats    = get_the_category( $post_id );
	if ( ! $cats ) {
		return null;
	}
	$ours = array_keys( tsd_categories() );
	foreach ( $cats as $c ) {
		if ( in_array( $c->slug, $ours, true ) ) {
			return $c;
		}
	}
	return $cats[0];
}

function tsd_cat_name_html( $term ) {
	if ( ! $term ) {
		return '';
	}
	$bn = get_term_meta( $term->term_id, 'tsd_name_bn', true );
	if ( ! $bn ) {
		$map = tsd_categories();
		$bn  = isset( $map[ $term->slug ] ) ? $map[ $term->slug ][1] : '';
	}
	return tsd_t( esc_html( $term->name ), esc_html( $bn ) );
}

function tsd_pill( $term, $link = false ) {
	if ( ! $term ) {
		return '';
	}
	$html = '<span class="pill cat-' . esc_attr( $term->slug ) . '">' . tsd_cat_name_html( $term ) . '</span>';
	if ( $link ) {
		$html = '<a href="' . esc_url( get_category_link( $term ) ) . '">' . $html . '</a>';
	}
	return $html;
}

function tsd_via_html( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$src     = get_post_meta( $post_id, 'tsd_source_name', true );
	if ( ! $src ) {
		return '';
	}
	return '<span class="via">' . tsd_t( 'Via', 'সূত্র' ) . ' | <strong>' . esc_html( $src ) . '</strong></span>';
}

/* -------------------------------------------------------------------------
 * Misc
 * ---------------------------------------------------------------------- */
function tsd_excerpt_length() {
	return 30;
}
add_filter( 'excerpt_length', 'tsd_excerpt_length' );

function tsd_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'tsd_excerpt_more' );

/** Show 12 posts per archive page (grid of 4 x 3). */
function tsd_posts_per_page( $q ) {
	if ( ! is_admin() && $q->is_main_query() && ( $q->is_archive() || $q->is_search() ) ) {
		$q->set( 'posts_per_page', 12 );
	}
}
add_action( 'pre_get_posts', 'tsd_posts_per_page' );

/** Also search the Bangla headline and summary fields. */
function tsd_search_join( $join, $q ) {
	global $wpdb;
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
		$join .= " LEFT JOIN {$wpdb->postmeta} tsdm ON ({$wpdb->posts}.ID = tsdm.post_id AND tsdm.meta_key IN ('tsd_title_bn','tsd_bite_bn','tsd_bite_en')) ";
	}
	return $join;
}
add_filter( 'posts_join', 'tsd_search_join', 10, 2 );

function tsd_search_where( $where, $q ) {
	global $wpdb;
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
		$where = preg_replace(
			"/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"({$wpdb->posts}.post_title LIKE $1) OR (tsdm.meta_value LIKE $1)",
			$where
		);
	}
	return $where;
}
add_filter( 'posts_where', 'tsd_search_where', 10, 2 );

function tsd_search_distinct( $distinct, $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
		return 'DISTINCT';
	}
	return $distinct;
}
add_filter( 'posts_distinct', 'tsd_search_distinct', 10, 2 );

/** TSD badge as browser / home-screen icon unless a Site Icon is set in Customize. */
function tsd_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	$img = get_template_directory_uri() . '/assets/img/';
	echo '<link rel="icon" href="' . esc_url( $img . 'icon-32.png' ) . '" sizes="32x32">' . "\n";
	echo '<link rel="icon" href="' . esc_url( $img . 'icon-512.png' ) . '" sizes="512x512">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $img . 'icon-180.png' ) . '">' . "\n";
}
add_action( 'wp_head', 'tsd_favicon', 2 );

/** Social sharing meta. */
function tsd_og_tags() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}
	$id  = get_queried_object_id();
	$img = get_the_post_thumbnail_url( $id, 'large' );
	echo '<meta property="og:type" content="article">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( get_the_title( $id ) ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( wp_trim_words( tsd_bite_text( $id ), 40 ) ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink( $id ) ) . '">' . "\n";
	if ( $img ) {
		echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	}
}
add_action( 'wp_head', 'tsd_og_tags', 5 );

/** Output a card for the current post in the loop. */
function tsd_card( $variant = '' ) {
	get_template_part( 'template-parts/card', null, array( 'variant' => $variant ) );
}
