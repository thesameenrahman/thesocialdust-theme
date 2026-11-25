<?php
/**
 * Static pages (About, Contact, Privacy...).
 *
 * @package thesocialdust
 */
get_header();
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'single-wrap' ); ?>>
		<h1 class="single-title"><?php the_title(); ?></h1>
		<div class="entry"><?php the_content(); ?></div>
	</article>
	<?php
endwhile;
get_footer();
