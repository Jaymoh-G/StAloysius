<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EventModel;
use App\Models\EventCategory;

class Event extends Component
{public $event,$eventCats;
         public function mount($slug)
    {
         $this->event = EventModel::with('Category')->where('slug', $slug)->firstOrFail();
         $this->event = EventModel::with(['Category', 'featuredImage'])->where('slug', $slug)->firstOrFail();

        $this->eventCats = EventCategory::all();
    }
    public function render()
    {
          $events = EventModel::with('Category','images') ->orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.frontend.event',compact('events'));
    }
}
