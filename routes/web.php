<?php

use App\Livewire\Frontend\Club;
use App\Livewire\Frontend\Faqs;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\Event;
use App\Livewire\Frontend\Events;
use App\Livewire\Frontend\JoinUs;
use App\Livewire\Frontend\AboutUs;
use App\Livewire\Frontend\Careers;
use App\Livewire\Frontend\Gallery;
use App\Livewire\Frontend\OurTeam;
use App\Livewire\Frontend\Program;
use App\Livewire\Frontend\Updates;
use App\Livewire\Frontend\Facility;
use App\Livewire\Frontend\OurClubs;
use App\Livewire\Frontend\Admission;
use App\Livewire\Frontend\ContactUs;
use App\Livewire\Frontend\SupportUs;
use App\Livewire\Frontend\Department;
use App\Livewire\Frontend\HowToApply;
use App\Livewire\Frontend\OurPillars;
use App\Livewire\Frontend\PastEvents;
use Illuminate\Support\Facades\Route;
use  \App\Livewire\Frontend\AlbumView;
use App\Livewire\Frontend\Departments;
use App\Livewire\Frontend\MediaCentre;
use App\Livewire\Frontend\OurPrograms;
use App\Livewire\Frontend\CareerDetail;
use App\Livewire\Frontend\PhotoGallery;
use App\Livewire\Frontend\Scholarships;
use App\Livewire\Frontend\SuccessStory;
use App\Livewire\Frontend\Testimonials;
use App\Livewire\Frontend\OurFacilities;
use App\Livewire\Frontend\SuccessStories;
use App\Livewire\Frontend\UpcomingEvents;
use App\Livewire\Frontend\YoutubeGallery;
use App\Livewire\Frontend\AdmissionPolicy;
use App\Livewire\Dashboard\Albums\AlbumForm;
use App\Livewire\Frontend\FeePayingStudents;
use App\Livewire\Frontend\UpdatesSinglePage;
use App\Livewire\Dashboard\Youtube\VideoIndex;
use App\Livewire\Dashboard\Gallery\CategoryIndex;
use App\Livewire\Frontend\ChristianLifeCommunity;
use App\Http\Controllers\CkeditorUploadController;
use App\Livewire\Dashboard\Careers\JobVacancyForm;
use App\Livewire\Dashboard\Blog\Index as BlogIndex;
use App\Livewire\Dashboard\Careers\JobVacancyIndex;
use App\Livewire\Dashboard\Facilities\FacilityForm;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\Team\Index as TeamIndex;
use App\Livewire\Dashboard\Careers\JobCategoryIndex;
use App\Livewire\Dashboard\Facilities\FacilityIndex;
use App\Livewire\Dashboard\Blog\Create as BlogCreate;

use App\Livewire\Dashboard\Gallery\Albums\AlbumIndex;
use App\Livewire\Dashboard\Gallery\Images\ImageIndex;
use App\Livewire\Dashboard\Team\Create as TeamCreate;
use App\Livewire\Dashboard\Events\Index as EventIndex;


use App\Livewire\Dashboard\Events\Manage as EventEdit;
use App\Livewire\Dashboard\Events\Manage as EventCreate;
use App\Livewire\Frontend\TeamMember as TeamMemberShow;;

use App\Livewire\Dashboard\Departments\DepCategories\Index;
use App\Livewire\Dashboard\AlbumCategories\AlbumCategoryForm;
use App\Livewire\Dashboard\Blogs\Categories\Index as BlogCat;
use App\Livewire\Dashboard\Departments\Index as DepartmentIndex;
use App\Livewire\Dashboard\Categories\Index as MainCategoryIndex;
use App\Livewire\Dashboard\Departments\Manage as DepartmentManage;
use App\Livewire\Dashboard\AlbumCategories\Index as AlbumCategoryIndex;
use App\Livewire\Dashboard\Events\Categories\Index as EventCategoryEdit;
use App\Livewire\Dashboard\Events\Categories\Index as EventCategoryIndex;

use App\Livewire\Dashboard\StaticPages\Index as StaticPagesIndex;
use App\Livewire\Dashboard\StaticPages\Manage as StaticPagesManage;

Route::get('/', Home::class)->name('home');
Route::get('/contact-us', ContactUs::class)->name('contact');
Route::get('/news', Updates::class)->name('news');
Route::get('/news/{slug}', UpdatesSinglePage::class)->name('news.single');
Route::get('/facilities', OurFacilities::class)->name('our-facilities');
Route::get('/facility', Facility::class)->name('facility');
Route::get('/clubs', OurClubs::class)->name('our-clubs');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/club', Club::class)->name('club');
Route::get('/support-us', SupportUs::class)->name('support-us');

Route::get('/events', Events::class)->name('events');
Route::get('/events/upcoming-events', UpcomingEvents::class)->name('upcoming-events');
Route::get('/events/past-events', PastEvents::class)->name('past-events');
Route::get('/events', Events::class)->name('events');
Route::get('/events/{slug}', Event::class)->name('event');

