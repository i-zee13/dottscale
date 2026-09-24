-- Run on dottbfyw_staging after the khanllp import.
UPDATE organization
SET
  name = 'DottScale',
  phone_number = '+1 (512) 564-8959',
  email = 'contact@dottscale.com',
  address = 'Austin, Texas, United States',
  fb_link = 'www.facebook.com/dottscalee/',
  insta_link = 'www.instagram.com/dottscale',
  linkedin_link = 'www.linkedin.com/company/dottscale/',
  twitter_link = 'www.pinterest.com/dottscale',
  thankyou_page_title = 'Thank you',
  thankyou_page_message = '<p>We have received your inquiry. A member of our team will be in touch shortly.</p>'
WHERE id = 1;
