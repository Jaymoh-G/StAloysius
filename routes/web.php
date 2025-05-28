<?php

use App\Livewire\Frontend\Club;
use App\Livewire\Frontend\Faqs;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\Event;
use App\Livewire\Frontend\Media;
use App\Livewire\Frontend\Events;
use App\Livewire\Frontend\JoinUs;
use App\Livewire\Frontend\AboutUs;
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
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\Departments;
use App\Livewire\Frontend\OurPrograms;
use App\Livewire\Frontend\Scholarships;
use App\Livewire\Frontend\SuccessStory;
use App\Livewire\Frontend\Testimonials;
use App\Livewire\Frontend\OurFacilities;
use App\Livewire\Frontend\SuccessStories;
use App\Livewire\Frontend\AdmissionPolicy;
use App\Livewire\Dashboard\Albums\AlbumForm;
use App\Livewire\Frontend\FeePayingStudents;
use App\Livewire\Frontend\UpdatesSinglePage;
use App\Livewire\Dashboard\Albums\AlbumIndex;
use App\Livewire\Frontend\ChristianLifeCommunity;
use App\Livewire\Dashboard\Blog\Index as BlogIndex;
use App\Livewire\Dashboard\Facilities\FacilityForm;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\Team\Index as TeamIndex;
use App\Livewire\Dashboard\Facilities\FacilityIndex;
use App\Livewire\Dashboard\Blog\Create as BlogCreate;
use App\Livewire\Dashboard\Team\Create as TeamCreate;
use App\Livewire\Frontend\TeamMember as TeamMemberShow;;
use App\Livewire\Dashboard\AlbumCategories\AlbumCategoryForm;
use App\Livewire\Dashboard\Categories\Index as CategoryIndex;
use App\Livewire\Dashboard\Departments\Index as DepartmentIndex;
use App\Livewire\Dashboard\Departments\Manage as DepartmentManage;
use App\Livewire\Dashboard\AlbumCategories\Index as AlbumCategoryIndex;
use App\Livewire\Dashboard\Departments\DepCategories\Index;
use App\Livewire\Dashboard\Events\Index as EventIndex;
use App\Livewire\Dashboard\Events\Manage as EventCreate;
use App\Livewire\Dashboard\Events\Manage as EventEdit;

use App\Livewire\Dashboard\Events\Categories\Index as EventCategoryIndex;
use App\Livewire\Dashboard\Events\Categories\Index as EventCategoryEdit;


Route::get('/', Home::class);
Route::get('/contact-us', ContactUs::class)->name('contact');
Route::get('/updates', Updates::class)->name('updates');
Route::get('/updates/{slug}', UpdatesSinglePage::class)->name('updates.single');
Route::get('/facilities', OurFacilities::class)->name('our-facilities');
Route::get('/facility', Facility::class)->name('facility');
Route::get('/clubs', OurClubs::class)->name('our-clubs');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/club', Club::class)->name('club');
Route::get('/support-us', SupportUs::class)->name('support-us');
Route::get('/events', Events::class)->name('events');
Route::get('/events/{slug}', Event::class)->name('event');
Route::get('/our-team', OurTeam::class)->name('our-team');
Route::get('/our-team/{slug}', TeamMemberShow::class)->name('frontend.team.show');
Route::get('/media', Media::class)->name('media');
Route::get('/departments', Departments::class)->name('departments');
Route::get('/departments/{slug}',Department::class)->name('department');
Route::get('/faqs', Faqs::class)->name('faqs');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/join-us', JoinUs::class)->name('join-us');
Route::get('/success-story', SuccessStory::class)->name('success-story');
Route::get('/success-stories', SuccessStories::class)->name('success-stories');
Route::get('/admission', Admission::class)->name('admission');
Route::get('/programs', OurPrograms::class)->name('our-programs');
Route::get('/program', Program::class)->name('program');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/admission-policy', AdmissionPolicy::class)->name('admission-policy');
Route::get('/scholarships', Scholarships::class)->name('scholarships');
Route::get('/how-to-apply', HowToApply::class)->name('how-to-apply');
Route::get('/fee-paying-students', FeePayingStudents::class)->name('fee-paying-students');
Route::get('/pillars', OurPillars::class)->name('our-pillars');
Route::get('/christian-life-community', ChristianLifeCommunity::class)->name('clc');
Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
Route::get('/dashboard/categories', CategoryIndex::class)
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
});

Route::prefix('dashboard/team')->as('dashboard.team.')->group(function () {
    Route::get('/', TeamIndex::class)->name('index');
    Route::get('/create', TeamCreate::class)->name('create');
    Route::get('/{id}/edit', TeamCreate::class)->name('edit');
});

Route::prefix('dashboard/facilities')->name('dashboard.facilities.')->group(function () {
    Route::get('/', FacilityIndex::class)->name('index');         // List of facilities
    Route::get('/create', FacilityForm::class)->name('create');   // Create new facility
    Route::get('/{id}/edit', FacilityForm::class)->name('edit');  // Edit facility
});

Route::prefix('dashboard/albums/categories')->name('album.categories.')->group(function () {
    Route::get('/', AlbumCategoryIndex::class)->name('index');
    Route::get('/create', AlbumCategoryForm::class)->name('create');
    Route::get('/{categoryId}/edit', AlbumCategoryForm::class)->name('edit');
});

Route::prefix('dashboard/albums')->name('albums.')->group(function () {
    Route::get('/', AlbumIndex::class)->name('index');
    Route::get('/create', AlbumForm::class)->name('create');
    Route::get('/{albumId}/edit', AlbumForm::class)->name('edit');
});

Route::prefix('dashboard/events')->name('dashboard.events.')->group(function () {
    Route::get('/', EventIndex::class)->name('index');
    Route::get('/create', EventCreate::class)->name('create');
    Route::get('/{eventId}/edit', EventEdit::class)->name('edit');

      Route::get('/categories', EventCategoryIndex::class)->name('categories.index');
    Route::get('/categories/{eventCategoryId}/edit', EventCategoryEdit::class)->name('categories.edit');
});





use App\Http\Controllers\CkeditorUploadController;

Route::post('/ckeditor/upload', [CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');
