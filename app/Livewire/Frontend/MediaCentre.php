<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use App\Models\BlogPost;
use App\Models\JobVacancy;
use Illuminate\Support\Carbon;

class MediaCentre extends Component
{
    public $upcomingEvents;
    public $latestNews;
    public $latestJobs;

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
    }

    public function render()
    {
        return view('livewire.frontend.media-centre');
    }
}


