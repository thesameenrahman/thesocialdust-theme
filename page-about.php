<?php
/**
 * About page. WordPress uses this automatically for the page with the slug "about".
 * Text is bilingual; the EN / বাং switch shows the active language.
 *
 * @package thesocialdust
 */
get_header();

$tsd_cover = array(
	'business' => array(
		'The latest developments in business, entrepreneurship, startups, markets, brands, and the global economy.',
		'ব্যবসা, উদ্যোক্তা, স্টার্টআপ, বাজার, ব্র্যান্ড ও বৈশ্বিক অর্থনীতির সর্বশেষ খবর।',
	),
	'tech'     => array(
		'Innovations, artificial intelligence, digital trends, gadgets, and the technologies shaping tomorrow.',
		'উদ্ভাবন, কৃত্রিম বুদ্ধিমত্তা, ডিজিটাল ট্রেন্ড, গ্যাজেট এবং আগামীর প্রযুক্তি।',
	),
	'youth'    => array(
		'Young achievers, opportunities, education, initiatives, ideas, and stories inspiring the next generation.',
		'তরুণ সাফল্য, সুযোগ, শিক্ষা, উদ্যোগ, নতুন ভাবনা এবং পরের প্রজন্মকে অনুপ্রাণিত করা গল্প।',
	),
	'sports'   => array(
		'Sporting events, athletes, major achievements, records, competitions, and moments that bring people together.',
		'খেলার আসর, খেলোয়াড়, বড় অর্জন, রেকর্ড, প্রতিযোগিতা এবং মানুষকে এক করে এমন মুহূর্ত।',
	),
	'health'   => array(
		'Health developments, wellness, fitness, medical breakthroughs, and information that matters to everyday life.',
		'স্বাস্থ্যের খবর, সুস্থতা, ফিটনেস, চিকিৎসাবিজ্ঞানের অগ্রগতি এবং দৈনন্দিন জীবনের জরুরি তথ্য।',
	),
	'world'    => array(
		'Global news, international affairs, major events, and stories shaping our world.',
		'বিশ্বের খবর, আন্তর্জাতিক বিষয়, বড় ঘটনা এবং আমাদের পৃথিবীকে বদলে দেওয়া গল্প।',
	),
);

