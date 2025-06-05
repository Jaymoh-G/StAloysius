<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class PastEvents extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $now = Carbon::now();

        $pastEvents = EventModel::whereDate('end_date', '<', $now)
            ->orderBy('end_date', 'desc')
            ->paginate(9);

        return view('livewire.frontend.past-events', [
            'pastEvents' => $pastEvents
        ]);
    }
}

