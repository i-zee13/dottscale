<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
| DottScale public frontend (scraped Tailwind HTML → Blade).
| CMS content binding is the next phase; these views are static copies for now.
*/

Route::get('/', [FrontendController::class, 'page'])->defaults('page', 'home')->name('home');
Route::get('/home', [FrontendController::class, 'page'])->defaults('page', 'home');

Route::get('/about-us', [FrontendController::class, 'page'])->defaults('page', 'about-us')->name('about-us');
Route::get('/our-team', [FrontendController::class, 'page'])->defaults('page', 'our-team')->name('our-team');
Route::get('/sell360-sales-platform', [FrontendController::class, 'page'])->defaults('page', 'sell360-sales-platform');
Route::get('/the-next-horizon', [FrontendController::class, 'page'])->defaults('page', 'the-next-horizon');
Route::get('/blogs', [FrontendController::class, 'page'])->defaults('page', 'blogs')->name('blogs');
Route::get('/contact-us', [FrontendController::class, 'page'])->defaults('page', 'contact-us')->name('contact-us');
Route::get('/privacy-policy', [FrontendController::class, 'page'])->defaults('page', 'privacy-policy')->name('privacy-policy');
Route::get('/terms-of-use', [FrontendController::class, 'page'])->defaults('page', 'terms-of-use')->name('terms-of-use');
Route::get('/sitemap', [FrontendController::class, 'page'])->defaults('page', 'sitemap')->name('sitemap');

Route::get('/our-work', [FrontendController::class, 'page'])->defaults('page', 'our-work.index')->name('our-work');
Route::get('/our-work/bni-inks', [FrontendController::class, 'page'])->defaults('page', 'our-work.bni-inks');
Route::get('/our-work/green-earth-recyling', [FrontendController::class, 'page'])->defaults('page', 'our-work.green-earth-recyling');
Route::get('/our-work/khan-law', [FrontendController::class, 'page'])->defaults('page', 'our-work.khan-law');
Route::get('/our-work/psl', [FrontendController::class, 'page'])->defaults('page', 'our-work.psl');
Route::get('/our-work/source-code-academia', [FrontendController::class, 'page'])->defaults('page', 'our-work.source-code-academia');
Route::get('/our-work/vape-suite', [FrontendController::class, 'page'])->defaults('page', 'our-work.vape-suite');

Route::get('/services/enterprise-solutions', [FrontendController::class, 'page'])->defaults('page', 'services.enterprise-solutions');
Route::get('/services/ai-and-automation', [FrontendController::class, 'page'])->defaults('page', 'services.ai-and-automation');
Route::get('/services/mvp-design-and-development', [FrontendController::class, 'page'])->defaults('page', 'services.mvp-design-and-development');
Route::get('/services/web-and-mobile-development', [FrontendController::class, 'page'])->defaults('page', 'services.web-and-mobile-development');
Route::get('/services/quality-assurance', [FrontendController::class, 'page'])->defaults('page', 'services.quality-assurance');
Route::get('/services/dedicated-teams', [FrontendController::class, 'page'])->defaults('page', 'services.dedicated-teams');
