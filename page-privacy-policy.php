<?php
/**
 * Privacy Policy. WordPress uses this automatically for the page with the slug "privacy-policy".
 * Text is bilingual; the English version is the governing text.
 *
 * Layout: template-parts/legal.php (block types are listed there).
 *
 * @package thesocialdust
 */
get_header();

$tsd_sections = array(
	array(
		'introduction',
		'Introduction',
		'ভূমিকা',
		array(
			array( 'p', 'The Social Dust ("we," "our," or "us") is committed to protecting the privacy of our readers, visitors, and users. This Privacy Policy explains how we collect, use, store, and protect your information when you visit our website at www.thesocialdust.com or interact with our digital platforms and services.', 'দ্য সোশ্যাল ডাস্ট ("আমরা" বা "আমাদের") পাঠক, দর্শক ও ব্যবহারকারীদের গোপনীয়তা রক্ষায় প্রতিশ্রুতিবদ্ধ। আপনি যখন www.thesocialdust.com ওয়েবসাইটে আসেন বা আমাদের ডিজিটাল প্ল্যাটফর্ম ও সেবা ব্যবহার করেন, তখন আমরা কীভাবে আপনার তথ্য সংগ্রহ, ব্যবহার, সংরক্ষণ ও সুরক্ষা করি, এই গোপনীয়তা নীতিতে তা ব্যাখ্যা করা হয়েছে।' ),
			array( 'p', 'The Social Dust is a digital-first media platform covering Business, Tech, Youth, Sports, Health, and World news.', 'দ্য সোশ্যাল ডাস্ট একটি ডিজিটাল-প্রথম মিডিয়া প্ল্যাটফর্ম, যা ব্যবসা, প্রযুক্তি, তারুণ্য, খেলা, স্বাস্থ্য ও বিশ্বের খবর প্রকাশ করে।' ),
			array( 'p', 'By accessing or using our website, you acknowledge that you have read and understood this Privacy Policy. We encourage you to review it carefully.', 'আমাদের ওয়েবসাইটে প্রবেশ বা ব্যবহারের মাধ্যমে আপনি স্বীকার করছেন যে আপনি এই গোপনীয়তা নীতি পড়েছেন ও বুঝেছেন। আমরা আপনাকে এটি মনোযোগ দিয়ে পড়ার অনুরোধ করছি।' ),
		),
	),
	array(
		'information-we-collect',
		'Information We Collect',
		'আমরা যে তথ্য সংগ্রহ করি',
		array(
			array( 'p', 'We may collect information in the following ways:', 'আমরা নিম্নলিখিত উপায়ে তথ্য সংগ্রহ করতে পারি:' ),
			array( 'h3', 'Automatically Collected Information', 'স্বয়ংক্রিয়ভাবে সংগৃহীত তথ্য' ),
			array( 'p', 'When you visit our website, certain information may be collected automatically, including:', 'আপনি আমাদের ওয়েবসাইটে এলে কিছু তথ্য স্বয়ংক্রিয়ভাবে সংগৃহীত হতে পারে, যেমন:' ),
			array(
				'ul',
				array(
					array( 'Device information, such as browser type, operating system, and device model.', 'ডিভাইসের তথ্য, যেমন ব্রাউজারের ধরন, অপারেটিং সিস্টেম ও ডিভাইসের মডেল।' ),
					array( 'IP address and approximate geographical location.', 'আইপি ঠিকানা ও আনুমানিক ভৌগোলিক অবস্থান।' ),
					array( 'Pages visited, articles viewed, and time spent on our website.', 'কোন পেজ দেখা হয়েছে, কোন খবর পড়া হয়েছে এবং ওয়েবসাইটে কত সময় কাটানো হয়েছে।' ),
					array( 'Referral sources and browsing activity.', 'কোন উৎস থেকে আসা হয়েছে এবং ব্রাউজিং কার্যক্রম।' ),
					array( 'Cookies and similar tracking technologies.', 'কুকি ও অনুরূপ ট্র্যাকিং প্রযুক্তি।' ),
				),
			),
			array( 'h3', 'Information You Provide', 'আপনার দেওয়া তথ্য' ),
			array( 'p', 'We may collect personal information that you voluntarily provide, including:', 'আপনি স্বেচ্ছায় যে ব্যক্তিগত তথ্য দেন, আমরা তা সংগ্রহ করতে পারি, যেমন:' ),
			array(
				'ul',
				array(
					array( 'Name and email address when subscribing to our newsletter.', 'নিউজলেটারে সাবস্ক্রাইব করার সময় নাম ও ইমেইল ঠিকানা।' ),
					array( 'Name, email address, organization, and message when contacting us.', 'আমাদের সঙ্গে যোগাযোগের সময় নাম, ইমেইল ঠিকানা, প্রতিষ্ঠান ও বার্তা।' ),
					array( 'Information submitted through feedback, partnership, advertising, or other inquiry forms.', 'মতামত, অংশীদারত্ব, বিজ্ঞাপন বা অন্যান্য অনুসন্ধান ফর্মের মাধ্যমে জমা দেওয়া তথ্য।' ),
					array( 'Any other information you choose to share with us.', 'আপনি আমাদের সঙ্গে শেয়ার করতে চান এমন অন্য যেকোনো তথ্য।' ),
				),
			),
			array( 'p', 'We do not intentionally request sensitive personal information through our general website forms.', 'আমাদের সাধারণ ওয়েবসাইট ফর্মের মাধ্যমে আমরা ইচ্ছাকৃতভাবে কোনো সংবেদনশীল ব্যক্তিগত তথ্য চাই না।' ),
		),
	),
	array(
		'how-we-use',
		'How We Use Your Information',
		'আমরা আপনার তথ্য যেভাবে ব্যবহার করি',
		array(
			array( 'p', 'We may use the information we collect to:', 'সংগৃহীত তথ্য আমরা যেসব কাজে ব্যবহার করতে পারি:' ),
			array(
				'ul',
				array(
					array( 'Operate, maintain, and improve our website and digital services.', 'ওয়েবসাইট ও ডিজিটাল সেবা পরিচালনা, রক্ষণাবেক্ষণ ও উন্নত করা।' ),
					array( 'Deliver relevant news, updates, and editorial content.', 'প্রাসঙ্গিক খবর, আপডেট ও সম্পাদকীয় কনটেন্ট পৌঁছে দেওয়া।' ),
					array( 'Respond to questions, feedback, and inquiries.', 'প্রশ্ন, মতামত ও অনুসন্ধানের উত্তর দেওয়া।' ),
					array( 'Send newsletters and updates to subscribers who have opted in.', 'যাঁরা সম্মতি দিয়েছেন, সেই সাবস্ক্রাইবারদের নিউজলেটার ও আপডেট পাঠানো।' ),
					array( 'Understand audience interests and website engagement.', 'পাঠকের আগ্রহ ও ওয়েবসাইটে তাঁদের সম্পৃক্ততা বোঝা।' ),
					array( 'Analyze website traffic and content performance.', 'ওয়েবসাইটের ট্রাফিক ও কনটেন্টের পারফরম্যান্স বিশ্লেষণ করা।' ),
					array( 'Improve our editorial and digital publishing strategies.', 'সম্পাদকীয় ও ডিজিটাল প্রকাশনা কৌশল উন্নত করা।' ),
					array( 'Protect our website against spam, misuse, and unauthorized access.', 'স্প্যাম, অপব্যবহার ও অননুমোদিত প্রবেশ থেকে ওয়েবসাইট সুরক্ষিত রাখা।' ),
					array( 'Comply with applicable legal and regulatory requirements.', 'প্রযোজ্য আইনগত ও নিয়ন্ত্রক বাধ্যবাধকতা মেনে চলা।' ),
				),
			),
			array( 'strong', 'We do not sell or rent your personal information to third parties.', 'আমরা আপনার ব্যক্তিগত তথ্য কোনো তৃতীয় পক্ষের কাছে বিক্রি বা ভাড়া দিই না।' ),
		),
	),
	array(
		'cookies',
		'Cookies & Tracking Technologies',
		'কুকি ও ট্র্যাকিং প্রযুক্তি',
		array(
			array( 'p', 'The Social Dust may use cookies and similar technologies to improve your browsing experience and understand how visitors interact with our website.', 'আপনার ব্রাউজিং অভিজ্ঞতা উন্নত করতে এবং দর্শকেরা ওয়েবসাইট কীভাবে ব্যবহার করেন তা বুঝতে দ্য সোশ্যাল ডাস্ট কুকি ও অনুরূপ প্রযুক্তি ব্যবহার করতে পারে।' ),
			array( 'p', 'These may include:', 'এর মধ্যে থাকতে পারে:' ),
			array(
				'ul',
				array(
					array( 'Essential Cookies', 'Help our website function properly and support basic features.', 'প্রয়োজনীয় কুকি', 'ওয়েবসাইট সঠিকভাবে চলতে ও মৌলিক ফিচারগুলো কাজ করতে সাহায্য করে।' ),
					array( 'Analytics Cookies', 'Help us understand website traffic, popular articles, visitor behavior, and audience engagement. We may use services such as Google Analytics for this purpose.', 'অ্যানালিটিক্স কুকি', 'ওয়েবসাইটের ট্রাফিক, জনপ্রিয় খবর, দর্শকের আচরণ ও সম্পৃক্ততা বুঝতে সাহায্য করে। এ জন্য আমরা গুগল অ্যানালিটিক্সের মতো সেবা ব্যবহার করতে পারি।' ),
					array( 'Advertising Cookies', 'If advertising services are implemented, these technologies may be used to measure advertising performance and deliver relevant advertisements.', 'বিজ্ঞাপন কুকি', 'বিজ্ঞাপন সেবা চালু হলে, বিজ্ঞাপনের কার্যকারিতা পরিমাপ ও প্রাসঙ্গিক বিজ্ঞাপন দেখাতে এই প্রযুক্তি ব্যবহৃত হতে পারে।' ),
				),
			),
			array( 'p', 'You can manage or disable cookies through your browser settings. Please note that disabling certain cookies may affect some website functionalities.', 'ব্রাউজারের সেটিংস থেকে আপনি কুকি নিয়ন্ত্রণ বা বন্ধ করতে পারেন। মনে রাখবেন, কিছু কুকি বন্ধ করলে ওয়েবসাইটের কিছু ফিচার ঠিকমতো কাজ নাও করতে পারে।' ),
		),
	),
	array(
		'third-party-services',
		'Third-Party Services',
		'তৃতীয় পক্ষের সেবা',
		array(
			array( 'p', 'To operate and improve our platform, we may use trusted third-party services, including:', 'প্ল্যাটফর্ম পরিচালনা ও উন্নত করতে আমরা বিশ্বস্ত তৃতীয় পক্ষের সেবা ব্যবহার করতে পারি, যেমন:' ),
			array(
				'ul',
				array(
					array( 'Google Analytics', 'For website traffic analysis and audience insights.', 'গুগল অ্যানালিটিক্স', 'ওয়েবসাইটের ট্রাফিক বিশ্লেষণ ও পাঠক সম্পর্কে ধারণা পেতে।' ),
					array( 'Google Services', 'For analytics, advertising, and other website-related services, where applicable.', 'গুগল সেবা', 'প্রযোজ্য ক্ষেত্রে অ্যানালিটিক্স, বিজ্ঞাপন ও ওয়েবসাইট-সংক্রান্ত অন্যান্য সেবার জন্য।' ),
					array( 'Email Service Providers', 'For newsletter distribution and communication.', 'ইমেইল সেবাদাতা', 'নিউজলেটার পাঠানো ও যোগাযোগের জন্য।' ),
					array( 'Cloud Hosting Providers', 'For website hosting, storage, and infrastructure.', 'ক্লাউড হোস্টিং সেবাদাতা', 'ওয়েবসাইট হোস্টিং, সংরক্ষণ ও অবকাঠামোর জন্য।' ),
					array( 'Social Media Platforms', 'For content sharing, audience engagement, and embedded media.', 'সোশ্যাল মিডিয়া প্ল্যাটফর্ম', 'কনটেন্ট শেয়ার, পাঠকের সঙ্গে সংযোগ ও এমবেড করা মিডিয়ার জন্য।' ),
				),
			),
			array( 'p', 'These third-party services may collect or process information according to their own privacy policies.', 'এসব তৃতীয় পক্ষের সেবা তাদের নিজস্ব গোপনীয়তা নীতি অনুযায়ী তথ্য সংগ্রহ বা প্রক্রিয়া করতে পারে।' ),
			array( 'p', 'We encourage users to review the privacy policies of relevant third-party providers. The Social Dust does not control the privacy practices of external websites or services.', 'সংশ্লিষ্ট তৃতীয় পক্ষের গোপনীয়তা নীতি পড়ে দেখার জন্য আমরা ব্যবহারকারীদের উৎসাহিত করি। বাইরের ওয়েবসাইট বা সেবার গোপনীয়তা চর্চা দ্য সোশ্যাল ডাস্ট নিয়ন্ত্রণ করে না।' ),
		),
	),
	array(
		'data-retention',
		'Data Retention',
		'তথ্য সংরক্ষণের মেয়াদ',
		array(
			array( 'p', 'We retain personal information only for as long as reasonably necessary to fulfill the purposes described in this Privacy Policy or to meet applicable legal requirements.', 'এই নীতিতে বর্ণিত উদ্দেশ্য পূরণ বা প্রযোজ্য আইনি বাধ্যবাধকতা মানতে যতদিন যুক্তিসঙ্গতভাবে প্রয়োজন, শুধু ততদিনই আমরা ব্যক্তিগত তথ্য সংরক্ষণ করি।' ),
			array( 'p', 'Our general retention practices may include:', 'আমাদের সাধারণ সংরক্ষণ চর্চার মধ্যে থাকতে পারে:' ),
			array(
				'ul',
				array(
					array( 'Newsletter Subscriptions', 'Retained until you unsubscribe or request removal.', 'নিউজলেটার সাবস্ক্রিপশন', 'আপনি আনসাবস্ক্রাইব বা মুছে ফেলার অনুরোধ না করা পর্যন্ত সংরক্ষিত থাকে।' ),
					array( 'Contact Inquiries', 'Retained for as long as necessary to respond and maintain relevant communication.', 'যোগাযোগের অনুরোধ', 'উত্তর দেওয়া ও প্রাসঙ্গিক যোগাযোগ বজায় রাখতে যতদিন প্রয়োজন, ততদিন সংরক্ষিত থাকে।' ),
					array( 'Partnership & Advertising Inquiries', 'Retained as necessary for business communication and follow-up.', 'অংশীদারত্ব ও বিজ্ঞাপন-সংক্রান্ত অনুরোধ', 'ব্যবসায়িক যোগাযোগ ও ফলো-আপের জন্য প্রয়োজন অনুযায়ী সংরক্ষিত থাকে।' ),
					array( 'Analytics Data', 'Retained according to the settings and policies of the relevant analytics provider.', 'অ্যানালিটিক্স তথ্য', 'সংশ্লিষ্ট অ্যানালিটিক্স সেবাদাতার সেটিংস ও নীতি অনুযায়ী সংরক্ষিত থাকে।' ),
				),
			),
			array( 'p', 'You may request the deletion of your personal information by contacting us.', 'আমাদের সঙ্গে যোগাযোগ করে আপনি আপনার ব্যক্তিগত তথ্য মুছে ফেলার অনুরোধ করতে পারেন।' ),
		),
	),
	array(
		'data-security',
		'Data Security',
		'তথ্যের নিরাপত্তা',
		array(
			array( 'p', 'We take reasonable technical and organizational measures to protect personal information against unauthorized access, disclosure, alteration, misuse, or loss.', 'অননুমোদিত প্রবেশ, প্রকাশ, পরিবর্তন, অপব্যবহার বা হারানো থেকে ব্যক্তিগত তথ্য সুরক্ষিত রাখতে আমরা যুক্তিসঙ্গত কারিগরি ও সাংগঠনিক ব্যবস্থা নিই।' ),
			array( 'p', 'These measures may include:', 'এসব ব্যবস্থার মধ্যে থাকতে পারে:' ),
			array(
				'ul',
				array(
					array( 'Secure website connections through HTTPS.', 'HTTPS-এর মাধ্যমে নিরাপদ ওয়েবসাইট সংযোগ।' ),
					array( 'Access controls and restricted data access.', 'প্রবেশাধিকার নিয়ন্ত্রণ ও সীমিত তথ্য-প্রবেশ।' ),
					array( 'Secure hosting and infrastructure.', 'নিরাপদ হোস্টিং ও অবকাঠামো।' ),
					array( 'Appropriate security monitoring and maintenance.', 'যথাযথ নিরাপত্তা পর্যবেক্ষণ ও রক্ষণাবেক্ষণ।' ),
				),
			),
			array( 'p', 'However, no method of electronic transmission or storage is completely secure. While we make reasonable efforts to safeguard information, we cannot guarantee absolute security.', 'তবে ইলেকট্রনিক উপায়ে তথ্য পাঠানো বা সংরক্ষণের কোনো পদ্ধতিই সম্পূর্ণ নিরাপদ নয়। তথ্য সুরক্ষায় আমরা যুক্তিসঙ্গত চেষ্টা করলেও শতভাগ নিরাপত্তার নিশ্চয়তা দিতে পারি না।' ),
		),
	),
	array(
		'your-rights',
		'Your Privacy Rights',
		'আপনার গোপনীয়তার অধিকার',
		array(
			array( 'p', 'Depending on your location and applicable laws, you may have certain rights regarding your personal information, including:', 'আপনার অবস্থান ও প্রযোজ্য আইন অনুযায়ী, আপনার ব্যক্তিগত তথ্যের বিষয়ে আপনার কিছু অধিকার থাকতে পারে, যেমন:' ),
			array(
				'ul',
				array(
					array( 'Access', 'Request information about the personal data we hold about you.', 'জানার অধিকার', 'আপনার সম্পর্কে আমাদের কাছে কী ব্যক্তিগত তথ্য আছে তা জানতে চাওয়া।' ),
					array( 'Correction', 'Request corrections to inaccurate or incomplete information.', 'সংশোধন', 'ভুল বা অসম্পূর্ণ তথ্য সংশোধনের অনুরোধ করা।' ),
					array( 'Deletion', 'Request the deletion of your personal information.', 'মুছে ফেলা', 'আপনার ব্যক্তিগত তথ্য মুছে ফেলার অনুরোধ করা।' ),
					array( 'Withdrawal of Consent', 'Withdraw consent for certain data processing activities where applicable.', 'সম্মতি প্রত্যাহার', 'প্রযোজ্য ক্ষেত্রে নির্দিষ্ট তথ্য প্রক্রিয়াকরণে দেওয়া সম্মতি প্রত্যাহার করা।' ),
					array( 'Opt-Out', 'Unsubscribe from newsletters and promotional communications at any time.', 'অপ্ট-আউট', 'যেকোনো সময় নিউজলেটার ও প্রচারমূলক বার্তা থেকে আনসাবস্ক্রাইব করা।' ),
				),
			),
			array( 'email', 'To exercise these rights, contact us at', 'এসব অধিকার প্রয়োগ করতে যোগাযোগ করুন:' ),
			array( 'p', 'We will review and respond to legitimate privacy requests within a reasonable timeframe, subject to applicable legal requirements.', 'প্রযোজ্য আইনি বাধ্যবাধকতা সাপেক্ষে, বৈধ গোপনীয়তা-সংক্রান্ত অনুরোধ আমরা যুক্তিসঙ্গত সময়ের মধ্যে পর্যালোচনা করে উত্তর দেব।' ),
		),
	),
	array(
		'childrens-privacy',
		"Children's Privacy",
		'শিশুদের গোপনীয়তা',
		array(
			array( 'p', 'The Social Dust is intended for a general audience. We do not knowingly collect personal information from children under the age of 13 without appropriate authorization where required by law.', 'দ্য সোশ্যাল ডাস্ট সাধারণ পাঠকের জন্য। আইন অনুযায়ী যেখানে প্রয়োজন, সেখানে যথাযথ অনুমতি ছাড়া আমরা জেনেশুনে ১৩ বছরের কম বয়সী শিশুদের ব্যক্তিগত তথ্য সংগ্রহ করি না।' ),
			array( 'p', 'If we become aware that personal information has been collected from a child in circumstances that violate applicable requirements, we will take reasonable steps to address the situation and delete the information where appropriate.', 'প্রযোজ্য বিধান লঙ্ঘন করে কোনো শিশুর ব্যক্তিগত তথ্য সংগৃহীত হয়েছে বলে জানতে পারলে, আমরা বিষয়টি সমাধানে যুক্তিসঙ্গত পদক্ষেপ নেব এবং প্রয়োজনে তথ্য মুছে ফেলব।' ),
			array( 'p', 'Parents or legal guardians who believe a child has provided personal information to us may contact us for assistance.', 'কোনো শিশু আমাদের ব্যক্তিগত তথ্য দিয়েছে বলে মনে করলে বাবা-মা বা আইনগত অভিভাবক সহায়তার জন্য আমাদের সঙ্গে যোগাযোগ করতে পারেন।' ),
		),
	),
	array(
		'international-users',
		'International Users',
		'আন্তর্জাতিক ব্যবহারকারী',
		array(
			array( 'p', 'The Social Dust operates from Bangladesh and may be accessed by users from different countries.', 'দ্য সোশ্যাল ডাস্ট বাংলাদেশ থেকে পরিচালিত হয় এবং বিভিন্ন দেশের ব্যবহারকারীরা এটি ব্যবহার করতে পারেন।' ),
			array( 'p', 'If you access our website from outside Bangladesh, your information may be processed or stored in Bangladesh or other locations where our service providers operate.', 'বাংলাদেশের বাইরে থেকে ওয়েবসাইট ব্যবহার করলে আপনার তথ্য বাংলাদেশে বা আমাদের সেবাদাতারা যেসব স্থানে কাজ করেন সেখানে প্রক্রিয়া বা সংরক্ষণ করা হতে পারে।' ),
			array( 'p', 'Data protection laws may differ between countries. We take reasonable steps to handle personal information in accordance with applicable legal requirements.', 'বিভিন্ন দেশে তথ্য সুরক্ষা আইন ভিন্ন হতে পারে। প্রযোজ্য আইনি বাধ্যবাধকতা অনুযায়ী ব্যক্তিগত তথ্য ব্যবস্থাপনায় আমরা যুক্তিসঙ্গত পদক্ষেপ নিই।' ),
		),
	),
	array(
		'external-links',
		'External Links & Third-Party Content',
		'বাইরের লিংক ও তৃতীয় পক্ষের কনটেন্ট',
		array(
			array( 'p', 'Our website may contain links to external websites, news sources, social media platforms, videos, and other third-party content.', 'আমাদের ওয়েবসাইটে বাইরের ওয়েবসাইট, সংবাদ সূত্র, সোশ্যাল মিডিয়া প্ল্যাটফর্ম, ভিডিও ও অন্যান্য তৃতীয় পক্ষের কনটেন্টের লিংক থাকতে পারে।' ),
			array( 'p', 'These external websites operate independently and have their own privacy policies and practices.', 'এসব বাইরের ওয়েবসাইট স্বাধীনভাবে পরিচালিত হয় এবং তাদের নিজস্ব গোপনীয়তা নীতি ও চর্চা রয়েছে।' ),
			array( 'p', 'The Social Dust is not responsible for the privacy, security, or content practices of third-party websites. We encourage visitors to review the relevant privacy policies before sharing personal information with external platforms.', 'তৃতীয় পক্ষের ওয়েবসাইটের গোপনীয়তা, নিরাপত্তা বা কনটেন্ট চর্চার জন্য দ্য সোশ্যাল ডাস্ট দায়ী নয়। বাইরের প্ল্যাটফর্মে ব্যক্তিগত তথ্য দেওয়ার আগে সংশ্লিষ্ট গোপনীয়তা নীতি পড়ে নেওয়ার অনুরোধ রইল।' ),
		),
	),
	array(
		'changes',
		'Changes to This Privacy Policy',
		'এই গোপনীয়তা নীতির পরিবর্তন',
		array(
			array( 'p', 'We may update this Privacy Policy from time to time to reflect changes in our operations, website features, technology, or applicable legal requirements.', 'আমাদের কার্যক্রম, ওয়েবসাইটের ফিচার, প্রযুক্তি বা প্রযোজ্য আইনি বাধ্যবাধকতায় পরিবর্তন এলে আমরা সময়ে সময়ে এই গোপনীয়তা নীতি হালনাগাদ করতে পারি।' ),
			array( 'p', 'Any updates will be published on this page, along with a revised "Last Updated" date.', 'যেকোনো হালনাগাদ এই পেজে প্রকাশ করা হবে এবং "সর্বশেষ হালনাগাদ" তারিখ পরিবর্তন করা হবে।' ),
			array( 'p', 'We encourage visitors to review this page periodically to remain informed about how we protect their information.', 'আমরা কীভাবে আপনার তথ্য সুরক্ষিত রাখি সে সম্পর্কে অবগত থাকতে মাঝে মাঝে এই পেজটি দেখার অনুরোধ রইল।' ),
		),
	),
	array(
		'contact',
		'Contact Us',
		'যোগাযোগ',
		array(
			array( 'p', 'If you have any questions, concerns, or requests regarding this Privacy Policy or the way we handle your personal information, please get in touch with us.', 'এই গোপনীয়তা নীতি বা আপনার ব্যক্তিগত তথ্য ব্যবস্থাপনা নিয়ে কোনো প্রশ্ন, উদ্বেগ বা অনুরোধ থাকলে অনুগ্রহ করে আমাদের সঙ্গে যোগাযোগ করুন।' ),
			array( 'contact', '', '' ),
			array( 'p', 'We value your privacy and are committed to addressing your concerns.', 'আমরা আপনার গোপনীয়তাকে মূল্য দিই এবং আপনার উদ্বেগের সমাধানে প্রতিশ্রুতিবদ্ধ।' ),
		),
	),
);

get_template_part(
	'template-parts/legal',
	null,
	array(
		'title'    => array( 'Privacy Policy', 'গোপনীয়তা নীতি' ),
		'subtitle' => array( 'How we collect, use, and protect your information.', 'আমরা কীভাবে আপনার তথ্য সংগ্রহ, ব্যবহার ও সুরক্ষা করি।' ),
		'updated'  => array( 'Last Updated: November 25, 2026', 'সর্বশেষ হালনাগাদ: ২৫ নভেম্বর ২০২৬' ),
		'note_bn'  => 'এটি ইংরেজি গোপনীয়তা নীতির বাংলা অনুবাদ। কোনো অমিল থাকলে ইংরেজি সংস্করণ প্রাধান্য পাবে।',
		'sections' => $tsd_sections,
	)
);

get_footer();
