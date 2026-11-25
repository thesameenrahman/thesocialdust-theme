<?php
/**
 * Newsletter signup band. Works with JavaScript (instant message) and without (page reload).
 *
 * @package thesocialdust
 */
$tsd_nl_status = isset( $_GET['tsd_nl'] ) ? sanitize_key( $_GET['tsd_nl'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$tsd_pp        = get_page_by_path( 'privacy-policy' );
?>
<section class="newsletter" id="newsletter" aria-labelledby="tsd-nl-title">
	<div class="wrap newsletter-inner">
		<div class="newsletter-copy">
			<h2 id="tsd-nl-title"><?php tsd_e( 'Get the day’s top bites in your inbox', 'দিনের সেরা খবর পান আপনার ইনবক্সে' ); ?></h2>
			<p><?php tsd_e( 'Business, tech, youth, sports, health and world news. Short, clear, free. Unsubscribe any time.', 'ব্যবসা, প্রযুক্তি, তারুণ্য, খেলা, স্বাস্থ্য ও বিশ্বের খবর। সংক্ষিপ্ত, স্পষ্ট, বিনামূল্যে। যেকোনো সময় আনসাবস্ক্রাইব করা যাবে।' ); ?></p>
		</div>
		<form class="newsletter-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
			<input type="hidden" name="action" value="tsd_subscribe">
			<input type="hidden" name="lang" value="en" class="nl-lang">
			<div class="nl-hp" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
			<div class="nl-row">
				<label class="screen-reader-text" for="tsd-nl-email">Email</label>
				<input type="email" id="tsd-nl-email" name="email" required autocomplete="email" placeholder="your@email.com">
				<button type="submit"><?php tsd_e( 'Subscribe', 'সাবস্ক্রাইব' ); ?></button>
			</div>
			<p class="nl-msg" role="status" aria-live="polite">
				<?php if ( 'ok' === $tsd_nl_status ) : ?>
					<span class="nl-ok"><?php tsd_e( 'You’re in! Thanks for subscribing.', 'সাবস্ক্রাইব করার জন্য ধন্যবাদ!' ); ?></span>
				<?php elseif ( 'exists' === $tsd_nl_status ) : ?>
					<span class="nl-ok"><?php tsd_e( 'You’re already subscribed.', 'আপনি আগেই সাবস্ক্রাইব করেছেন।' ); ?></span>
				<?php elseif ( 'invalid' === $tsd_nl_status ) : ?>
					<span class="nl-err"><?php tsd_e( 'Please enter a valid email address.', 'সঠিক ইমেইল ঠিকানা দিন।' ); ?></span>
				<?php elseif ( 'error' === $tsd_nl_status ) : ?>
					<span class="nl-err"><?php tsd_e( 'Something went wrong. Please try again.', 'কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।' ); ?></span>
				<?php endif; ?>
			</p>
			<p class="nl-fine">
				<?php
				tsd_e( 'By subscribing you agree to receive emails from The Social Dust.', 'সাবস্ক্রাইব করে আপনি দ্য সোশ্যাল ডাস্ট থেকে ইমেইল পেতে সম্মত হচ্ছেন।' );
				if ( $tsd_pp ) {
					echo ' <a href="' . esc_url( get_permalink( $tsd_pp ) ) . '">' . tsd_t( 'Privacy Policy', 'গোপনীয়তা নীতি' ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput
				}
				?>
			</p>
		</form>
	</div>
</section>
