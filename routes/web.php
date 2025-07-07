<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use App\Livewire\Dashboard\Gallery\Albums\AlbumIndex;
use App\Livewire\Dashboard\Gallery\Images\ImageIndex;
use App\Livewire\Dashboard\Gallery\CategoryIndex;
use App\Livewire\Dashboard\Youtube\VideoIndex;

// Home page
Route::get('/', \App\Livewire\Frontend\Home::class)->name('home');

// About Us routes
Route::get('/about-us', \App\Livewire\Frontend\AboutUs::class)->name('about-us');
Route::get('/our-team', \App\Livewire\Frontend\OurTeam::class)->name('our-team');
Route::get('/our-facilities', \App\Livewire\Frontend\OurFacilities::class)->name('our-facilities');
Route::get('/testimonials', \App\Livewire\Frontend\Testimonials::class)->name('testimonials');
Route::get('/testimonials/{slug}', \App\Livewire\Frontend\Testimonial::class)->name('testimonials.show');

// Department routes
Route::get('/departments', \App\Livewire\Frontend\Departments::class)->name('departments');
Route::get('/department/{slug}', \App\Livewire\Frontend\Department::class)->name('department');

// Dashboard Department Management routes are now inside the dashboard group

// Admission routes
Route::get('/admission', \App\Livewire\Frontend\Admission::class)->name('admission');
Route::get('/admission-policy', \App\Livewire\Frontend\AdmissionPolicy::class)->name('admission-policy');
Route::get('/how-to-apply', \App\Livewire\Frontend\HowToApply::class)->name('how-to-apply');
Route::get('/fee-paying-students', \App\Livewire\Frontend\FeePayingStudents::class)->name('fee-paying-students');
Route::get('/scholarships', \App\Livewire\Frontend\Scholarships::class)->name('scholarships');

// Event routes
Route::get('/events', \App\Livewire\Frontend\Events::class)->name('events');
Route::get('/upcoming-events', \App\Livewire\Frontend\UpcomingEvents::class)->name('upcoming-events');
Route::get('/past-events', \App\Livewire\Frontend\PastEvents::class)->name('past-events');
Route::get('/event/{slug}', \App\Livewire\Frontend\Event::class)->name('event');

// Gallery routes
Route::get('/gallery', \App\Livewire\Frontend\Gallery::class)->name('gallery');
Route::get('/photos', \App\Livewire\Frontend\PhotoGallery::class)->name('photos');
Route::get('/videos', \App\Livewire\Frontend\YoutubeGallery::class)->name('videos');
Route::get('/gallery/album/{slug}', \App\Livewire\Frontend\AlbumView::class)->name('gallery.album');

// Career routes
Route::get('/careers', \App\Livewire\Frontend\Careers::class)->name('careers');
Route::get('/career/{slug}', \App\Livewire\Frontend\CareerDetail::class)->name('career.show');
Route::get('/careers/{slug}', \App\Livewire\Frontend\CareerDetail::class)->name('careers.show');

// Facility routes
Route::get('/facility/{slug}', \App\Livewire\Frontend\Facility::class)->name('facility');

// Team member routes
Route::get('/team-member/{slug}', \App\Livewire\Frontend\TeamMember::class)->name('frontend.team.show');

// Updates/Blog routes
Route::get('/updates', \App\Livewire\Frontend\Updates::class)->name('news');
Route::get('/updates/{slug}', \App\Livewire\Frontend\UpdatesSinglePage::class)->name('news.single');

// Other pages
Route::get('/media-centre', \App\Livewire\Frontend\MediaCentre::class)->name('media-centre');
Route::get('/support-us', \App\Livewire\Frontend\SupportUs::class)->name('support-us');
Route::get('/contact-us', \App\Livewire\Frontend\ContactUs::class)->name('contact');
Route::get('/faqs', \App\Livewire\Frontend\Faqs::class)->name('faqs');
Route::get('/join-us', \App\Livewire\Frontend\JoinUs::class)->name('join-us');
Route::get('/our-clubs', \App\Livewire\Frontend\OurClubs::class)->name('our-clubs');
Route::get('/club/{slug}', \App\Livewire\Frontend\Club::class)->name('club.show');
Route::get('/christian-life-community', \App\Livewire\Frontend\ChristianLifeCommunity::class)->name('clc');
Route::get('/our-pillars', \App\Livewire\Frontend\OurPillars::class)->name('our-pillars');



