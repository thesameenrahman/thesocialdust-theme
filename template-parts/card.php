<?php
/**
 * News card. $args['variant'] = '' | 'row'.
 *
 * @package thesocialdust
 */
$tsd_variant = isset( $args['variant'] ) ? $args['variant'] : '';
$tsd_cat     = tsd_post_cat();
?>
<article <?php post_class( 'card ' . ( 'row' === $tsd_variant ? 'card-row ' : '' ) . ( $tsd_cat ? 'cat-' . $tsd_cat->slug : '' ) ); ?>>
	<a class="card-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'tsd-square', array( 'loading' => 'lazy', 'alt' => '' ) );
		} else {
			echo '<span class="no-thumb">TSD</span>';
		}
		?>
	</a>
	<div class="card-body">
		<?php if ( 'row' !== $tsd_variant ) : ?>
			<?php echo tsd_pill( $tsd_cat, true ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<?php endif; ?>
		<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo tsd_title_html( null, false ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></h3>
		<p class="card-bite"><?php echo tsd_bite_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
		<div class="meta">
			<?php echo tsd_time_ago(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo tsd_via_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</article>
