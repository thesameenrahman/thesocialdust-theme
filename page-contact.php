<?php
/**
 * Contact page. WordPress uses this automatically for the page with the slug "contact".
 *
 * @package thesocialdust
 */
get_header();

$tsd_inbox  = tsd_contact_emails();
$tsd_topics = tsd_contact_topics();
// phpcs:disable WordPress.Security.NonceVerification
$tsd_pick   = isset( $_GET['topic'] ) ? sanitize_key( $_GET['topic'] ) : 'general';
$tsd_status = isset( $_GET['tsd_ct'] ) ? sanitize_key( $_GET['tsd_ct'] ) : '';
// phpcs:enable
$tsd_pp = get_page_by_path( 'privacy-policy' );
?>
<article class="contact">

	<header class="legal-hero contact-hero">
		<h1><?php tsd_e( 'Contact Us', 'যোগাযোগ' ); ?></h1>
		<p class="legal-sub"><?php tsd_e( 'Questions, news tips, feedback or partnerships: we’d love to hear from you.', 'প্রশ্ন, খবরের তথ্য, মতামত বা অংশীদারত্ব: আপনার কথা শুনতে চাই।' ); ?></p>
	</header>

	<div class="contact-layout">
		<aside class="contact-side">
			<div class="contact-card">
				<span class="contact-label"><?php tsd_e( 'General & newsroom', 'সাধারণ ও নিউজরুম' ); ?></span>
				<a class="contact-mail" href="mailto:<?php echo esc_attr( $tsd_inbox['general'] ); ?>"><?php echo esc_html( $tsd_inbox['general'] ); ?></a>
				<p><?php tsd_e( 'Questions, news tips, feedback, corrections and partnerships.', 'প্রশ্ন, খবরের তথ্য, মতামত, সংশোধন ও অংশীদারত্ব।' ); ?></p>
			</div>
			<div class="contact-card contact-card-ad">
				<span class="contact-label"><?php tsd_e( 'Advertising', 'বিজ্ঞাপন' ); ?></span>
				<a class="contact-mail" href="mailto:<?php echo esc_attr( $tsd_inbox['ads'] ); ?>"><?php echo esc_html( $tsd_inbox['ads'] ); ?></a>
				<p><?php tsd_e( 'Ads, sponsored content and brand collaborations.', 'বিজ্ঞাপন, স্পনসরড কনটেন্ট ও ব্র্যান্ড কোলাবোরেশন।' ); ?></p>
			</div>
			<div class="contact-card">
				<span class="contact-label"><?php tsd_e( 'Follow us', 'আমাদের ফলো করুন' ); ?></span>
				<div class="contact-social">
					<?php
					foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram' ) as $tsd_sid => $tsd_slabel ) :
						$tsd_surl = tsd_social_link( $tsd_sid );
						if ( $tsd_surl ) :
							?>
							<a href="<?php echo esc_url( $tsd_surl ); ?>" target="_blank" rel="noopener"><?php echo tsd_social_icon( $tsd_sid ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php echo esc_html( $tsd_slabel ); ?></a>
							<?php
						endif;
					endforeach;
					?>
				</div>
			</div>
		</aside>

		<form class="contact-form" id="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
			<h2><?php tsd_e( 'Send us a message', 'আমাদের বার্তা পাঠান' ); ?></h2>
			<input type="hidden" name="action" value="tsd_contact">
			<input type="hidden" name="lang" value="en" class="ct-lang">
			<div class="nl-hp" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

			<div class="field-row">
				<p class="field">
					<label for="ct-name"><?php tsd_e( 'Your name', 'আপনার নাম' ); ?> <span class="req">*</span></label>
					<input type="text" id="ct-name" name="name" required maxlength="120" autocomplete="name">
				</p>
				<p class="field">
					<label for="ct-email"><?php tsd_e( 'Email', 'ইমেইল' ); ?> <span class="req">*</span></label>
					<input type="email" id="ct-email" name="email" required maxlength="190" autocomplete="email">
				</p>
			</div>
			<div class="field-row">
				<p class="field">
					<label for="ct-org"><?php tsd_e( 'Organization (optional)', 'প্রতিষ্ঠান (ঐচ্ছিক)' ); ?></label>
					<input type="text" id="ct-org" name="organization" maxlength="160" autocomplete="organization">
				</p>
				<p class="field">
					<label for="ct-topic"><?php tsd_e( 'Topic', 'বিষয়' ); ?></label>
					<select id="ct-topic" name="topic">
						<?php foreach ( $tsd_topics as $tsd_key => $tsd_t ) : ?>
							<option value="<?php echo esc_attr( $tsd_key ); ?>" data-en="<?php echo esc_attr( $tsd_t[0] ); ?>" data-bn="<?php echo esc_attr( $tsd_t[1] ); ?>" <?php selected( $tsd_pick, $tsd_key ); ?>><?php echo esc_html( 'bn' === tsd_lang() ? $tsd_t[1] : $tsd_t[0] ); ?></option>
						<?php endforeach; ?>
					</select>
				</p>
			</div>
			<p class="field">
				<label for="ct-message"><?php tsd_e( 'Message', 'বার্তা' ); ?> <span class="req">*</span></label>
				<textarea id="ct-message" name="message" rows="7" required maxlength="5000"></textarea>
			</p>

			<p class="ct-route">
				<?php tsd_e( 'Your message goes to', 'আপনার বার্তা যাবে' ); ?>
				<strong class="ct-route-to" data-general="<?php echo esc_attr( $tsd_inbox['general'] ); ?>" data-ads="<?php echo esc_attr( $tsd_inbox['ads'] ); ?>"><?php echo esc_html( 'advertising' === $tsd_pick ? $tsd_inbox['ads'] : $tsd_inbox['general'] ); ?></strong>
			</p>

			<button type="submit" class="btn ct-submit"><?php tsd_e( 'Send message', 'বার্তা পাঠান' ); ?></button>

			<p class="ct-msg" role="status" aria-live="polite">
				<?php if ( 'ok' === $tsd_status ) : ?>
					<span class="nl-ok"><?php tsd_e( 'Thanks! Your message has been sent. We’ll get back to you soon.', 'ধন্যবাদ! আপনার বার্তা পাঠানো হয়েছে। শিগগিরই উত্তর দেব।' ); ?></span>
				<?php elseif ( 'invalid' === $tsd_status ) : ?>
					<span class="nl-err"><?php tsd_e( 'Please fill in your name, a valid email and a message.', 'নাম, সঠিক ইমেইল ও বার্তা লিখুন।' ); ?></span>
				<?php elseif ( 'error' === $tsd_status ) : ?>
					<span class="nl-err"><?php tsd_e( 'Sorry, it didn’t send. Please email us directly.', 'দুঃখিত, পাঠানো যায়নি। সরাসরি ইমেইল করুন।' ); ?></span>
				<?php endif; ?>
			</p>
			<?php if ( $tsd_pp ) : ?>
				<p class="nl-fine"><?php tsd_e( 'We use your details only to reply to you.', 'আপনার তথ্য শুধু উত্তর দেওয়ার জন্য ব্যবহার করা হবে।' ); ?> <a href="<?php echo esc_url( get_permalink( $tsd_pp ) ); ?>"><?php tsd_e( 'Privacy Policy', 'গোপনীয়তা নীতি' ); ?></a></p>
			<?php endif; ?>
		</form>
	</div>
</article>
<?php
get_footer();
