<?php
/**
 * Footer.
 *
 * @package thesocialdust
 */
?>
	</div><!-- .wrap -->
</main>

<?php get_template_part( 'template-parts/newsletter' ); ?>

<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div>
				<img class="footer-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-white.png' ); ?>" width="669" height="240" alt="The Social Dust" loading="lazy">
				<p><?php tsd_e( get_theme_mod( 'tsd_about_en', 'Bite-size news from Bangladesh and the world. Fast, clear, and straight from social.' ), get_theme_mod( 'tsd_about_bn', 'বাংলাদেশ ও বিশ্বের সংক্ষিপ্ত খবর। দ্রুত, স্পষ্ট, সরাসরি সোশ্যাল মিডিয়া থেকে।' ) ); ?></p>
				<h4 class="follow-title"><?php tsd_e( 'Follow us', 'আমাদের ফলো করুন' ); ?></h4>
				<div class="socials">
					<?php
					foreach ( tsd_social_networks() as $tsd_id => $tsd_label ) :
						$tsd_url = tsd_social_link( $tsd_id );
						if ( $tsd_url ) :
							?>
							<a href="<?php echo esc_url( $tsd_url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $tsd_label ); ?>"><?php echo tsd_social_icon( $tsd_id ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $tsd_label ); ?></span></a>
							<?php
						endif;
					endforeach;
					?>
				</div>
			</div>
			<div>
				<h4><?php tsd_e( 'Sections', 'বিভাগ' ); ?></h4>
				<ul>
					<?php
					foreach ( tsd_categories() as $tsd_slug => $tsd_names ) :
						$tsd_term = get_term_by( 'slug', $tsd_slug, 'category' );
						if ( $tsd_term ) :
							?>
							<li><a href="<?php echo esc_url( get_category_link( $tsd_term ) ); ?>"><?php echo tsd_cat_name_html( $tsd_term ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
			</div>
			<div>
				<h4><?php tsd_e( 'About', 'আমাদের সম্পর্কে' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'depth'          => 1,
						)
					);
				} else {
					echo '<ul>';
					$tsd_about = get_page_by_path( 'about' );
					if ( $tsd_about ) {
						echo '<li><a href="' . esc_url( get_permalink( $tsd_about ) ) . '">' . tsd_t( 'About The Social Dust', 'দ্য সোশ্যাল ডাস্ট সম্পর্কে' ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
					}
					echo '<li><a href="' . esc_url( tsd_contact_url() ) . '">' . tsd_t( 'Contact Us', 'যোগাযোগ' ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
					echo '<li><a href="' . esc_url( tsd_contact_url( 'advertising' ) ) . '">' . tsd_t( 'Advertise with us', 'বিজ্ঞাপন দিন' ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
					echo '<li><a href="#newsletter">' . tsd_t( 'Newsletter', 'নিউজলেটার' ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
					echo '<li class="footer-mail"><a href="mailto:hello@thesocialdust.com">hello@thesocialdust.com</a></li>';
					echo '<li class="footer-mail"><a href="mailto:ad@thesocialdust.com">ad@thesocialdust.com</a></li>';
					echo '</ul>';
				}
				?>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> The Social Dust. <?php tsd_e( 'All rights reserved.', 'সর্বস্বত্ব সংরক্ষিত।' ); ?></span>
			<span class="footer-links">
				<?php
				$tsd_privacy = get_page_by_path( 'privacy-policy' );
				if ( $tsd_privacy && 'publish' === $tsd_privacy->post_status ) :
					?>
					<a href="<?php echo esc_url( get_permalink( $tsd_privacy ) ); ?>"><?php tsd_e( 'Privacy Policy', 'গোপনীয়তা নীতি' ); ?></a>
				<?php endif; ?>
				<?php
				$tsd_terms = get_page_by_path( 'terms-and-conditions' );
				if ( $tsd_terms && 'publish' === $tsd_terms->post_status ) :
					?>
					<a href="<?php echo esc_url( get_permalink( $tsd_terms ) ); ?>"><?php tsd_e( 'Terms & Conditions', 'শর্তাবলি' ); ?></a>
				<?php endif; ?>
				<span><?php tsd_e( 'News summarised from original sources, linked on every story.', 'প্রতিটি খবরে মূল সূত্রের লিংক দেওয়া আছে।' ); ?></span>
			</span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
