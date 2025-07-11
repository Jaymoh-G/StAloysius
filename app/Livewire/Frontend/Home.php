<?php

namespace App\Livewire\Frontend;


use App\Models\Album;
use Livewire\Component;
use App\Models\BlogPost;
use App\Models\EventModel;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\YoutubeVideo;
use App\Models\StaticPage;
use Illuminate\Support\Carbon;
use App\Models\DepartmentModel;

class Home extends Component
{
  public $latestPosts;
  public $departments;
  public $events;
  public $teamMembers;
  public $albums;
  public $testimonials;
  public $featuredVideos;
  public $sliderContent;
  public $sliderSections;
  public $homeContent;
  public $contactInfo;

  protected function limitContent($content, $lines = 3)
  {
    if (empty($content)) {
      return 'Department information coming soon.';
    }

    // Split content into lines
    $contentLines = explode("\n", strip_tags($content));

    // Take only first 3 lines
    $limitedLines = array_slice($contentLines, 0, $lines);

    // Join lines back together
    return implode("\n", $limitedLines);
  }

  public function render()
  {
    $now = Carbon::now();
    // show album images 6 latest updated
    $this->albums = Album::with('images')->orderBy('updated_at', 'desc')->take(6)->get();

    // show 4 team members updated at
    $this->teamMembers = TeamMember::orderBy('updated_at', 'desc')->take(4)->get();
    $this->latestPosts = BlogPost::latest()->take(3)->get();
    $this->departments = DepartmentModel::all()->map(function ($dept) {
      $dept->content = $this->limitContent($dept->content);
      return $dept;
    });;
    $this->events = EventModel::whereDate('end_date', '>=', $now)
      ->orderBy('start_date', 'desc')->get();
    $this->testimonials = Testimonial::orderBy('created_at', 'desc')->take(5)->get();

    $this->featuredVideos = YoutubeVideo::where('order', 1)->first();

    // Fetch slider content from static pages
    $this->sliderContent = StaticPage::where('page_name', 'Homepage Sliders')->first();

    // Fetch homepage content from static pages with images from blog_images table
    $this->homeContent = StaticPage::where('page_name', 'Homepage Sections')->first();

    // Fetch contact information from settings
    $this->contactInfo = [
      'email' => setting('email'),
      'phone' => setting('phone'),
      'address' => setting('address'),
      'postal_address' => setting('postal_address'),
      'office_hours' => setting('office_hours'),
      'google_map' => setting('google_map'),
    ];

    return view('livewire.frontend.home', [
      'latestPosts' => $this->latestPosts,
      'departments' => $this->departments,
      'events' => $this->events,
      'testimonials' => $this->testimonials,
      'featuredVideos' => $this->featuredVideos,
      'sliderContent' => $this->sliderContent,
      'homeContent' => $this->homeContent,
      'contactInfo' => $this->contactInfo
    ]);
  }
}
