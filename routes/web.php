<?php

use App\Http\Controllers\DashboardController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\RouteVisitLogController;
use App\Http\Controllers\ContactMessageController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';


Route::get('/awards', [AwardController::class, 'publicIndex'])->name('awards.publicIndex');
Route::get('/awards/{award}', [AwardController::class, 'publicShow'])->name('awards.publicShow');

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        // Awards
        Route::resource('awards', AwardController::class);

        // Careers
        Route::resource('careers', CareerController::class);

        // Categories
        Route::resource('categories', CategoryController::class);

        // Contacts
        Route::resource('contacts', ContactController::class);

        // Contact Messages
        Route::resource('contact-messages', ContactMessageController::class);

        // Events
        Route::resource('events', EventController::class);

        // Galleries
        Route::resource('galleries', GalleryController::class);

        // Hero Sliders
        Route::resource('hero-sliders', HeroSliderController::class);

        // Likes
        Route::resource('likes', LikeController::class);

        // Media
        Route::resource('media', MediaController::class);

        // Notices
        Route::resource('notices', NoticeController::class);

        // Pages
        Route::resource('pages', PageController::class);

        // Page Sections
        Route::resource('page-sections', PageSectionController::class);

        // Posts
        Route::resource('posts', PostController::class);

        // Post Tags
        Route::resource('post-tags', PostTagController::class);

        // Products
        Route::resource('products', ProductController::class);

        // Projects
        Route::resource('projects', ProjectController::class);

        // Route Visit Logs
        Route::resource('route-visit-logs', RouteVisitLogController::class);

        // Services
        Route::resource('services', ServiceController::class);

        // Settings
        Route::resource('settings', SettingController::class);

        // Tags
        Route::resource('tags', TagController::class);

        // Teams
        Route::resource('teams', TeamController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Visitors
        Route::resource('visitors', VisitorController::class);
    });