$tsd_approach = array(
	array( 'Bite-sized storytelling', 'Making news easy and quick to consume.', 'সংক্ষিপ্ত উপস্থাপন', 'খবরকে সহজ ও দ্রুত পড়ার উপযোগী করা।' ),
	array( 'Relevance', 'Focusing on stories that matter to our audience.', 'প্রাসঙ্গিকতা', 'পাঠকের কাছে যে খবর গুরুত্বপূর্ণ, সেদিকে মনোযোগ।' ),
	array( 'Clarity', 'Presenting information in a simple, understandable format.', 'স্পষ্টতা', 'তথ্যকে সহজ ও বোধগম্যভাবে তুলে ধরা।' ),
	array( 'Credibility', 'Prioritizing reliable sources and responsible reporting.', 'বিশ্বাসযোগ্যতা', 'নির্ভরযোগ্য সূত্র ও দায়িত্বশীল সাংবাদিকতাকে অগ্রাধিকার।' ),
	array( 'Digital-first thinking', "Creating content designed for today's online world.", 'ডিজিটাল-প্রথম ভাবনা', 'আজকের অনলাইন দুনিয়ার জন্য তৈরি কনটেন্ট।' ),
);
?>
<article class="about">

	<section class="about-hero">
		<img class="about-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-white.png' ); ?>" width="669" height="240" alt="The Social Dust">
		<h1><?php tsd_e( 'About The Social Dust', 'দ্য সোশ্যাল ডাস্ট সম্পর্কে' ); ?></h1>
		<p class="about-tagline"><?php echo tsd_t( 'Your world, in <mark>every scroll.</mark>', 'আপনার পৃথিবী, <mark>প্রতিটি স্ক্রলে।</mark>' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
	</section>

	<section class="about-intro">
		<p class="about-lead"><?php tsd_e( 'The Social Dust is a digital-first media platform bringing you the latest news, trending stories, and important developments from Bangladesh and around the world.', 'দ্য সোশ্যাল ডাস্ট একটি ডিজিটাল-প্রথম মিডিয়া প্ল্যাটফর্ম, যা বাংলাদেশ ও সারা বিশ্বের সর্বশেষ খবর, আলোচিত গল্প এবং গুরুত্বপূর্ণ ঘটনাপ্রবাহ আপনার কাছে পৌঁছে দেয়।' ); ?></p>
		<p><?php tsd_e( "In a world where information moves faster than ever, we make staying informed simple, accessible, and engaging. From breaking news and emerging trends to stories shaping industries, communities, and the future, we deliver information in bite-sized formats designed for today's digital audience.", 'যে পৃথিবীতে তথ্য আগের চেয়ে অনেক দ্রুত ছোটে, সেখানে আমরা খবর জানাকে করি সহজ, সবার নাগালে এবং আকর্ষণীয়। ব্রেকিং নিউজ ও নতুন ট্রেন্ড থেকে শুরু করে শিল্প, সমাজ ও ভবিষ্যৎ গড়ে তোলা গল্প পর্যন্ত, আজকের ডিজিটাল পাঠকের জন্য আমরা তথ্য দিই সংক্ষিপ্ত আকারে।' ); ?></p>
		<p><?php tsd_e( "Whether it's business, technology, youth, sports, health, or world affairs, we bring the stories that matter straight to your feed.", 'ব্যবসা, প্রযুক্তি, তারুণ্য, খেলা, স্বাস্থ্য কিংবা বিশ্ব, গুরুত্বপূর্ণ সব খবর আমরা সরাসরি নিয়ে আসি আপনার ফিডে।' ); ?></p>
	</section>

	<section class="about-band">
		<div class="about-cols">
			<div>
				<h2><?php tsd_e( 'Our Purpose', 'আমাদের লক্ষ্য' ); ?></h2>
				<p class="about-quote"><?php tsd_e( 'We believe staying informed should be effortless.', 'আমরা বিশ্বাস করি, খবর জানা হওয়া উচিত অনায়াস।' ); ?></p>
			</div>
			<div>
				<p><?php tsd_e( "Our purpose is to make news and information more accessible to everyone by transforming complex stories into concise, engaging, and easy-to-understand content. We want to help our audience stay connected to the world, discover new perspectives, and understand what's happening beyond their everyday lives.", 'জটিল খবরকে সংক্ষিপ্ত, আকর্ষণীয় ও সহজবোধ্য কনটেন্টে রূপ দিয়ে সংবাদ ও তথ্যকে সবার কাছে আরও সহজলভ্য করাই আমাদের লক্ষ্য। আমরা চাই আমাদের পাঠক বিশ্বের সঙ্গে যুক্ত থাকুক, নতুন দৃষ্টিভঙ্গি খুঁজে পাক এবং নিজের দৈনন্দিন জীবনের বাইরে কী ঘটছে তা বুঝতে পারুক।' ); ?></p>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="section-head"><h2 class="section-title"><?php tsd_e( 'What We Cover', 'আমরা যা নিয়ে কাজ করি' ); ?></h2></div>
		<div class="grid grid-3 about-cover">
			<?php
			foreach ( tsd_categories() as $tsd_slug => $tsd_names ) :
				$tsd_term = get_term_by( 'slug', $tsd_slug, 'category' );
				$tsd_link = $tsd_term ? get_category_link( $tsd_term ) : '#';
				?>
				<a class="cover-card cat-<?php echo esc_attr( $tsd_slug ); ?>" href="<?php echo esc_url( $tsd_link ); ?>">
					<span class="pill"><?php tsd_e( $tsd_names[0], $tsd_names[1] ); ?></span>
					<p><?php tsd_e( $tsd_cover[ $tsd_slug ][0], $tsd_cover[ $tsd_slug ][1] ); ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="about-intro">
		<h2><?php tsd_e( 'Why The Social Dust?', 'কেন দ্য সোশ্যাল ডাস্ট?' ); ?></h2>
		<p><?php tsd_e( 'Every day, millions of stories compete for our attention. Some shape our future, some spark conversations, and some simply deserve to be known.', 'প্রতিদিন লাখো গল্প আমাদের মনোযোগ কাড়তে চায়। কিছু গল্প আমাদের ভবিষ্যৎ গড়ে, কিছু আলোচনার জন্ম দেয়, আর কিছু গল্প শুধু জানার যোগ্য।' ); ?></p>
		<p><?php tsd_e( 'The Social Dust exists to bring those stories closer to you. We filter through the noise, focus on what matters, and deliver it in a format that fits your everyday scroll.', 'সেই গল্পগুলো আপনার কাছে পৌঁছে দিতেই দ্য সোশ্যাল ডাস্ট। আমরা অপ্রয়োজনীয় কোলাহল ছেঁকে ফেলি, গুরুত্বপূর্ণ বিষয়ে মনোযোগ দিই এবং তা উপস্থাপন করি আপনার প্রতিদিনের স্ক্রলের উপযোগী করে।' ); ?></p>
	</section>

	<section class="section">
		<div class="section-head"><h2 class="section-title"><?php tsd_e( 'Our Approach', 'আমাদের পদ্ধতি' ); ?></h2></div>
		<p class="about-sub"><?php tsd_e( 'We believe news should be informative without being overwhelming, engaging without being misleading, and accessible without compromising its substance.', 'আমরা বিশ্বাস করি, খবর হবে তথ্যবহুল কিন্তু ভারী নয়, আকর্ষণীয় কিন্তু বিভ্রান্তিকর নয়, এবং সহজলভ্য কিন্তু সারবস্তুহীন নয়।' ); ?></p>
		<div class="approach">
			<?php foreach ( $tsd_approach as $tsd_a ) : ?>
				<div class="approach-item">
					<h3><?php tsd_e( $tsd_a[0], $tsd_a[2] ); ?></h3>
					<p><?php tsd_e( $tsd_a[1], $tsd_a[3] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="about-close">
		<h2><?php tsd_e( 'More Than Just Headlines', 'শুধু শিরোনামের চেয়েও বেশি' ); ?></h2>
		<p><?php tsd_e( "The Social Dust is more than a news feed. It's a platform for curiosity, awareness, ideas, and conversations.", 'দ্য সোশ্যাল ডাস্ট শুধু একটি নিউজ ফিড নয়। এটি কৌতূহল, সচেতনতা, ভাবনা ও আলোচনার একটি প্ল্যাটফর্ম।' ); ?></p>
		<p><?php tsd_e( 'From the latest developments to stories worth discovering, we aim to keep you informed, connected, and in the know, one scroll at a time.', 'সর্বশেষ ঘটনা থেকে শুরু করে জানার মতো সব গল্প, প্রতিটি স্ক্রলে আমরা আপনাকে রাখতে চাই অবগত, সংযুক্ত এবং হালনাগাদ।' ); ?></p>
		<p class="about-sign"><?php echo tsd_t( 'The Social Dust: <mark>Your world, in every scroll.</mark>', 'দ্য সোশ্যাল ডাস্ট: <mark>আপনার পৃথিবী, প্রতিটি স্ক্রলে।</mark>' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
		<a class="btn btn-accent" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php tsd_e( 'Read the latest bites →', 'সর্বশেষ খবর পড়ুন →' ); ?></a>
	</section>

</article>
<?php
get_footer();