// Dashboard routes (protected)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard home - accessible to all authenticated users
    Route::get('/', \App\Livewire\Dashboard\Index::class)->name('index');

    // Static Pages - require view static_pages permission
    Route::middleware(['module.permission:view static_pages'])->group(function () {
        Route::get('/static-pages', \App\Livewire\Dashboard\StaticPages\Index::class)->name('static-pages.index');
        Route::get('/static-pages/create', \App\Livewire\Dashboard\StaticPages\Manage::class)->name('static-pages.create');
        Route::get('/static-pages/{id}/edit', \App\Livewire\Dashboard\StaticPages\Manage::class)->name('static-pages.edit');
        Route::get('/static-pages/manage', \App\Livewire\Dashboard\StaticPages\Manage::class)->name('static-pages.manage');
    });

    // Team Management - require view team permission
    Route::middleware(['module.permission:view team'])->group(function () {
        Route::get('/team', \App\Livewire\Dashboard\Team\Index::class)->name('team.index');
        Route::get('/team/create', \App\Livewire\Dashboard\Team\Create::class)->name('team.create');
        Route::get('/team/{id}/edit', \App\Livewire\Dashboard\Team\Edit::class)->name('team.edit');
    });

    // Blog/News Management - require view blog permission
    Route::middleware(['module.permission:view blog'])->group(function () {
        Route::get('/blog', \App\Livewire\Dashboard\Blog\Index::class)->name('blog.index');
        Route::get('/blog/create', \App\Livewire\Dashboard\Blog\Create::class)->name('blog.create');
        Route::get('/blog/{id}/edit', \App\Livewire\Dashboard\Blog\Create::class)->name('blog.edit');
        Route::get('/blog/categories', \App\Livewire\Dashboard\Categories\Index::class)->name('blog.categories.index');
    });

    // Events Management - require view events permission
    Route::middleware(['module.permission:view events'])->group(function () {
        Route::get('/events', \App\Livewire\Dashboard\Events\Index::class)->name('events.index');
        Route::get('/events/create', \App\Livewire\Dashboard\Events\Manage::class)->name('events.create');
        Route::get('/events/{id}/edit', \App\Livewire\Dashboard\Events\Manage::class)->name('events.edit');
        Route::get('/events/manage', \App\Livewire\Dashboard\Events\Manage::class)->name('events.manage');
        Route::get('/events/categories', \App\Livewire\Dashboard\Categories\Index::class)->name('events.categories.index');
    });

    // Gallery Management - require view gallery permission
    Route::middleware(['module.permission:view gallery'])->group(function () {
        Route::get('/gallery/categories', CategoryIndex::class)->name('gallery.categories');
        Route::get('/gallery/albums', AlbumIndex::class)->name('gallery.albums');
        Route::get('/gallery/images', ImageIndex::class)->name('gallery.images');
    });

    // YouTube Management - require view youtube permission
    Route::middleware(['module.permission:view youtube'])->group(function () {
        Route::get('/youtube', \App\Livewire\Dashboard\Youtube\Index::class)->name('youtube.index');
    });

    // Careers Management - require view careers permission
    Route::middleware(['module.permission:view careers'])->group(function () {
        Route::get('/careers', \App\Livewire\Dashboard\Careers\JobVacancyIndex::class)->name('careers.index');
        Route::get('/careers/create', \App\Livewire\Dashboard\Careers\JobVacancyForm::class)->name('careers.create');
        Route::get('/careers/categories', \App\Livewire\Dashboard\Careers\JobCategoryIndex::class)->name('careers.categories');
        Route::get('/careers/{id}/edit', \App\Livewire\Dashboard\Careers\JobVacancyForm::class)->name('careers.edit');
    });

    // Users Management - require view users permission
    Route::middleware(['module.permission:view users'])->group(function () {
        Route::get('/users', \App\Livewire\Dashboard\Users\Index::class)->name('users.index');
        Route::get('/users/create', \App\Livewire\Dashboard\Users\Form::class)->name('users.create');
        Route::get('/users/{user}/edit', \App\Livewire\Dashboard\Users\Form::class)->name('users.edit');
    });

    // Roles Management - require view roles permission
    Route::middleware(['module.permission:view roles'])->group(function () {
        Route::get('/roles', \App\Livewire\Dashboard\Roles\Index::class)->name('roles.index');
        Route::get('/roles/create', \App\Livewire\Dashboard\Roles\Form::class)->name('roles.create');
        Route::get('/roles/{role}/edit', \App\Livewire\Dashboard\Roles\Form::class)->name('roles.edit');
    });

    // Testimonials Management - require view testimonials permission
    Route::middleware(['module.permission:view testimonials'])->group(function () {
        Route::get('/testimonials', \App\Livewire\Dashboard\Testimonials\Index::class)->name('testimonials.index');
        Route::get('/testimonials/create', \App\Livewire\Dashboard\Testimonials\Manage::class)->name('testimonials.create');
        Route::get('/testimonials/{id}/edit', \App\Livewire\Dashboard\Testimonials\Manage::class)->name('testimonials.edit');
        Route::get('/testimonials/manage', \App\Livewire\Dashboard\Testimonials\Manage::class)->name('testimonials.manage');
    });

    // Facilities Management - require view facilities permission
    Route::middleware(['module.permission:view facilities'])->group(function () {
        Route::get('/facilities', \App\Livewire\Dashboard\Facilities\Index::class)->name('facilities.index');
        Route::get('/facilities/create', \App\Livewire\Dashboard\Facilities\Manage::class)->name('facilities.create');
        Route::get('/facilities/{id}/edit', \App\Livewire\Dashboard\Facilities\Manage::class)->name('facilities.edit');
        Route::get('/facilities/manage', \App\Livewire\Dashboard\Facilities\Manage::class)->name('facilities.manage');
    });

    // Departments Management - require view departments permission
    Route::middleware(['module.permission:view departments'])->group(function () {
        Route::get('/departments', \App\Livewire\Dashboard\Departments\Index::class)->name('departments.index');
        Route::get('/departments/create', \App\Livewire\Dashboard\Departments\Manage::class)->name('departments.create');
        Route::get('/departments/{id}/edit', \App\Livewire\Dashboard\Departments\Manage::class)->name('departments.edit');
        Route::get('/departments/manage', \App\Livewire\Dashboard\Departments\Manage::class)->name('departments.manage');
        Route::get('/departments/categories', \App\Livewire\Dashboard\Departments\DepCategories\Index::class)->name('departments.categories.index');
    });

    // Activity Log - accessible to all authenticated dashboard users
    Route::get('/dashboard/activities', \App\Livewire\Dashboard\ActivityIndex::class)->name('activities.index');
});

// Profile route (protected)
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

// GET logout route for direct access
Route::get('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->middleware('auth');

// CKEditor upload route
Route::post('/ckeditor/upload', [\App\Http\Controllers\CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');

// Include authentication routes
require __DIR__ . '/auth.php';
