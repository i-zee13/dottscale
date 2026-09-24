const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.setPublicPath('public_html');  // Set public path to public_html

mix.js('resources/js/app.js', 'public_html/js')
    .js('resources/js/custom/faq.js', 'public_html/js/custom')
    .js('resources/js/custom/aboutus.js', 'public_html/js/custom')
    .js('resources/js/custom/all-blogs-list.js', 'public_html/js/custom')
    .js('resources/js/custom/blogs.js', 'public_html/js/custom')
    .js('resources/js/custom/get-in-touch.js', 'public_html/js/custom')
    .js('resources/js/custom/contact-form.js', 'public_html/js/custom')
    .js('resources/js/custom/leads.js', 'public_html/js/custom')
    .js('resources/js/custom/static-pages.js', 'public_html/js/custom')
    .js('resources/js/custom/frontend-faq.js', 'public_html/js/custom')
    .js('resources/js/custom/home.js', 'public_html/js/custom')
    .js('resources/js/custom/subscription-email.js', 'public_html/js/custom')
    .js('resources/js/custom/forms.js', 'public_html/js/custom')
    .js('resources/js/custom/demo-requests.js', 'public_html/js/custom')
    .js('resources/js/custom/applications.js', 'public_html/js/custom')
    .js('resources/js/custom/careers.js', 'public_html/js/custom')
    .js('resources/js/custom/services.js', 'public_html/js/custom')
    .js('resources/js/custom/career_application.js', 'public_html/js/custom')
    .js('resources/js/custom/testimonial.js', 'public_html/js/custom')
    .js('resources/js/custom/fetch-testimonial.js', 'public_html/js/custom')






    .js('resources/js/custom/profile.js', 'public_html/js/custom')
    .sass('resources/sass/app.scss', 'public_html/css')
    .sourceMaps();
