-- Replace Allomate-copied SEO with unique DottScale titles/descriptions.
-- Run on staging/production DB after deploying code.

UPDATE organization
SET page_meta_tags = JSON_OBJECT(
  'page_title', 'DottScale | Boost Your Digital Impact',
  'meta_description', 'DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.',
  'meta_og_title', 'DottScale | Boost Your Digital Impact',
  'meta_og_description', 'Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads.',
  'meta_keywords', 'DottScale, local SEO, Google Ads, digital marketing, web development, social media marketing, reputation management',
  'meta_og_image', '/images/dottscale-logo-alt.png',
  'is_indexable', '1',
  'is_followable', '1'
);

UPDATE home
SET page_meta_tags = '[{"meta_name_author":"author","meta_name_keywords":"keyword","meta_name_description":"description","meta_content_author":"DottScale","meta_content_keywords":"DottScale, local SEO, Google Ads, digital marketing, web development, social media marketing, reputation management","meta_content_description":"DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.","meta_og_title":"DottScale | Boost Your Digital Impact","meta_og_description":"Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads."}]';
