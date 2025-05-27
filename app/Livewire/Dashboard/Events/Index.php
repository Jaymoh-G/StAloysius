<?php

namespace App\Livewire\Dashboard\Events;

use Livewire\Component;
use App\Models\EventModel;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $eventIdToDelete;
  protected $listeners = [
    'deleteEvent',
    'eventCategoryUpdated' => 'refreshList',
];

    public function deleteEvent($eventId)
    {
        $this->eventIdToDelete = $eventId;
        $this->dispatch('show-delete-modal');
    }
public function refreshList()
{
    // Trigger any logic needed to refresh the list
    $this->resetPage(); // Optional if using pagination
}
    public function deleteConfirmed()
    {
        if ($this->eventIdToDelete) {
            EventModel::find($this->eventIdToDelete)?->delete();
            session()->flash('message', 'Event deleted successfully!');
            $this->eventIdToDelete = null;
        }
    }

    public function render()
    {
        $events = EventModel::latest()->paginate(10);

        return view('livewire.dashboard.events.index', compact('events'))
            ->layout('components.layouts.dashboard');
    }
}
