<?php

use App\Http\Controllers\admin\ReviewsController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\BlocksMediaController;
use App\Http\Controllers\ClientLogoController;
use App\Http\Controllers\Core\AccessRights;
use App\Http\Controllers\Core\Admin;
use App\Http\Controllers\Core\EmployeeAccessRights;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GatewaysController;
use App\Http\Controllers\GeographicalSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SiteMenuController;
use App\Http\Controllers\WebPagesController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    // Clear application cache
    Artisan::call('cache:clear');  
    // Clear configuration cache
    Artisan::call('config:clear');

    // Clear route cache
    Artisan::call('route:clear');
    // Clear view cache
    Artisan::call('view:clear');

    // Clear compiled views
    Artisan::call('view:cache');

    // Optimize class loading
    Artisan::call('optimize');

    // Optimize the framework for better performance
    Artisan::call('optimize:clear');

    // Clear configuration cache
    Artisan::call('config:cache');

    return 'Caches cleared and optimized successfully.';
});
Route::get('/clear', function () { 
  Artisan::call('cache:clear');  
  Artisan::call('config:clear');
  return 'Caches cleared and optimized successfully.';
});
Route::get('/storage-link', function () {
    // Clear application cache
    Artisan::call('storage:link');
    return 'Done.';
});
Route::get('/sitemap-generate', function () {
  Artisan::call('sitemap:generate');
  return 'SiteMap generated successfully.';
});
// HTML sitemap is the Blade frontend page (see routes/frontend.php).
// Route::get('/sitemap', [HomeController::class, 'siteMap'])->name('sitemap');

Route::get('/welcome', function () { 
  return view('welcome');
});

//Website Routes
require __DIR__ . '/frontend.php';

// Route::get('/home', [App\Http\Controllers\WebPagesController::class, 'getFrontEndIndexPage'])->name('home');
Route::get('/field-traner', [App\Http\Controllers\HomeController::class, 'fieldTranerPage'])->name('field-traner');
Route::get('/ios-developer', [App\Http\Controllers\HomeController::class, 'iosDeveloperPage'])->name('ios-developer');
Route::get('/learn-more', [App\Http\Controllers\HomeController::class, 'productPage'])->name('learn-more');
// Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contactUsPage'])->name('contact-us');
Route::get('/get-demo', [App\Http\Controllers\HomeController::class, 'getDemoPage'])->name('get-demo');
Route::get('/software-quality', [App\Http\Controllers\HomeController::class, 'softwareQualityPage'])->name('software-quality');
Route::get('/business-development', [App\Http\Controllers\HomeController::class, 'businessDevelopmentPage'])->name('business-development');

Route::post('/store-demo-form', [App\Http\Controllers\FormController::class, 'demoForm'])->name('store-demo-form');
Route::post('/store-contact-form', [App\Http\Controllers\FormController::class, 'contactForm'])->name('store-contact-form');

// Route::get('/', [App\Http\Controllers\WebPagesController::class, 'getFrontEndIndexPage'])->name('home');
// Route::get('/about-us', [App\Http\Controllers\WebPagesController::class, 'getFrontEndAboutusPage'])->name('about-us');
// Route::get('/blogs', [App\Http\Controllers\WebPagesController::class, 'getFrontEndBlogsPage'])->name('blogs');
Route::get('/insights/{page_slug}', [App\Http\Controllers\WebPagesController::class, 'blog_details'])->name('insights-detail');
Route::get('/get-in-touch', [App\Http\Controllers\WebPagesController::class, 'get_in_touch'])->name('get-in-touch'); 
// Route::get('/privacy-policy', [App\Http\Controllers\WebPagesController::class, 'getFrontEndPrivacyPage'])->name('privacy-policy');
// Route::get('/terms-of-use', [App\Http\Controllers\WebPagesController::class, 'getFrontEndTermsPage'])->name('terms-of-use');
Route::get('/faqs', [App\Http\Controllers\WebPagesController::class, 'getFrontEndFaqs'])->name('faqs');
Route::get('/the-difference', [App\Http\Controllers\WebPagesController::class, 'getFrontEndTheDifference'])->name('the-difference');
Route::get('/services-detail', [App\Http\Controllers\WebPagesController::class, 'getFrontEndServices'])->name('services-detail');
Route::get('/get-clients-review', [App\Http\Controllers\WebPagesController::class, 'getTestimonialsList'])->name('get-clients-review');
Route::post('/save-customer-subscription', [App\Http\Controllers\WebPagesController::class, 'saveSubscriberForm'])->name('save-customer-subscription');
Route::get('/get-all-blogs', [App\Http\Controllers\WebPagesController::class, 'getFrontEndBlogsPage'])->name('get-all-blogs');
Route::get('/get-portfolios/{isLimit?}', [App\Http\Controllers\WebPagesController::class, 'getFrontEndPortfolios'])->name('get-portfolios');
Route::post('/get-all-faqs', [App\Http\Controllers\WebPagesController::class, 'getFrontEndFaqs'])->name('get-all-faqs');
Route::post('/save-contact', [App\Http\Controllers\WebPagesController::class, 'save_contact_form'])->name('save-contact');
Route::post('/save-pr-contact', [App\Http\Controllers\WebPagesController::class, 'save_pr_contact_form'])->name('save-pr-contact');
//End-Web Routes


