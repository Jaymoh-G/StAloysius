<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use App\Models\BlogPost;
use App\Models\JobVacancy;
use Illuminate\Support\Carbon;
use App\Models\Download;

class MediaCentre extends Component
{
    public $upcomingEvents;
    public $latestNews;
    public $latestJobs;
    public $recentDownloads;
    public $randomAlbums;

    public function mount()
    {
        // Get 3 upcoming events
        $now = Carbon::now();
        $this->upcomingEvents = EventModel::whereDate('end_date', '>=', $now)
            ->orderBy('start_date')
            ->take(3)
            ->get();

        // Get 3 latest news items
        $this->latestNews = BlogPost::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get 2 latest job vacancies
        $this->latestJobs = JobVacancy::where('is_active', true)
            ->where('deadline', '>=', now())
            ->latest()
            ->take(2)
            ->get();

        // Get 3 most recent downloads
        $this->recentDownloads = Download::orderBy('updated_at', 'desc')->take(3)->get();

        // Get random albums with cover images
        $this->randomAlbums = \App\Models\Album::whereNotNull('cover_image')
            ->inRandomOrder()
            ->take(8)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.media-centre');
    }
}
