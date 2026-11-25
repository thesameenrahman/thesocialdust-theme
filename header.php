<?php
/**
 * Header.
 *
 * @package thesocialdust
 */
$tsd_lang = tsd_lang();
?><!doctype html>
<html <?php language_attributes(); ?> data-lang="<?php echo esc_attr( $tsd_lang ); ?>" data-theme="light">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#000000">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php tsd_e( 'Skip to content', 'মূল বিষয়ে যান' ); ?></a>

<div class="topbar">
	<div class="wrap">
		<span class="topbar-date"><?php echo tsd_today_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<?php
		$tsd_ticker = new WP_Query(
			array(
				'posts_per_page'      => 8,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( $tsd_ticker->have_posts() ) :
			?>
			<span class="ticker-label"><?php tsd_e( 'LATEST', 'সর্বশেষ' ); ?></span>
			<div class="ticker" aria-label="Latest headlines">
				<div class="ticker-track">
					<?php
					while ( $tsd_ticker->have_posts() ) :
						$tsd_ticker->the_post();
						?>
						<a href="<?php the_permalink(); ?>"><?php echo tsd_title_html( null, false ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		endif;
		?>
		<span class="topbar-social">
			<?php
			foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram' ) as $tsd_sid => $tsd_slabel ) :
				$tsd_surl = tsd_social_link( $tsd_sid );
				if ( $tsd_surl ) :
					?>
					<a href="<?php echo esc_url( $tsd_surl ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $tsd_slabel ); ?>"><?php echo tsd_social_icon( $tsd_sid ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
					<?php
				endif;
			endforeach;
			?>
		</span>
	</div>
</div>

<header class="site-header">
	<div class="wrap">
		<div class="header-main">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
				<?php
				$tsd_logo_id   = get_theme_mod( 'custom_logo' );
				$tsd_logo_dark = get_theme_mod( 'tsd_logo_dark' );
				if ( $tsd_logo_id ) {
					echo wp_get_attachment_image( $tsd_logo_id, 'full', false, array( 'class' => 'custom-logo logo-light' . ( $tsd_logo_dark ? ' has-dark' : '' ), 'alt' => get_bloginfo( 'name' ) ) );
					if ( $tsd_logo_dark ) {
						echo wp_get_attachment_image( $tsd_logo_dark, 'full', false, array( 'class' => 'custom-logo logo-dark', 'alt' => get_bloginfo( 'name' ) ) );
					}
				} else {
					$tsd_img = get_template_directory_uri() . '/assets/img/';
					echo '<img class="custom-logo logo-light has-dark" src="' . esc_url( $tsd_img . 'logo-black.png' ) . '" width="669" height="240" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
					echo '<img class="custom-logo logo-dark" src="' . esc_url( $tsd_img . 'logo-white.png' ) . '" width="669" height="240" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				}
				?>
			</a>

			<div class="controls">
				<button class="ctrl search-toggle" type="button" aria-expanded="false" aria-controls="tsd-search" aria-label="Search">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
				</button>
				<button class="ctrl lang-switch" type="button" aria-label="Switch language / ভাষা পরিবর্তন">
					<span class="l-en">EN</span><span class="l-bn">বাং</span>
				</button>
				<button class="ctrl theme-switch" type="button" aria-label="Toggle dark mode">
					<svg class="i-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4.5"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
					<svg class="i-moon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.5 14.6A8.5 8.5 0 0 1 9.4 3.5a8.5 8.5 0 1 0 11.1 11.1z"/></svg>
				</button>
			</div>
		</div>

		<div class="search-row" id="tsd-search">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="tsd-s">Search</label>
				<input type="search" id="tsd-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search news… / খবর খুঁজুন…">
				<button type="submit"><?php tsd_e( 'Search', 'খুঁজুন' ); ?></button>
			</form>
		</div>
	</div>

	<nav class="cat-nav" aria-label="Categories">
		<div class="wrap">
			<ul>
				<li class="<?php echo is_front_page() ? 'current' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php tsd_e( 'Home', 'প্রচ্ছদ' ); ?></a></li>
				<?php
				foreach ( tsd_categories() as $tsd_slug => $tsd_names ) :
					$tsd_term = get_term_by( 'slug', $tsd_slug, 'category' );
					if ( ! $tsd_term ) {
						continue;
					}
					$tsd_current = is_category( $tsd_term->term_id ) ? 'current' : '';
					?>
					<li class="cat-<?php echo esc_attr( $tsd_slug ); ?> <?php echo esc_attr( $tsd_current ); ?>"><a href="<?php echo esc_url( get_category_link( $tsd_term ) ); ?>"><?php echo tsd_cat_name_html( $tsd_term ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</nav>
</header>

<main id="content">
	<div class="wrap">