// Authentication Routes...
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('mylogin', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('mylogin');


//admin-Pannel Routes
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::group(['prefix' => 'admin',  'middleware' => ['custom.auth', 'is_route_assigned','is_password_change']], function () {
  Route::get('/portfolios', [App\Http\Controllers\admin\ServiceController::class, 'portfolios'])->name('admin.primary-services');
  Route::get('/get-primary-services-load', [App\Http\Controllers\admin\ServiceController::class, 'loadPortfolios'])->name('admin.get-primary-services-load');

  Route::get('/index', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('index');
  Route::get('/AccessRights',  [AccessRights::class, 'index'])->name('admin.AccessRights');
  Route::get('/employee-access-rights',  [EmployeeAccessRights::class, 'index'])->name('admin.employee-access-rights');
  Route::get('/revokeAccRight/{id}',  [AccessRights::class, 'revokeAccRight'])->name('admin.revokeAccRight');
  Route::resource('/AccessRights',  AccessRights::class);
  Route::resource('/employee-AccessRights',  EmployeeAccessRights::class);
  Route::post('/SaveSubMod', [Admin::class, 'SaveSubMod'])->name('admin.SaveSubMod');
  Route::post('/DeleteSubNavItem', [Admin::class, 'DeleteSubNavItem'])->name('admin.DeleteSubNavItem');
  Route::post('/UpdateSubModPriority', [Admin::class, 'UpdateSubModPriority'])->name('admin.UpdateSubModPriority');
  Route::post('/UpdateParentMod', [Admin::class, 'UpdateParentMod'])->name('admin.UpdateParentMod');
  Route::post('/UpdateParentModPriority', [Admin::class, 'UpdateParentModPriority'])->name('admin.UpdateParentModPriority');
  Route::post('/SaveParentMod', [Admin::class, 'SaveParentMod'])->name('admin.SaveParentMod');
  Route::post('/DeleteParentMod', [Admin::class, 'DeleteParentMod'])->name('admin.DeleteParentMod');

  //Access Rights routes
  Route::get('/listAllRights', [AccessRights::class, 'listAllRights'])->name('listAllRights');
  Route::get('/createRights', [AccessRights::class, 'create']);
  Route::get('/revokeAccRight/{empId}', [AccessRights::class, 'revokeAccRight']);
  Route::get('/employee-listAllRights', [EmployeeAccessRights::class, 'listAllRights'])->name('admin.employee-listAllRights');
  Route::get('/employee-createRights', [EmployeeAccessRights::class, 'create']);
  Route::get('/employee-revokeAccRight/{empId}', [EmployeeAccessRights::class, 'revokeAccRight']);


  Route::get('/site_settings', [App\Http\Controllers\Core\Admin::class, 'index'])->name('admin.site_settings');
  Route::get('/', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.index');

  Route::get('/home', [App\Http\Controllers\admin\HomeController::class, 'GetHomePage'])->name('admin.home');
  Route::post('/home-store', [App\Http\Controllers\admin\HomeController::class, 'store'])->name('admin.home-store');

  /**organization-CRUD Routes */
  Route::get('/organization', [App\Http\Controllers\admin\OrganizationController::class, 'index'])->name('admin.organization');
  Route::post('/organization/store', [App\Http\Controllers\admin\OrganizationController::class, 'store'])->name('admin.organization.store');
  Route::post('/organization-location/store', [App\Http\Controllers\admin\OrganizationController::class, 'storeLocaion'])->name('admin.organization-location');
  Route::get('/location-list', [App\Http\Controllers\admin\OrganizationController::class, 'locationList'])->name('admin.location-list');
  Route::get('/get-location-form/{id}', [App\Http\Controllers\admin\OrganizationController::class, 'getLocation'])->name('admin.get-location-form');
  Route::POST('/location-delete/{id}', [App\Http\Controllers\admin\OrganizationController::class, 'deleteLocation'])->name('admin.location-delete');
  /**End Organization  Routes */

  //GetGraphical Data
  Route::get('/get-city-against-states/{id}', [App\Http\Controllers\admin\OrganizationController::class, 'getCityAgainst_States'])->name('admin.getCityAgainst_States');
  Route::get('/get-state-against-country/{id}', [App\Http\Controllers\admin\OrganizationController::class, 'getStateAgainst_Country'])->name('admin.getStateAgainst_Country');
  Route::get('/get-countries', [App\Http\Controllers\admin\OrganizationController::class, 'getCountries'])->name('admin.getCountries');

  /**Services Routes */
  Route::get('/blog-categories', [App\Http\Controllers\admin\ServiceController::class, 'getSubSecondaryServices'])->name('admin.blog-categories');
  //Blog Category
  Route::get('/get-blogs-categories', [App\Http\Controllers\admin\ServiceController::class, 'getBlogsCategories'])->name('admin.get-blogs-categories');
  Route::POST('/delete-blog-category/{id}', [App\Http\Controllers\admin\ServiceController::class, 'deleteCategory'])->name('admin.delete-blog-category');
  Route::post('/save-blog-cat', [App\Http\Controllers\admin\ServiceController::class, 'saveBlogCategory'])->name('admin.save-blog-cate');
  Route::get('/get-blog-category/{catId}', [App\Http\Controllers\admin\ServiceController::class, 'getBlogCategory'])->name('admin.getSubCatForblog');
  /**End Services  Routes */
//portfolio categories
Route::get('/portfolio-categories', [App\Http\Controllers\admin\PortfolioCategoryController::class, 'index'])->name('admin.portfolio-index-categories');
Route::get('/get-portfolio-categories', [App\Http\Controllers\admin\PortfolioCategoryController::class, 'getPorfolioCategories'])->name('admin.get-portfolio-categories');
Route::POST('/delete-portfolio-category/{id}', [App\Http\Controllers\admin\PortfolioCategoryController::class, 'deleteCategory'])->name('admin.deleteCategory');
Route::post('/save-portfolio-cat', [App\Http\Controllers\admin\PortfolioCategoryController::class, 'savePortfolioCategory'])->name('admin.save-portfolio-cate');
Route::get('/get-portfolio-category/{catId}', [App\Http\Controllers\admin\PortfolioCategoryController::class, 'getPortfolioCategory'])->name('admin.getSubCat');

  Route::get('/faqs', [App\Http\Controllers\admin\FaqsController::class, 'index'])->name('admin.faqs');
  Route::get('/blogs', [App\Http\Controllers\admin\BlogsController::class, 'index'])->name('admin.blogs');
  Route::get('/contact-us', [App\Http\Controllers\admin\ContactUsController::class, 'index'])->name('admin.contactus');
    Route::get('/privacy-policy', [App\Http\Controllers\admin\PrivacyPolicyController::class, 'index'])->name('admin.privacy-policy');
  Route::get('/terms-of-use', [App\Http\Controllers\admin\PrivacyPolicyController::class, 'terms_of_use'])->name('admin.terms-of-use');
  Route::get('/blog-slug/{blog_title}', [App\Http\Controllers\admin\BlogsController::class, 'blog_slug'])->name('admin.blog-slug');
  Route::get('/add-blog', [App\Http\Controllers\admin\BlogsController::class, 'add_blog'])->name('admin.add-blog');
  Route::post('/save-blog', [App\Http\Controllers\admin\BlogsController::class, 'store'])->name('admin.save-blog');
  Route::get('/all-blogs-list', [App\Http\Controllers\admin\BlogsController::class, 'all_blogs_list'])->name('admin.all-blogs-list');
  Route::post('/blog-status-change', [App\Http\Controllers\admin\BlogsController::class, 'blog_status_change'])->name('admin.blog-status-change');
  Route::get('/edit-blog/{id}', [App\Http\Controllers\admin\BlogsController::class, 'edit'])->name('admin.edit-blog');
  Route::post('/delete-blog', [App\Http\Controllers\admin\BlogsController::class, 'delete_blog'])->name('admin.delete-blog');
  Route::post('/save-faqs', [App\Http\Controllers\admin\FaqsController::class, 'save_faqs'])->name('admin.save-faqs');
  Route::get('/all-faqs-list', [App\Http\Controllers\admin\FaqsController::class, 'all_faqs_list'])->name('admin.all-faqs-list');
  Route::get('/GetFaqs/{id}', [App\Http\Controllers\admin\FaqsController::class, 'edit'])->name('admin.GetFaqs');

  Route::post('/delete-faq', [App\Http\Controllers\admin\FaqsController::class, 'delete_faq'])->name('admin.delete-faq');
  Route::post('/faq-status-change', [App\Http\Controllers\admin\FaqsController::class, 'faq_status_change'])->name('admin.faq-status-change');
  Route::post('/save-contact', [App\Http\Controllers\admin\ContactUsController::class, 'store'])->name('admin.save-contact');
  Route::get('/leads', [App\Http\Controllers\admin\LeadsController::class, 'index'])->name('admin.leads');
  Route::get('/all-leads-list', [App\Http\Controllers\admin\LeadsController::class, 'all_leads_list'])->name('admin.all-leads-list');
  Route::post('/delete-lead', [App\Http\Controllers\admin\LeadsController::class, 'delete_lead'])->name('admin.delete-lead');
  Route::post('/update-lead', [App\Http\Controllers\admin\LeadsController::class, 'update_lead'])->name('admin.update-lead');
  Route::post('/save-privacy', [App\Http\Controllers\admin\PrivacyPolicyController::class, 'save_privacy'])->name('admin.save-privacy');
  Route::post('/save-terms', [App\Http\Controllers\admin\PrivacyPolicyController::class, 'save_terms'])->name('admin.save-terms');
  Route::get('/subscriptions', [App\Http\Controllers\admin\EmailSubscriptionController::class, 'showSubscriptions'])->name('admin.subscriptions');
  Route::POST('/subscribe-email-delete/{id}', [App\Http\Controllers\admin\EmailSubscriptionController::class, 'deleteEmail'])->name('admin.subscribe-email-delete');
  // User Profile
  Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.profile');
  Route::post('/update-user-password', [App\Http\Controllers\admin\ProfileController::class, 'update_user_password'])->name('admin.update-user-password');

  Route::post('/update-user-profile-pic', [App\Http\Controllers\admin\ProfileController::class, 'update_user_profile_pic'])->name('admin.update-user-profile-pic');
  Route::get('/clients', [ClientLogoController::class, 'index'])->name('admin.clients');
  Route::get('/all-client-list', [ClientLogoController::class, 'getAllClientsList'])->name('admin.all-client-list');
  Route::post('/save-client', [ClientLogoController::class, 'store'])->name('admin.save-client');
  Route::post('/delete-client', [ClientLogoController::class, 'deleteClient'])->name('admin.delete-client');


  // Theme CSS
  Route::get('/theme-config-css', [App\Http\Controllers\admin\ThemeCssController::class, 'index'])->name('admin.theme-config-css');
  Route::get('/footer-css', [App\Http\Controllers\admin\ThemeCssController::class, 'footerIndex'])->name('admin.footer-css');
  Route::get('/menu-css', [App\Http\Controllers\admin\ThemeCssController::class, 'menuIndex'])->name('admin.menu-css');
  Route::get('/get-all-css-config', [App\Http\Controllers\admin\ThemeCssController::class, 'getAllCss'])->name('admin.get-all-css-config');
  Route::post('/save-theme-css', [App\Http\Controllers\admin\ThemeCssController::class, 'store'])->name('admin.save-theme-css');
  // Footer Content
  Route::get('/footer-content', [WebPagesController::class, 'footerContent'])->name('admin.footer-content');
  Route::post('/save-footer-page-content', [WebPagesController::class, 'saveFooterContent'])->name('admin.save-footer-page-content');
  Route::post('/delete-footer-row', [WebPagesController::class, 'destroy'])->name('admin.delete-footer-row');

  // Website Menu
  Route::get('/right-menu', [SiteMenuController::class, 'rightMenu'])->name('admin.right-menu');
  Route::get('/left-menu', [SiteMenuController::class, 'leftMenu'])->name('admin.left-menu');
  Route::get('/create-menu/{id?}', [SiteMenuController::class, 'create'])->name('admin.create-menu');
  Route::post('/save-menu-list', [SiteMenuController::class, 'store'])->name('admin.save-menu');
  Route::post('/save-right-menu-list', [SiteMenuController::class, 'storeRightMenu'])->name('admin.save-right-menu-list');
  Route::post('/delete-menu', [SiteMenuController::class, 'delete'])->name('admin.delete-menu');
  Route::post('/update-menu-status', [SiteMenuController::class, 'updateStatus'])->name('admin.update-status');

  // Subscribers List
  Route::get('/subscribers-list', [WebPagesController::class, 'subscribersList'])->name('admin.subscribers-list');
  Route::get('/subscriber-list-records', [WebPagesController::class, 'subscriberListRecords'])->name('admin.subscriber-list-records');


  //Reports Routes
  Route::get('/reports-types', [ReportsController::class, 'reportsTypePage'])->name('admin.reports-types');
  Route::get('/report-types-records', [ReportsController::class, 'fetchReportsRecords'])->name('admin.report-types-records');
  Route::post('/save-report-type', [ReportsController::class, 'saveReportType'])->name('admin.save-report-type');
  Route::post('/report-type-status-change', [ReportsController::class, 'chagneStatus'])->name('admin.report-type-status-change');
  Route::get('/reports', [ReportsController::class, 'index'])->name('admin.reports');
  Route::post('/save-report', [ReportsController::class, 'store'])->name('admin.save-report');
  Route::get('/reports-records', [ReportsController::class, 'fetchReportsList'])->name('admin.reports-records');

  //GeographicalSettings
  Route::get('/geographical-setting', [GeographicalSettingsController::class, 'geographicalsetting'])->name('admin.geographicalsetting');
  Route::get('/GetGeoData', [GeographicalSettingsController::class, 'GetGeoData'])->name('admin.GetGeoData');
  Route::get('/GetStatesagianstCountry/{id}', [GeographicalSettingsController::class, 'GetStatesagianstCountry'])->name('admin.GetStatesagianstCountry');
  Route::get('/GetCitiesagianstStates/{id}', [GeographicalSettingsController::class, 'GetCitiesagianstStates'])->name('admin.GetCitiesagianstStates');
  Route::post('/save_country', [GeographicalSettingsController::class, 'save_country'])->name('admin.save_country');
  Route::get('/GetCountry/{id}', [GeographicalSettingsController::class, 'GetCountry'])->name('admin.GetCountry');
  Route::post('/delete_geographical', [GeographicalSettingsController::class, 'delete_geographical'])->name('admin.delete_geographical');
  Route::get('/GetState/{id}', [GeographicalSettingsController::class, 'GetState'])->name('admin.GetState');
  Route::get('/GetCity/{id}', [GeographicalSettingsController::class, 'GetCity'])->name('admin.GetCity');
  Route::get('/get-cities-against-state/{id}', [GeographicalSettingsController::class, 'get_cities_against_state'])->name('admin.get-cities-against-state');
  Route::get('/get-states-cities', [GeographicalSettingsController::class, 'getStatesCities'])->name('admin.get-states-cities');
  //EndGeographicalSettings
  Route::get('/inquiries', [WebPagesController::class, 'inquiriesList'])->name('admin.inquiries');
  // Clinet Reviews
  // Route::get('/synced-google-reviews', [ReviewsController::class, 'getGoogleReviews'])->name('admin.synced-google-reviews');
  Route::get('/reviews-list', [ReviewsController::class, 'index'])->name('admin.reviews-list');
  Route::get('/get-all-reviews-list', [ReviewsController::class, 'list'])->name('admin.get-all-reviews-list');
  Route::post('/review-status-change', [ReviewsController::class, 'review_status_change'])->name('admin.review-status-change');
  Route::post('/save-review-assignment', [ReviewsController::class, 'saveAssignment'])->name('admin.save-review-assignment');
  Route::get('/manage_settings', [SettingsController::class, 'manage_settings'])->name('admin.manage_settings');
  //employees routes
  Route::get('/employee-list', [EmployeeController::class, 'index'])->name('admin.employee-list');
  Route::get('/employees-records', [EmployeeController::class, 'employee_data'])->name('admin.employees-records');
  Route::post('/save-employee', [EmployeeController::class, 'store'])->name('admin.save-employee');
  Route::post('/employee-status-change', [EmployeeController::class, 'changeStatus'])->name('admin.employee-status-change');
  //manage setting routes
  Route::get('/GetSettingsData', [App\Http\Controllers\admin\SettingsController::class, 'GetSettingsData'])->name('admin.GetSettingsData');
  Route::get('/GetDesignation/{id}', [App\Http\Controllers\admin\SettingsController::class, 'GetDesignation'])->name('admin.GetDesignation');
  Route::get('/GetDepartment/{id}', [App\Http\Controllers\admin\SettingsController::class, 'GetDepartment'])->name('admin.GetDepartment');
  Route::post('/delete_from_settings', [App\Http\Controllers\admin\SettingsController::class, 'delete_from_settings'])->name('admin.delete_from_settings');
  Route::post('/save_settings', [App\Http\Controllers\admin\SettingsController::class, 'save_settings'])->name('admin.save_settings');
  Route::post('/country-status', [GeographicalSettingsController::class, 'changeCountryStatus'])->name('admin.country-status');
  Route::get('/mandril-mail-integration', [GatewaysController::class, 'MandrilMailIndex'])->name('admin.mandril-mail-integration');

  Route::post('/save-gateway-details', [GatewaysController::class, 'store'])->name('admin.save-gateway-details');
  Route::get('/get-gateway-detail', [GatewaysController::class, 'detail'])->name('admin.get-gateway-detail');

  // blocks Media
  Route::get('/blocks-media', [BlocksMediaController::class, 'index'])->name('admin.blocks-media');
  Route::get('/get-blocks-media-records', [BlocksMediaController::class, 'getBlocksMedia'])->name('admin.get-blocks-media-records');
  Route::post('/save-block-media', [BlocksMediaController::class, 'store'])->name('admin.save-block-media');
  Route::get('/fetch-blocks', [BlocksMediaController::class, 'fetchBlocks'])->name('admin.fetch-blocks');
  Route::post('/delete-media/{mediaId}', [BlocksMediaController::class, 'destroy'])->name('admin.delete-media');
  // Google Tag Manager
  Route::get('/google-tag-manager', [GatewaysController::class, 'GoogleTagManagerIndex'])->name('admin.google-tag-manager');

});
Route::get('/get-all-states', [GeographicalSettingsController::class, 'getAllStates'])->name('get-all-states');
Route::get('/get-cities-against-state-id/{id}', [GeographicalSettingsController::class, 'getCitiesAgainstState'])->name('get-cities-against-state-id');


// First Change Password Admin
Route::get('/reset-password-first', [App\Http\Controllers\admin\HomeController::class, 'ResetPasswordFirst'])->name('reset-password-first');
Route::post('/update_user_password_first', [App\Http\Controllers\admin\HomeController::class, 'UpdatePasswordFirst'])->name('update_user_password_first');
// End First change Password Admin

Route::get('/get-latest-blogs', [App\Http\Controllers\WebPagesController::class, 'getLatestBlogs'])->name('get-latest-blogs');
Route::get('/blogs/blog-details/{page_slug}', [App\Http\Controllers\WebPagesController::class, 'blog_details'])->name('blog-details');
Route::get('/get-client-reviews', [App\Http\Controllers\WebPagesController::class, 'getTestimonials'])->name('get-client-reviews');
Route::get('/get-client-logos', [App\Http\Controllers\WebPagesController::class, 'getClientsLogo'])->name('get-client-logos');
Route::get('/get-services/{limit?}', [App\Http\Controllers\WebPagesController::class, 'getServices'])->name('get-services');
// Page-builder catch-all removed. Public pages are in routes/frontend.php.
