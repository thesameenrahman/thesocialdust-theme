<?php
/**
 * Home page: lead story, latest bites, then a block for each category.
 *
 * @package thesocialdust
 */
get_header();

$tsd_shown = array();
$tsd_lead  = new WP_Query(
	array(
		'posts_per_page'      => 5,
		'ignore_sticky_posts' => false,
		'no_found_rows'       => true,
	)
);

if ( ! $tsd_lead->have_posts() ) :
	?>
	<div class="empty">
		<h2><?php tsd_e( 'No news yet', 'এখনো কোনো খবর নেই' ); ?></h2>
		<p><?php tsd_e( 'Publish your first bite from Posts > Add New.', 'Posts > Add New থেকে প্রথম খবর প্রকাশ করুন।' ); ?></p>
	</div>
	<?php
else :
	?>
	<section class="hero">
		<?php
		$tsd_i = 0;
		while ( $tsd_lead->have_posts() ) :
			$tsd_lead->the_post();
			$tsd_shown[] = get_the_ID();
			if ( 0 === $tsd_i ) :
				$tsd_cat = tsd_post_cat();
				?>
				<a class="hero-main" href="<?php the_permalink(); ?>">
					<span class="hero-media">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'large', array( 'alt' => '', 'fetchpriority' => 'high' ) );
						} else {
							echo '<span class="no-thumb">TSD</span>';
						}
						?>
					</span>
					<div class="hero-body">
						<?php echo tsd_pill( $tsd_cat ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<h1 class="hero-title"><?php echo tsd_title_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
						<p class="hero-bite"><?php echo tsd_bite_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
					</div>
				</a>
				<div class="hero-side">
				<?php
			else :
				tsd_card( 'row' );
			endif;
			$tsd_i++;
		endwhile;
		if ( $tsd_i > 0 ) {
			echo '</div>';
		}
		wp_reset_postdata();
		?>
	</section>

	<?php
	$tsd_latest = new WP_Query(
		array(
			'posts_per_page'      => 8,
			'post__not_in'        => $tsd_shown,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $tsd_latest->have_posts() ) :
		?>
		<section class="section">
			<div class="section-head">
				<h2 class="section-title"><?php tsd_e( 'Latest Bites', 'সর্বশেষ খবর' ); ?></h2>
			</div>
			<div class="grid">
				<?php
				while ( $tsd_latest->have_posts() ) :
					$tsd_latest->the_post();
					$tsd_shown[] = get_the_ID();
					tsd_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	endif;

	foreach ( tsd_categories() as $tsd_slug => $tsd_names ) :
		$tsd_term = get_term_by( 'slug', $tsd_slug, 'category' );
		if ( ! $tsd_term ) {
			continue;
		}
		$tsd_q = new WP_Query(
			array(
				'posts_per_page'      => 4,
				'cat'                 => $tsd_term->term_id,
				'post__not_in'        => $tsd_shown,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( ! $tsd_q->have_posts() ) {
			continue;
		}
		?>
		<section class="section cat-<?php echo esc_attr( $tsd_slug ); ?>">
			<div class="section-head">
				<h2 class="section-title"><?php echo tsd_cat_name_html( $tsd_term ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				<a class="see-all" href="<?php echo esc_url( get_category_link( $tsd_term ) ); ?>"><?php tsd_e( 'See all →', 'সব দেখুন →' ); ?></a>
			</div>
			<div class="grid">
				<?php
				while ( $tsd_q->have_posts() ) :
					$tsd_q->the_post();
					tsd_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	endforeach;
endif;

get_footer();
