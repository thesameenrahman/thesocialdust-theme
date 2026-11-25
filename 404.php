<?php
/**
 * 404.
 *
 * @package thesocialdust
 */
get_header();
?>
<div class="empty">
	<h1 class="single-title">404</h1>
	<p><?php tsd_e( 'This story has blown away like dust.', 'খবরটি ধুলোর মতো উড়ে গেছে।' ); ?></p>
	<p><a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php tsd_e( 'Back to home', 'প্রচ্ছদে ফিরুন' ); ?></a></p>
</div>
<?php
get_footer();
