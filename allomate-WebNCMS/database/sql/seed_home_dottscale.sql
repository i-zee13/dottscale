-- DottScale Home Page — Austin homepage copy (Allomate theme layout)
-- Option A (recommended on server): php81 artisan home:seed-dottscale
-- Option B: run this SQL in phpMyAdmin / mysql CLI on the server

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
    'Digital Marketing Agency in Austin, TX',
    'We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.',
    '/images/hero-img01.webp',
    '/images/hero-img01.webp',
    '/images/main-bg-mobile.webp',
    'Digital marketing for businesses in Austin, TX',
    'Austin''s business market is crowded and search-driven — customers decide who to call largely based on who shows up first in Google Search and Maps. We build that visibility from the ground up: a Google Business Profile that ranks, a website that converts once someone clicks, and a reputation that holds up under scrutiny. Local SEO and paid advertising work together so you''re found in the moment someone''s ready to hire, and every channel feeds a website built to close the deal, not just collect a visit.',
    'Learn More About Us',
    '/images/testimonials-img.png',
    '[{"meta_name_author":"author","meta_name_keywords":"keyword","meta_name_description":"description","meta_content_author":"Dott Scale","meta_content_keywords":"Dott Scale, digital marketing agency Austin, local SEO, Google Ads, web design, Austin TX","meta_content_description":"We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.","meta_og_title":"Dott Scale — Digital Marketing Agency in Austin, TX","meta_og_description":"Digital marketing agency in Austin, TX — SEO, ads, websites, and reputation built to grow local businesses."}]',
    NULL,
    1,
    1,
    NOW(),
    NOW()
);
