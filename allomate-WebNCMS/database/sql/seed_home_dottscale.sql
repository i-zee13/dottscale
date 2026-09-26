-- DottScale Home Page — content copied from frontend home page
-- Option A (recommended on server): php artisan home:seed-dottscale
-- Option B: run this SQL in phpMyAdmin / mysql CLI on the server

-- Upsert-style: clear then insert
DELETE FROM `home`;

INSERT INTO `home` (
    `heading_1`,
    `heading_2`,
    `desktop_img`,
    `tab_img`,
    `mobile_img`,
    `large_heading`,
    `paragraph`,
    `award_heading`,
    `award_img`,
    `page_meta_tags`,
    `meta_og_image`,
    `created_by`,
    `updated_by`,
    `created_at`,
    `updated_at`
) VALUES (
    'We Build Digital Systems That Grow Businesses',
    'From FMCG to PropTech to eCommerce. Outcomes, not buzzwords.\nOur work replaces inefficiency with clarity. Complexity with control. Ideas with working systems.',
    'media/Allomate-Cover-image02_1755588868.webp',
    'media/Allomate-Cover-image02_1755588868.webp',
    'media/new-banner-image-mobile02_1755588914.webp',
    'Driven by Real Business Impact',
    'We are not here to sell code. We are here to solve problems that matter. Since 2017, we have built systems that fuel growth, improve efficiency, and redefine how businesses operate across FMCG, PropTech, eCommerce, and law.',
    'Learn More About Us',
    '/images/testimonials-img.png',
    '[{"meta_name_author":"author","meta_name_keywords":"keyword","meta_name_description":"description","meta_content_author":"DottScale","meta_content_keywords":"DottScale, local SEO, Google Ads, digital marketing, web development, social media marketing, reputation management","meta_content_description":"DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.","meta_og_title":"DottScale | Boost Your Digital Impact","meta_og_description":"Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads."}]',
    NULL,
    1,
    1,
    NOW(),
    NOW()
);
