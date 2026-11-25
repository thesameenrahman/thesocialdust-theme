<?php
/**
 * Single news story.
 *
 * @package thesocialdust
 */
get_header();

while ( have_posts() ) :
	the_post();
	$tsd_id     = get_the_ID();
	$tsd_cat    = tsd_post_cat();
	$tsd_src    = get_post_meta( $tsd_id, 'tsd_source_name', true );
	$tsd_srcurl = get_post_meta( $tsd_id, 'tsd_source_url', true );
	$tsd_credit = get_post_meta( $tsd_id, 'tsd_image_credit', true );
	$tsd_social = get_post_meta( $tsd_id, 'tsd_social_url', true );
	$tsd_bn     = get_post_meta( $tsd_id, 'tsd_content_bn', true );
	$tsd_url    = rawurlencode( get_permalink() );
	$tsd_ttl    = rawurlencode( get_the_title() );
	?>
	<article <?php post_class( 'single-wrap ' . ( $tsd_cat ? 'cat-' . $tsd_cat->slug : '' ) ); ?>>
		<?php echo tsd_pill( $tsd_cat, true ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<h1 class="single-title"><?php echo tsd_title_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
		<div class="meta">
			<?php echo tsd_time_ago(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo tsd_via_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="single-media"><?php the_post_thumbnail( 'large', array( 'fetchpriority' => 'high' ) ); ?></figure>
			<?php if ( $tsd_credit ) : ?>
				<div class="credit"><?php tsd_e( 'Image', 'ছবি' ); ?> - <?php echo esc_html( $tsd_credit ); ?></div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="bite-box">
			<b><?php tsd_e( 'In a bite', 'এক নজরে' ); ?></b>
			<?php echo tsd_bite_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>

		<div class="entry">
			<div class="<?php echo $tsd_bn ? 't-en' : ''; ?>"><?php the_content(); ?></div>
			<?php if ( $tsd_bn ) : ?>
				<div class="t-bn" lang="bn"><?php echo wp_kses_post( wpautop( $tsd_bn ) ); ?></div>
			<?php endif; ?>
		</div>

		<?php if ( $tsd_src || $tsd_srcurl || $tsd_social ) : ?>
			<div class="source-box">
				<div>
					<strong><?php tsd_e( 'Original source', 'মূল সূত্র' ); ?>:</strong>
					<?php echo esc_html( $tsd_src ? $tsd_src : wp_parse_url( $tsd_srcurl, PHP_URL_HOST ) ); ?>
				</div>
				<div style="display:flex;gap:8px;flex-wrap:wrap">
					<?php if ( $tsd_srcurl ) : ?>
						<a class="btn" href="<?php echo esc_url( $tsd_srcurl ); ?>" target="_blank" rel="noopener nofollow"><?php tsd_e( 'Read full story ↗', 'পুরো খবর পড়ুন ↗' ); ?></a>
					<?php endif; ?>
					<?php if ( $tsd_social ) : ?>
						<a class="btn" href="<?php echo esc_url( $tsd_social ); ?>" target="_blank" rel="noopener"><?php tsd_e( 'See the post ↗', 'পোস্টটি দেখুন ↗' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="share">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( $tsd_url ); ?>" target="_blank" rel="noopener">Facebook</a>
			<a href="https://wa.me/?text=<?php echo esc_attr( $tsd_ttl . '%20' . $tsd_url ); ?>" target="_blank" rel="noopener">WhatsApp</a>
			<a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr( $tsd_url ); ?>&amp;text=<?php echo esc_attr( $tsd_ttl ); ?>" target="_blank" rel="noopener">X</a>
			<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_attr( $tsd_url ); ?>" target="_blank" rel="noopener">LinkedIn</a>
			<button type="button" class="copy-link" data-url="<?php the_permalink(); ?>"><span class="t-en">Copy link</span><span class="t-bn">লিংক কপি</span></button>
		</div>

		<?php
		$tsd_tags = get_the_tags();
		if ( $tsd_tags ) :
			?>
			<div class="tags">
				<?php foreach ( $tsd_tags as $tsd_tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tsd_tag ) ); ?>">#<?php echo esc_html( $tsd_tag->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</article>

	<?php
	if ( $tsd_cat ) :
		$tsd_rel = new WP_Query(
			array(
				'posts_per_page'      => 4,
				'cat'                 => $tsd_cat->term_id,
				'post__not_in'        => array( $tsd_id ),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( $tsd_rel->have_posts() ) :
			?>
			<section class="section cat-<?php echo esc_attr( $tsd_cat->slug ); ?>" style="margin-top:50px">
				<div class="section-head">
					<h2 class="section-title"><?php tsd_e( 'More from ', 'আরও খবর: ' ); ?><?php echo tsd_cat_name_html( $tsd_cat ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
				</div>
				<div class="grid">
					<?php
					while ( $tsd_rel->have_posts() ) :
						$tsd_rel->the_post();
						tsd_card();
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</section>
			<?php
		endif;
	endif;
endwhile;

get_footer();
