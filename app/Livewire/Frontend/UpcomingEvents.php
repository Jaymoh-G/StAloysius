<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class UpcomingEvents extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $now = Carbon::now();

        $upcomingEvents = EventModel::whereDate('end_date', '>=', $now)
            ->orderBy('start_date', 'desc')
            ->paginate(9);

        return view('livewire.frontend.upcoming-events', [
            'upcomingEvents' => $upcomingEvents
        ]);
    }
}

