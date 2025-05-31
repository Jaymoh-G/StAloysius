<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class Events extends Component
{

    public function render()
    {
        $now = Carbon::now();

        $upcomingEvents = EventModel::whereDate('end_date', '>=', $now)
            ->orderBy('start_date')
            ->get();

        $pastEvents = EventModel::whereDate('end_date', '<', $now)
            ->orderByDesc('end_date')
            ->get();
        return view('livewire.frontend.events', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
    }
}