Route::get('/our-team', OurTeam::class)->name('our-team');
Route::get('/our-team/{slug}', TeamMemberShow::class)->name('frontend.team.show');
Route::get('/careers', Careers::class)->name('careers');
Route::get('/careers/{slug}', CareerDetail::class)->name('careers.show');
Route::get('/careers/{category?}', Careers::class)->name('careers.category');
Route::get('/media-centre', MediaCentre::class)->name('media-centre');
Route::get('/departments', Departments::class)->name('departments');
Route::get('/departments/{slug}', Department::class)->name('department');
Route::get('/faqs', Faqs::class)->name('faqs');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/join-us', JoinUs::class)->name('join-us');
Route::get('/success-story', SuccessStory::class)->name('success-story');
Route::get('/success-stories', SuccessStories::class)->name('success-stories');
Route::get('/admission', Admission::class)->name('admission');
Route::get('/programs', OurPrograms::class)->name('our-programs');
Route::get('/program', Program::class)->name('program');
// Make sure these routes are placed BEFORE any wildcard routes that might capture /videos
// Photo Gallery Routes
Route::get('gallery/photos', PhotoGallery::class)->name('photos');
Route::get('gallery/photos/{category?}', PhotoGallery::class)->name('photos.categories');

// Video Gallery Routes
Route::get('gallery/videos', YoutubeGallery::class)->name('videos');
Route::get('gallery/videos/{category?}', YoutubeGallery::class)->name('videos.categories');

// Keep the existing gallery route for backward compatibility
Route::get('/gallery/{category?}', Gallery::class)->name('gallery');
Route::get('/admission-policy', AdmissionPolicy::class)->name('admission-policy');
Route::get('/scholarships', Scholarships::class)->name('scholarships');
Route::get('/how-to-apply', HowToApply::class)->name('how-to-apply');
Route::get('/fee-paying-students', FeePayingStudents::class)->name('fee-paying-students');
Route::get('/pillars', OurPillars::class)->name('our-pillars');
Route::get('/christian-life-community', ChristianLifeCommunity::class)->name('clc');
Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
Route::get('/dashboard/categories', MainCategoryIndex::class)
    ->name('dashboard.categories');

Route::prefix('dashboard/departments')->name('departments.')->group(function () {
    Route::get('/', DepartmentIndex::class)->name('index');        // List departments
    Route::get('/create', DepartmentManage::class)->name('create'); // Create form
    Route::get('/{depId}/edit', DepartmentManage::class)->name('edit'); // Edit form
    Route::get('/categories', Index::class)->name('categories.index'); // Edit form
    Route::get('/categories/{id}/edit', Index::class)->name('categories.edit'); // Edit form
});

Route::prefix('dashboard/blog')->name('dashboard.blog.')->group(function () {
    Route::get('/', BlogIndex::class)->name('index');       // List all posts
    Route::get('/create', BlogCreate::class)->name('create'); // Create a post
    Route::get('/{postId}/edit', BlogCreate::class)->name('edit'); // Edit a post
    Route::get('/categories', BlogCat::class)->name('categories.index');
    Route::get('/categories/{id}/edit', BlogCat::class)->name('categories.edit');
});

Route::prefix('dashboard/team')->as('dashboard.team.')->group(function () {
    Route::get('/', TeamIndex::class)->name('index');
    Route::get('/create', TeamCreate::class)->name('create');
    Route::get('/{id}/edit', TeamCreate::class)->name('edit');
});

Route::prefix('dashboard/facilities')->name('dashboard.facilities.')->group(function () {
    Route::get('/', App\Livewire\Dashboard\Facilities\Index::class)->name('facilities.index');
    Route::get('/create', App\Livewire\Dashboard\Facilities\Manage::class)->name('facilities.create');
    Route::get('/{facilityId}/edit', App\Livewire\Dashboard\Facilities\Manage::class)->name('facilities.edit');
});

Route::prefix('dashboard/events')->name('dashboard.events.')->group(function () {
    Route::get('/', EventIndex::class)->name('index');
    Route::get('/create', EventCreate::class)->name('create');
    Route::get('/{eventId}/edit', EventEdit::class)->name('edit');
    Route::get('/categories', EventCategoryIndex::class)->name('categories.index');
    Route::get('/categories/{eventCategoryId}/edit', EventCategoryEdit::class)->name('categories.edit');
});

Route::prefix('dashboard/gallery')->name('dashboard.gallery.')->group(function () {
    Route::get('/categories', CategoryIndex::class)->name('categories');
    Route::get('/albums', AlbumIndex::class)->name('albums');
    Route::get('/images', ImageIndex::class)->name('images');
});

Route::get('/gallery/album/{slug}', AlbumView::class)->name('gallery.album');

Route::post('/ckeditor/upload', [CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');

Route::prefix('dashboard/gallery/youtube')->name('dashboard.youtube.')->group(function () {
    Route::get('/', VideoIndex::class)->name('index');
});



// Dashboard career routes - without auth middleware for now
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/careers', JobVacancyIndex::class)->name('careers.index');
    Route::get('/careers/create', JobVacancyForm::class)->name('careers.create');
    Route::get('/careers/{id}/edit', JobVacancyForm::class)->name('careers.edit');
    Route::get('/careers/categories', JobCategoryIndex::class)->name('careers.categories');
});

Route::prefix('dashboard/static-pages')->name('dashboard.static-pages.')->group(function () {
    Route::get('/', StaticPagesIndex::class)->name('index');
    Route::get('/create', StaticPagesManage::class)->name('create');
    Route::get('/{id}/edit', StaticPagesManage::class)->name('edit');
});






    // ... existing routes ...
