<?php
/**
 * Terms & Conditions. WordPress uses this automatically for the page with the slug "terms-and-conditions".
 * Text is bilingual; the English version is the governing text.
 *
 * Layout: template-parts/legal.php (block types are listed there).
 *
 * @package thesocialdust
 */
get_header();

$tsd_sections = array(
	array(
		'acceptance',
		'Acceptance of Terms',
		'শর্তাবলি গ্রহণ',
		array(
			array( 'p', 'Welcome to The Social Dust.', 'দ্য সোশ্যাল ডাস্টে আপনাকে স্বাগতম।' ),
			array( 'p', 'By accessing or using our website, www.thesocialdust.com, or engaging with any of our digital platforms, content, or services, you agree to comply with and be bound by these Terms & Conditions ("Terms").', 'আমাদের ওয়েবসাইট www.thesocialdust.com-এ প্রবেশ বা ব্যবহার করে, অথবা আমাদের যেকোনো ডিজিটাল প্ল্যাটফর্ম, কনটেন্ট বা সেবা ব্যবহার করে, আপনি এই শর্তাবলি ("শর্তাবলি") মেনে চলতে এবং এর দ্বারা আবদ্ধ থাকতে সম্মত হচ্ছেন।' ),
			array( 'p', 'If you do not agree with these Terms, please discontinue use of our website and services.', 'এই শর্তাবলির সঙ্গে একমত না হলে অনুগ্রহ করে আমাদের ওয়েবসাইট ও সেবা ব্যবহার বন্ধ করুন।' ),
			array( 'p', 'These Terms apply to all visitors, readers, users, contributors, partners, and anyone accessing our digital platforms.', 'এই শর্তাবলি সকল দর্শক, পাঠক, ব্যবহারকারী, অবদানকারী, অংশীদার এবং আমাদের ডিজিটাল প্ল্যাটফর্মে প্রবেশকারী যেকোনো ব্যক্তির জন্য প্রযোজ্য।' ),
		),
	),
	array(
		'about',
		'About The Social Dust',
		'দ্য সোশ্যাল ডাস্ট সম্পর্কে',
		array(
			array( 'p', 'The Social Dust is a digital-first media platform delivering news, trending stories, and informative content from Bangladesh and around the world.', 'দ্য সোশ্যাল ডাস্ট একটি ডিজিটাল-প্রথম মিডিয়া প্ল্যাটফর্ম, যা বাংলাদেশ ও সারা বিশ্বের খবর, আলোচিত গল্প ও তথ্যবহুল কনটেন্ট প্রকাশ করে।' ),
			array( 'p', 'Our coverage includes:', 'আমরা যেসব বিষয় নিয়ে কাজ করি:' ),
			array(
				'ul',
				array(
					array( 'Business', 'ব্যবসা' ),
					array( 'Tech', 'প্রযুক্তি' ),
					array( 'Youth', 'তারুণ্য' ),
					array( 'Sports', 'খেলা' ),
					array( 'Health', 'স্বাস্থ্য' ),
					array( 'World', 'বিশ্ব' ),
				),
			),
			array( 'p', 'Our tagline is "Your world, in every scroll."', 'আমাদের স্লোগান "আপনার পৃথিবী, প্রতিটি স্ক্রলে।"' ),
			array( 'p', 'We aim to make news and information accessible, relevant, and engaging through digital-first storytelling, bite-sized content, articles, visuals, and other media formats.', 'ডিজিটাল-প্রথম গল্প বলা, সংক্ষিপ্ত কনটেন্ট, প্রতিবেদন, ভিজ্যুয়াল ও অন্যান্য মিডিয়া ফরম্যাটের মাধ্যমে আমরা খবর ও তথ্যকে সহজলভ্য, প্রাসঙ্গিক ও আকর্ষণীয় করে তুলতে চাই।' ),
		),
	),
	array(
		'use-of-website',
		'Use of Our Website',
		'ওয়েবসাইটের ব্যবহার',
		array(
			array( 'p', 'You may access and use The Social Dust for lawful, personal, informational, and non-commercial purposes, subject to these Terms.', 'এই শর্তাবলি সাপেক্ষে আপনি দ্য সোশ্যাল ডাস্ট বৈধ, ব্যক্তিগত, তথ্যগত ও অবাণিজ্যিক উদ্দেশ্যে ব্যবহার করতে পারেন।' ),
			array( 'p', 'By using our website, you agree that you will not:', 'আমাদের ওয়েবসাইট ব্যবহার করে আপনি সম্মত হচ্ছেন যে আপনি:' ),
			array(
				'ul',
				array(
					array( 'Use our website for any unlawful, fraudulent, or harmful purpose.', 'কোনো বেআইনি, প্রতারণামূলক বা ক্ষতিকর উদ্দেশ্যে ওয়েবসাইট ব্যবহার করবেন না।' ),
					array( 'Attempt to gain unauthorized access to our website, servers, systems, or databases.', 'ওয়েবসাইট, সার্ভার, সিস্টেম বা ডেটাবেসে অননুমোদিত প্রবেশের চেষ্টা করবেন না।' ),
					array( 'Interfere with the operation, security, or functionality of our website.', 'ওয়েবসাইটের পরিচালনা, নিরাপত্তা বা কার্যকারিতায় বিঘ্ন ঘটাবেন না।' ),
					array( 'Distribute malware, viruses, or harmful code.', 'ম্যালওয়্যার, ভাইরাস বা ক্ষতিকর কোড ছড়াবেন না।' ),
					array( 'Use automated tools, bots, crawlers, or scrapers to extract content without prior written permission.', 'পূর্ব লিখিত অনুমতি ছাড়া স্বয়ংক্রিয় টুল, বট, ক্রলার বা স্ক্র্যাপার দিয়ে কনটেন্ট সংগ্রহ করবেন না।' ),
					array( 'Copy, reproduce, republish, or commercially exploit our content without authorization.', 'অনুমতি ছাড়া আমাদের কনটেন্ট কপি, পুনরুৎপাদন, পুনঃপ্রকাশ বা বাণিজ্যিকভাবে ব্যবহার করবেন না।' ),
					array( 'Misrepresent your identity or affiliation with any individual, organization, or entity.', 'নিজের পরিচয় বা কোনো ব্যক্তি, প্রতিষ্ঠান বা সংস্থার সঙ্গে সম্পর্ক নিয়ে ভুল তথ্য দেবেন না।' ),
					array( 'Submit content that is defamatory, threatening, abusive, misleading, discriminatory, or otherwise unlawful.', 'মানহানিকর, হুমকিমূলক, অবমাননাকর, বিভ্রান্তিকর, বৈষম্যমূলক বা অন্য কোনোভাবে বেআইনি কনটেন্ট জমা দেবেন না।' ),
					array( 'Engage in any activity that may compromise the rights, safety, or experience of other users.', 'অন্য ব্যবহারকারীদের অধিকার, নিরাপত্তা বা অভিজ্ঞতা ক্ষুণ্ন করতে পারে এমন কোনো কাজে যুক্ত হবেন না।' ),
				),
			),
			array( 'p', 'We reserve the right to restrict, suspend, or terminate access to our website for users who violate these Terms.', 'এই শর্তাবলি লঙ্ঘনকারী ব্যবহারকারীদের ওয়েবসাইটে প্রবেশ সীমিত, স্থগিত বা বন্ধ করার অধিকার আমরা সংরক্ষণ করি।' ),
		),
	),
	array(
		'intellectual-property',
		'Intellectual Property & Content Rights',
		'মেধাস্বত্ব ও কনটেন্টের অধিকার',
		array(
			array( 'p', 'All content published on The Social Dust, including but not limited to articles, news summaries, headlines, text, graphics, photographs, videos, logos, designs, layouts, branding, and other materials, is owned by The Social Dust, its content creators, licensors, or respective copyright holders and is protected under applicable intellectual property laws.', 'দ্য সোশ্যাল ডাস্টে প্রকাশিত সকল কনটেন্ট, যার মধ্যে প্রতিবেদন, সংবাদ সারাংশ, শিরোনাম, লেখা, গ্রাফিক্স, ছবি, ভিডিও, লোগো, ডিজাইন, লেআউট, ব্র্যান্ডিং ও অন্যান্য উপকরণ অন্তর্ভুক্ত (তবে এতে সীমাবদ্ধ নয়), দ্য সোশ্যাল ডাস্ট, এর কনটেন্ট নির্মাতা, লাইসেন্সদাতা বা সংশ্লিষ্ট কপিরাইট মালিকদের মালিকানাধীন এবং প্রযোজ্য মেধাস্বত্ব আইনে সুরক্ষিত।' ),
			array( 'p', 'You may:', 'আপনি যা করতে পারেন:' ),
			array(
				'ul',
				array(
					array( 'Read and access content for personal and informational purposes.', 'ব্যক্তিগত ও তথ্যগত উদ্দেশ্যে কনটেন্ট পড়া ও দেখা।' ),
					array( 'Share links to our published articles and website pages.', 'আমাদের প্রকাশিত প্রতিবেদন ও ওয়েবসাইটের পেজের লিংক শেয়ার করা।' ),
					array( 'Share our content on social media platforms with proper attribution and a link to the original source, where applicable.', 'প্রযোজ্য ক্ষেত্রে যথাযথ কৃতিত্ব ও মূল সূত্রের লিংকসহ সোশ্যাল মিডিয়ায় আমাদের কনটেন্ট শেয়ার করা।' ),
				),
			),
			array( 'p', 'You may not, without prior written permission:', 'পূর্ব লিখিত অনুমতি ছাড়া আপনি যা করতে পারবেন না:' ),
			array(
				'ul',
				array(
					array( 'Reproduce or republish our content in full.', 'আমাদের কনটেন্ট সম্পূর্ণভাবে পুনরুৎপাদন বা পুনঃপ্রকাশ।' ),
					array( 'Copy, distribute, or commercially exploit our content.', 'আমাদের কনটেন্ট কপি, বিতরণ বা বাণিজ্যিকভাবে ব্যবহার।' ),
					array( 'Modify, adapt, or create derivative works from our content.', 'আমাদের কনটেন্ট পরিবর্তন, রূপান্তর বা তা থেকে নতুন কাজ তৈরি।' ),
					array( 'Remove copyright notices, attribution, watermarks, or branding.', 'কপিরাইট নোটিশ, কৃতিত্ব, ওয়াটারমার্ক বা ব্র্যান্ডিং সরিয়ে ফেলা।' ),
					array( 'Use our content for commercial purposes or in competing media platforms.', 'বাণিজ্যিক উদ্দেশ্যে বা প্রতিদ্বন্দ্বী মিডিয়া প্ল্যাটফর্মে আমাদের কনটেন্ট ব্যবহার।' ),
				),
			),
			array( 'p', 'Unauthorized use of our content may result in legal action where appropriate.', 'আমাদের কনটেন্টের অননুমোদিত ব্যবহারের ক্ষেত্রে প্রয়োজনে আইনি ব্যবস্থা নেওয়া হতে পারে।' ),
		),
	),
	array(
		'editorial-disclaimer',
		'News, Editorial Content & Disclaimer',
		'সংবাদ, সম্পাদকীয় কনটেন্ট ও দায়মুক্তি',
		array(
			array( 'p', 'The Social Dust publishes news, information, summaries, explainers, commentary, and other editorial content covering various topics.', 'দ্য সোশ্যাল ডাস্ট বিভিন্ন বিষয়ে সংবাদ, তথ্য, সারাংশ, ব্যাখ্যামূলক লেখা, মন্তব্য ও অন্যান্য সম্পাদকীয় কনটেন্ট প্রকাশ করে।' ),
			array( 'p', 'We strive to provide information that is accurate, relevant, and timely. However, news and information may change rapidly, and we cannot guarantee that every published item will always be complete, accurate, current, or free from error.', 'আমরা নির্ভুল, প্রাসঙ্গিক ও সময়োপযোগী তথ্য দিতে সচেষ্ট। তবে সংবাদ ও তথ্য দ্রুত বদলাতে পারে, তাই প্রকাশিত প্রতিটি বিষয় সবসময় সম্পূর্ণ, নির্ভুল, হালনাগাদ বা ত্রুটিমুক্ত থাকবে, এমন নিশ্চয়তা আমরা দিতে পারি না।' ),
			array( 'p', 'Content published on our platform is provided for general informational and educational purposes only.', 'আমাদের প্ল্যাটফর্মে প্রকাশিত কনটেন্ট শুধু সাধারণ তথ্য ও শিক্ষামূলক উদ্দেশ্যে দেওয়া হয়।' ),
			array( 'p', 'Our content should not be considered professional advice, including but not limited to:', 'আমাদের কনটেন্টকে পেশাদার পরামর্শ হিসেবে গণ্য করা উচিত নয়, যার মধ্যে রয়েছে (তবে এতে সীমাবদ্ধ নয়):' ),
			array(
				'ul',
				array(
					array( 'Financial or investment advice.', 'আর্থিক বা বিনিয়োগ পরামর্শ।' ),
					array( 'Medical or healthcare advice.', 'চিকিৎসা বা স্বাস্থ্যসেবা পরামর্শ।' ),
					array( 'Legal advice.', 'আইনি পরামর্শ।' ),
					array( 'Professional business advice.', 'পেশাদার ব্যবসায়িক পরামর্শ।' ),
				),
			),
			array( 'p', 'Readers should consult qualified professionals before making decisions based on information published on our platform.', 'আমাদের প্ল্যাটফর্মে প্রকাশিত তথ্যের ভিত্তিতে কোনো সিদ্ধান্ত নেওয়ার আগে পাঠকদের যোগ্য পেশাদারের পরামর্শ নেওয়া উচিত।' ),
			array( 'p', 'The Social Dust shall not be responsible for decisions, actions, or outcomes arising from reliance on published content.', 'প্রকাশিত কনটেন্টের ওপর নির্ভর করে নেওয়া সিদ্ধান্ত, পদক্ষেপ বা তার ফলাফলের জন্য দ্য সোশ্যাল ডাস্ট দায়ী থাকবে না।' ),
		),
	),
	array(
		'ai-assisted-content',
		'AI-Assisted Content & Digital Media',
		'এআই-সহায়তায় তৈরি কনটেন্ট ও ডিজিটাল মিডিয়া',
		array(
			array( 'p', 'The Social Dust may use digital tools, automation, and artificial intelligence (AI) to assist with research, summarization, content preparation, graphics, editing, or other publishing processes.', 'গবেষণা, সারাংশ তৈরি, কনটেন্ট প্রস্তুতি, গ্রাফিক্স, সম্পাদনা বা অন্যান্য প্রকাশনা প্রক্রিয়ায় সহায়তার জন্য দ্য সোশ্যাল ডাস্ট ডিজিটাল টুল, অটোমেশন ও কৃত্রিম বুদ্ধিমত্তা (এআই) ব্যবহার করতে পারে।' ),
			array( 'p', 'AI-assisted tools may occasionally produce inaccurate, incomplete, or misleading information. We make reasonable efforts to review content before publication, but we do not guarantee that all AI-assisted materials are error-free.', 'এআই-সহায়ক টুল কখনো কখনো ভুল, অসম্পূর্ণ বা বিভ্রান্তিকর তথ্য দিতে পারে। প্রকাশের আগে কনটেন্ট পর্যালোচনায় আমরা যুক্তিসঙ্গত চেষ্টা করি, তবে এআই-সহায়তায় তৈরি সব উপকরণ ত্রুটিমুক্ত হবে, এমন নিশ্চয়তা দিই না।' ),
			array( 'p', 'Where appropriate, we may edit, update, correct, remove, or clarify published content.', 'প্রয়োজনে আমরা প্রকাশিত কনটেন্ট সম্পাদনা, হালনাগাদ, সংশোধন, অপসারণ বা স্পষ্ট করতে পারি।' ),
		),
	),
	array(
		'user-submissions',
		'User Submissions & Communications',
		'ব্যবহারকারীর জমা দেওয়া উপকরণ ও যোগাযোগ',
		array(
			array( 'p', 'You may contact us, submit feedback, share suggestions, provide information, or send other materials through our website, email, or digital platforms.', 'ওয়েবসাইট, ইমেইল বা ডিজিটাল প্ল্যাটফর্মের মাধ্যমে আপনি আমাদের সঙ্গে যোগাযোগ, মতামত, পরামর্শ, তথ্য বা অন্যান্য উপকরণ পাঠাতে পারেন।' ),
			array( 'p', 'By submitting content to The Social Dust, you confirm that:', 'দ্য সোশ্যাল ডাস্টে কনটেন্ট জমা দিয়ে আপনি নিশ্চিত করছেন যে:' ),
			array(
				'ul',
				array(
					array( 'You have the right and authority to submit the material.', 'উপকরণটি জমা দেওয়ার অধিকার ও কর্তৃত্ব আপনার আছে।' ),
					array( 'Your submission does not infringe any third-party rights.', 'আপনার জমা দেওয়া উপকরণ কোনো তৃতীয় পক্ষের অধিকার লঙ্ঘন করে না।' ),
					array( 'Your submission does not violate applicable laws.', 'আপনার জমা দেওয়া উপকরণ প্রযোজ্য আইন লঙ্ঘন করে না।' ),
					array( 'Your submission does not contain malicious software or harmful material.', 'আপনার জমা দেওয়া উপকরণে ক্ষতিকর সফটওয়্যার বা ক্ষতিকর কিছু নেই।' ),
				),
			),
			array( 'p', 'Unless otherwise agreed in writing, you grant The Social Dust a non-exclusive, royalty-free license to use, reproduce, publish, display, and distribute submitted material for purposes related to our platform, editorial activities, communication, or promotion.', 'লিখিতভাবে ভিন্ন কিছু সম্মত না হলে, আমাদের প্ল্যাটফর্ম, সম্পাদকীয় কার্যক্রম, যোগাযোগ বা প্রচারের উদ্দেশ্যে জমা দেওয়া উপকরণ ব্যবহার, পুনরুৎপাদন, প্রকাশ, প্রদর্শন ও বিতরণের জন্য আপনি দ্য সোশ্যাল ডাস্টকে একটি অ-একচেটিয়া, রয়্যালটিমুক্ত লাইসেন্স দিচ্ছেন।' ),
			array( 'p', 'We reserve the right to reject, edit, remove, or decline to publish any submission at our discretion.', 'নিজস্ব বিবেচনায় যেকোনো জমা দেওয়া উপকরণ প্রত্যাখ্যান, সম্পাদনা, অপসারণ বা প্রকাশ না করার অধিকার আমরা সংরক্ষণ করি।' ),
			array( 'p', 'Submitting material does not guarantee publication, acknowledgment, compensation, or any specific response.', 'উপকরণ জমা দিলেই তা প্রকাশ, স্বীকৃতি, পারিশ্রমিক বা কোনো নির্দিষ্ট উত্তরের নিশ্চয়তা দেয় না।' ),
		),
	),
	array(
		'advertising',
		'Advertising, Sponsorship & Partnerships',
		'বিজ্ঞাপন, স্পনসরশিপ ও অংশীদারত্ব',
		array(
			array( 'p', 'The Social Dust may offer advertising, sponsored content, brand collaborations, promotional campaigns, partnerships, and other commercial opportunities.', 'দ্য সোশ্যাল ডাস্ট বিজ্ঞাপন, স্পনসরড কনটেন্ট, ব্র্যান্ড কোলাবোরেশন, প্রচারণা, অংশীদারত্ব ও অন্যান্য বাণিজ্যিক সুযোগ দিতে পারে।' ),
			array( 'p', 'Sponsored or paid content may be identified through labels such as "Sponsored," "Advertisement," "Brand Collaboration," or other appropriate disclosures.', 'স্পনসরড বা অর্থের বিনিময়ে প্রকাশিত কনটেন্ট "Sponsored," "Advertisement," "Brand Collaboration" বা অন্য উপযুক্ত লেবেলের মাধ্যমে চিহ্নিত করা হতে পারে।' ),
			array( 'p', 'Commercial partnerships may be subject to separate written agreements, proposals, campaign briefs, or contractual terms.', 'বাণিজ্যিক অংশীদারত্ব আলাদা লিখিত চুক্তি, প্রস্তাবনা, ক্যাম্পেইন ব্রিফ বা চুক্তির শর্তের অধীন হতে পারে।' ),
			array( 'p', "We reserve the right to decline, modify, or discontinue any partnership, advertisement, or sponsored content that we believe is inappropriate, misleading, unlawful, or inconsistent with our platform's values.", 'যে অংশীদারত্ব, বিজ্ঞাপন বা স্পনসরড কনটেন্ট আমাদের বিবেচনায় অনুপযুক্ত, বিভ্রান্তিকর, বেআইনি বা আমাদের প্ল্যাটফর্মের মূল্যবোধের সঙ্গে সামঞ্জস্যহীন, তা প্রত্যাখ্যান, পরিবর্তন বা বন্ধ করার অধিকার আমরা সংরক্ষণ করি।' ),
		),
	),
	array(
		'third-party-links',
		'Third-Party Links & Services',
		'তৃতীয় পক্ষের লিংক ও সেবা',
		array(
			array( 'p', 'Our website and digital content may include links to third-party websites, platforms, news sources, social media pages, videos, or services.', 'আমাদের ওয়েবসাইট ও ডিজিটাল কনটেন্টে তৃতীয় পক্ষের ওয়েবসাইট, প্ল্যাটফর্ম, সংবাদ সূত্র, সোশ্যাল মিডিয়া পেজ, ভিডিও বা সেবার লিংক থাকতে পারে।' ),
			array( 'p', 'These links are provided for informational purposes and convenience. Their inclusion does not necessarily imply endorsement, approval, or affiliation.', 'এসব লিংক তথ্য ও সুবিধার জন্য দেওয়া হয়। লিংক থাকা মানেই সমর্থন, অনুমোদন বা সম্পৃক্ততা বোঝায় না।' ),
			array( 'p', 'The Social Dust does not control and is not responsible for the content, availability, security, privacy practices, accuracy, or policies of third-party websites or services.', 'তৃতীয় পক্ষের ওয়েবসাইট বা সেবার কনটেন্ট, প্রাপ্যতা, নিরাপত্তা, গোপনীয়তা চর্চা, নির্ভুলতা বা নীতি দ্য সোশ্যাল ডাস্ট নিয়ন্ত্রণ করে না এবং এর জন্য দায়ী নয়।' ),
			array( 'p', 'Accessing external websites is at your own risk. We recommend reviewing their respective terms and privacy policies.', 'বাইরের ওয়েবসাইটে প্রবেশ আপনার নিজের ঝুঁকিতে। সংশ্লিষ্ট ওয়েবসাইটের শর্তাবলি ও গোপনীয়তা নীতি পড়ে নেওয়ার পরামর্শ রইল।' ),
		),
	),
	array(
		'availability',
		'Website Availability & Modifications',
		'ওয়েবসাইটের প্রাপ্যতা ও পরিবর্তন',
		array(
			array( 'p', 'We aim to keep our website accessible and functional. However, we do not guarantee uninterrupted availability, continuous operation, or freedom from technical errors.', 'আমরা ওয়েবসাইট সচল ও ব্যবহারযোগ্য রাখতে চেষ্টা করি। তবে নিরবচ্ছিন্ন প্রাপ্যতা, ধারাবাহিক পরিচালনা বা কারিগরি ত্রুটিমুক্ত থাকার নিশ্চয়তা দিই না।' ),
			array( 'p', 'We reserve the right to:', 'আমরা যেসব অধিকার সংরক্ষণ করি:' ),
			array(
				'ul',
				array(
					array( 'Modify, update, or discontinue any website feature or service.', 'ওয়েবসাইটের যেকোনো ফিচার বা সেবা পরিবর্তন, হালনাগাদ বা বন্ধ করা।' ),
					array( 'Remove or update content without prior notice.', 'পূর্ব নোটিশ ছাড়া কনটেন্ট অপসারণ বা হালনাগাদ করা।' ),
					array( 'Restrict access to certain sections of the website.', 'ওয়েবসাইটের নির্দিষ্ট অংশে প্রবেশ সীমিত করা।' ),
					array( 'Conduct maintenance, upgrades, or technical changes.', 'রক্ষণাবেক্ষণ, আপগ্রেড বা কারিগরি পরিবর্তন করা।' ),
				),
			),
			array( 'p', 'We shall not be liable for interruptions, delays, technical issues, or temporary unavailability of our website.', 'ওয়েবসাইটে বিঘ্ন, বিলম্ব, কারিগরি সমস্যা বা সাময়িকভাবে বন্ধ থাকার জন্য আমরা দায়ী থাকব না।' ),
		),
	),
	array(
		'limitation-of-liability',
		'Limitation of Liability',
		'দায়ের সীমাবদ্ধতা',
		array(
			array( 'p', 'To the fullest extent permitted by applicable law, The Social Dust, its founders, team members, contributors, partners, and affiliates shall not be liable for any direct, indirect, incidental, consequential, special, or punitive damages arising from or related to:', 'প্রযোজ্য আইনে সর্বোচ্চ যতটুকু অনুমোদিত, ততটুকু পর্যন্ত দ্য সোশ্যাল ডাস্ট, এর প্রতিষ্ঠাতা, টিম সদস্য, অবদানকারী, অংশীদার ও সহযোগীরা নিম্নোক্ত বিষয় থেকে উদ্ভূত বা এর সঙ্গে সম্পর্কিত কোনো প্রত্যক্ষ, পরোক্ষ, আনুষঙ্গিক, পরিণামগত, বিশেষ বা শাস্তিমূলক ক্ষতির জন্য দায়ী থাকবেন না:' ),
			array(
				'ul',
				array(
					array( 'Your access to or use of our website.', 'আমাদের ওয়েবসাইটে আপনার প্রবেশ বা ব্যবহার।' ),
					array( 'Your reliance on published content or information.', 'প্রকাশিত কনটেন্ট বা তথ্যের ওপর আপনার নির্ভরতা।' ),
					array( 'Errors, omissions, inaccuracies, or outdated information.', 'ভুল, বাদ পড়া, অসঙ্গতি বা পুরোনো তথ্য।' ),
					array( 'Website interruptions, technical failures, or unavailability.', 'ওয়েবসাইটে বিঘ্ন, কারিগরি ত্রুটি বা অপ্রাপ্যতা।' ),
					array( 'Third-party websites, services, or content.', 'তৃতীয় পক্ষের ওয়েবসাইট, সেবা বা কনটেন্ট।' ),
					array( 'Unauthorized access to or alteration of information.', 'তথ্যে অননুমোদিত প্রবেশ বা পরিবর্তন।' ),
				),
			),
			array( 'p', 'You use our website and rely on its content at your own discretion and risk.', 'আপনি নিজের বিবেচনা ও ঝুঁকিতে আমাদের ওয়েবসাইট ব্যবহার করেন এবং এর কনটেন্টের ওপর নির্ভর করেন।' ),
			array( 'p', 'Nothing in these Terms shall exclude liability that cannot legally be excluded under applicable law.', 'প্রযোজ্য আইনে যে দায় বাদ দেওয়া যায় না, এই শর্তাবলির কোনো কিছুই সেই দায় বাদ দেবে না।' ),
		),
	),
	array(
		'indemnification',
		'Indemnification',
		'ক্ষতিপূরণ',
		array(
			array( 'p', 'You agree, to the extent permitted by applicable law, to indemnify and hold harmless The Social Dust, its founders, team members, contributors, and representatives against claims, liabilities, damages, losses, or expenses arising from:', 'প্রযোজ্য আইনে যতটুকু অনুমোদিত, ততটুকু পর্যন্ত আপনি সম্মত হচ্ছেন যে নিম্নোক্ত কারণে উদ্ভূত দাবি, দায়, ক্ষতি, লোকসান বা খরচের বিপরীতে দ্য সোশ্যাল ডাস্ট, এর প্রতিষ্ঠাতা, টিম সদস্য, অবদানকারী ও প্রতিনিধিদের ক্ষতিপূরণ দেবেন এবং দায়মুক্ত রাখবেন:' ),
			array(
				'ul',
				array(
					array( 'Your violation of these Terms.', 'আপনার দ্বারা এই শর্তাবলি লঙ্ঘন।' ),
					array( 'Your unlawful use of our website.', 'আপনার দ্বারা ওয়েবসাইটের বেআইনি ব্যবহার।' ),
					array( 'Your submitted content or materials.', 'আপনার জমা দেওয়া কনটেন্ট বা উপকরণ।' ),
					array( 'Your infringement of third-party rights.', 'আপনার দ্বারা তৃতীয় পক্ষের অধিকার লঙ্ঘন।' ),
					array( 'Your misuse of our services or digital platforms.', 'আপনার দ্বারা আমাদের সেবা বা ডিজিটাল প্ল্যাটফর্মের অপব্যবহার।' ),
				),
			),
		),
	),
	array(
		'privacy',
		'Privacy',
		'গোপনীয়তা',
		array(
			array( 'p', 'Your use of our website is also governed by our Privacy Policy, which explains how we collect, use, store, and protect personal information.', 'আপনার ওয়েবসাইট ব্যবহার আমাদের গোপনীয়তা নীতি দ্বারাও পরিচালিত হয়, যেখানে আমরা কীভাবে ব্যক্তিগত তথ্য সংগ্রহ, ব্যবহার, সংরক্ষণ ও সুরক্ষা করি তা ব্যাখ্যা করা হয়েছে।' ),
			array( 'privacy', 'By using our website, you acknowledge that you have reviewed our Privacy Policy.', 'আমাদের ওয়েবসাইট ব্যবহার করে আপনি স্বীকার করছেন যে আপনি আমাদের গোপনীয়তা নীতি পড়েছেন।' ),
		),
	),
	array(
		'changes',
		'Changes to These Terms',
		'শর্তাবলির পরিবর্তন',
		array(
			array( 'p', 'We reserve the right to update, revise, or modify these Terms at any time.', 'যেকোনো সময় এই শর্তাবলি হালনাগাদ, সংশোধন বা পরিবর্তনের অধিকার আমরা সংরক্ষণ করি।' ),
			array( 'p', 'Changes will become effective when published on this page, unless otherwise stated. The "Last Updated" date will be revised accordingly.', 'ভিন্নভাবে উল্লেখ না থাকলে, পরিবর্তন এই পেজে প্রকাশের সঙ্গে সঙ্গে কার্যকর হবে এবং সে অনুযায়ী "সর্বশেষ হালনাগাদ" তারিখ পরিবর্তন করা হবে।' ),
			array( 'p', 'Your continued use of our website after changes are published constitutes acceptance of the updated Terms.', 'পরিবর্তন প্রকাশের পরও ওয়েবসাইট ব্যবহার অব্যাহত রাখলে তা হালনাগাদ শর্তাবলি গ্রহণ হিসেবে গণ্য হবে।' ),
			array( 'p', 'We encourage you to review this page periodically.', 'মাঝে মাঝে এই পেজটি দেখার অনুরোধ রইল।' ),
		),
	),
	array(
		'governing-law',
		'Governing Law & Jurisdiction',
		'প্রযোজ্য আইন ও এখতিয়ার',
		array(
			array( 'p', 'These Terms & Conditions shall be governed by and construed in accordance with the laws of Bangladesh.', 'এই শর্তাবলি বাংলাদেশের আইন অনুযায়ী পরিচালিত ও ব্যাখ্যা করা হবে।' ),
			array( 'p', 'Any disputes arising out of or in connection with these Terms or your use of our website shall be subject to the jurisdiction of the competent courts of Dhaka, Bangladesh, unless otherwise required by applicable law.', 'প্রযোজ্য আইনে ভিন্ন কিছু প্রয়োজন না হলে, এই শর্তাবলি বা আমাদের ওয়েবসাইট ব্যবহার থেকে উদ্ভূত বা এর সঙ্গে সম্পর্কিত যেকোনো বিরোধ বাংলাদেশের ঢাকার উপযুক্ত আদালতের এখতিয়ারাধীন থাকবে।' ),
		),
	),
	array(
		'contact',
		'Contact Us',
		'যোগাযোগ',
		array(
			array( 'p', 'If you have any questions, concerns, or inquiries regarding these Terms & Conditions, please contact us:', 'এই শর্তাবলি নিয়ে কোনো প্রশ্ন, উদ্বেগ বা জিজ্ঞাসা থাকলে আমাদের সঙ্গে যোগাযোগ করুন:' ),
			array( 'contact', '', '' ),
		),
	),
);

get_template_part(
	'template-parts/legal',
	null,
	array(
		'title'    => array( 'Terms & Conditions', 'শর্তাবলি' ),
		'subtitle' => array( 'Terms governing your use of The Social Dust.', 'দ্য সোশ্যাল ডাস্ট ব্যবহারের শর্তাবলি।' ),
		'updated'  => array( 'Last Updated: November 25, 2026', 'সর্বশেষ হালনাগাদ: ২৫ নভেম্বর ২০২৬' ),
		'note_bn'  => 'এটি ইংরেজি শর্তাবলির বাংলা অনুবাদ। কোনো অমিল থাকলে ইংরেজি সংস্করণ প্রাধান্য পাবে।',
		'sections' => $tsd_sections,
	)
);

get_footer();
