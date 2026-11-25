<?php
/**
 * Archives, categories, search and fallback listing.
 *
 * @package thesocialdust
 */
get_header();

$tsd_head_class = '';
if ( is_category() ) {
	$tsd_term       = get_queried_object();
	$tsd_head_class = 'cat-' . $tsd_term->slug;
	$tsd_title      = tsd_cat_name_html( $tsd_term );
	$tsd_sub        = tsd_t( 'Bite-size stories, newest first.', 'সংক্ষিপ্ত খবর, সর্বশেষগুলো আগে।' );
} elseif ( is_search() ) {
	$tsd_title = tsd_t( 'Search: ', 'অনুসন্ধান: ' ) . esc_html( get_search_query() );
	$tsd_sub   = '';
} elseif ( is_archive() ) {
	$tsd_title = esc_html( wp_strip_all_tags( get_the_archive_title() ) );
	$tsd_sub   = '';
} else {
	$tsd_title = tsd_t( 'Latest Bites', 'সর্বশেষ খবর' );
	$tsd_sub   = '';
}
?>
<header class="archive-head <?php echo esc_attr( $tsd_head_class ); ?>">
	<h1><?php echo $tsd_title; // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
	<?php if ( $tsd_sub ) : ?>
		<p><?php echo $tsd_sub; // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
	<?php endif; ?>
</header>

<?php if ( have_posts() ) : ?>
	<div class="grid">
		<?php
		while ( have_posts() ) :
			the_post();
			tsd_card();
		endwhile;
		?>
	</div>
	<?php
	the_posts_pagination(
		array(
			'mid_size'  => 1,
			'prev_text' => '←',
			'next_text' => '→',
		)
	);
else :
	?>
	<div class="empty">
		<h2><?php tsd_e( 'Nothing found', 'কিছু পাওয়া যায়নি' ); ?></h2>
		<p><?php tsd_e( 'Try another search or browse a section above.', 'অন্য কিছু খুঁজুন অথবা উপরের বিভাগ দেখুন।' ); ?></p>
	</div>
	<?php
endif;

get_footer();
