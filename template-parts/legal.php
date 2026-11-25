<?php
/**
 * Shared layout for bilingual legal pages (Privacy Policy, Terms & Conditions).
 *
 * $args: title [en, bn], subtitle [en, bn], updated [en, bn], note_bn (string), sections (array).
 * Section: [ anchor, title_en, title_bn, blocks ].
 * Block types: p, h3, strong (yellow callout), email (text + contact email), contact (contact card),
 * privacy (text + link to the Privacy Policy), ul (items [en, bn] or [label_en, text_en, label_bn, text_bn]).
 *
 * @package thesocialdust
 */
$tsd_email      = 'hello@thesocialdust.com';
$tsd_email_html = '<a href="mailto:' . esc_attr( $tsd_email ) . '">' . esc_html( $tsd_email ) . '</a>';
$tsd_pp         = get_page_by_path( 'privacy-policy' );
$tsd_pp_url     = $tsd_pp ? get_permalink( $tsd_pp ) : home_url( '/privacy-policy/' );
?>
<article class="legal">

	<header class="legal-hero">
		<h1><?php tsd_e( $args['title'][0], $args['title'][1] ); ?></h1>
		<p class="legal-sub"><?php tsd_e( $args['subtitle'][0], $args['subtitle'][1] ); ?></p>
		<p class="legal-date"><?php tsd_e( $args['updated'][0], $args['updated'][1] ); ?></p>
	</header>

	<?php if ( ! empty( $args['note_bn'] ) ) : ?>
		<p class="legal-note t-bn" lang="bn"><?php echo esc_html( $args['note_bn'] ); ?></p>
	<?php endif; ?>

	<div class="legal-layout">
		<nav class="legal-toc" aria-label="Contents">
			<b><?php tsd_e( 'Contents', 'সূচিপত্র' ); ?></b>
			<ol>
				<?php foreach ( $args['sections'] as $tsd_s ) : ?>
					<li><a href="#<?php echo esc_attr( $tsd_s[0] ); ?>"><?php tsd_e( $tsd_s[1], $tsd_s[2] ); ?></a></li>
				<?php endforeach; ?>
			</ol>
		</nav>

		<div class="legal-body entry">
			<?php
			foreach ( $args['sections'] as $tsd_i => $tsd_s ) :
				$tsd_num = sprintf( '%02d', $tsd_i + 1 );
				?>
				<section id="<?php echo esc_attr( $tsd_s[0] ); ?>">
					<h2><span class="legal-num"><?php echo tsd_t( esc_html( $tsd_num ), esc_html( tsd_bn_digits( $tsd_num ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span> <?php tsd_e( $tsd_s[1], $tsd_s[2] ); ?></h2>
					<?php
					foreach ( $tsd_s[3] as $tsd_b ) {
						switch ( $tsd_b[0] ) {
							case 'h3':
								echo '<h3>' . tsd_t( esc_html( $tsd_b[1] ), esc_html( $tsd_b[2] ) ) . '</h3>'; // phpcs:ignore WordPress.Security.EscapeOutput
								break;
							case 'strong':
								echo '<p class="legal-callout">' . tsd_t( esc_html( $tsd_b[1] ), esc_html( $tsd_b[2] ) ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput
								break;
							case 'email':
								echo '<p>' . tsd_t( esc_html( $tsd_b[1] ), esc_html( $tsd_b[2] ) ) . ' <strong>' . $tsd_email_html . '</strong>.</p>'; // phpcs:ignore WordPress.Security.EscapeOutput
								break;
							case 'privacy':
								echo '<p>' . tsd_t( esc_html( $tsd_b[1] ), esc_html( $tsd_b[2] ) ) . ' <a href="' . esc_url( $tsd_pp_url ) . '">' . tsd_t( 'Read our Privacy Policy →', 'আমাদের গোপনীয়তা নীতি পড়ুন →' ) . '</a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput
								break;
							case 'contact':
								echo '<div class="legal-contact"><strong>' . tsd_t( 'The Social Dust', 'দ্য সোশ্যাল ডাস্ট' ) . '</strong>'; // phpcs:ignore WordPress.Security.EscapeOutput
								echo '<span>' . tsd_t( 'Website', 'ওয়েবসাইট' ) . ': <a href="https://www.thesocialdust.com">www.thesocialdust.com</a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput
								echo '<span>' . tsd_t( 'Email', 'ইমেইল' ) . ': ' . $tsd_email_html . '</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput
								break;
							case 'ul':
								echo '<ul>';
								foreach ( $tsd_b[1] as $tsd_item ) {
									if ( 4 === count( $tsd_item ) ) {
										echo '<li>' . tsd_t( '<strong>' . esc_html( $tsd_item[0] ) . ':</strong> ' . esc_html( $tsd_item[1] ), '<strong>' . esc_html( $tsd_item[2] ) . ':</strong> ' . esc_html( $tsd_item[3] ) ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput
									} else {
										echo '<li>' . tsd_t( esc_html( $tsd_item[0] ), esc_html( $tsd_item[1] ) ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput
									}
								}
								echo '</ul>';
								break;
							default:
								echo '<p>' . tsd_t( esc_html( $tsd_b[1] ), esc_html( $tsd_b[2] ) ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput
						}
					}
					?>
				</section>
			<?php endforeach; ?>

			<div class="legal-end">
				<p class="about-sign"><?php echo tsd_t( 'The Social Dust: <mark>Your world, in every scroll.</mark>', 'দ্য সোশ্যাল ডাস্ট: <mark>আপনার পৃথিবী, প্রতিটি স্ক্রলে।</mark>' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
				<p>&copy; 2026 The Social Dust. <?php tsd_e( 'All rights reserved.', 'সর্বস্বত্ব সংরক্ষিত।' ); ?></p>
			</div>
		</div>
	</div>
</article>
