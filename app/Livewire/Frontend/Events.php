<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use Illuminate\Support\Carbon;

class Events extends Component
{
    public $upcomingEvents;
    public $pastEvents;
    public $hasMoreUpcomingEvents = false;
    public $hasMorePastEvents = false;

    public function mount()
    {
        $now = Carbon::now();

        // Get upcoming events (first 3)
        $allUpcomingEvents = EventModel::whereDate('end_date', '>=', $now)
            ->orderBy('start_date', 'desc')
            ->get();

        $this->upcomingEvents = $allUpcomingEvents->take(3);
        $this->hasMoreUpcomingEvents = $allUpcomingEvents->count() > 3;

        // Get past events (first 3)
        $allPastEvents = EventModel::whereDate('end_date', '<', $now)
            ->orderBy('end_date', 'desc')
            ->get();

        $this->pastEvents = $allPastEvents->take(6);
        $this->hasMorePastEvents = $allPastEvents->count() > 6;
    }

    public function render()
    {
        return view('livewire.frontend.events');
    }
}

