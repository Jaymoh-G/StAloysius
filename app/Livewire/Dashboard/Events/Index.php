<?php

namespace App\Livewire\Dashboard\Events;

use Livewire\Component;
use App\Models\EventModel;
use App\Services\ActivityService;
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
        $this->dispatch('confirmDelete', id: $eventId);
    }

    public function refreshList()
    {
        // Trigger any logic needed to refresh the list
        $this->resetPage(); // Optional if using pagination
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            $event = EventModel::find($id);
            if ($event) {
                $name = $event->name;
                $event->delete();
                ActivityService::deleted($event, 'events', "Deleted event: {$name}");
                session()->flash('message', 'Event deleted successfully!');
            }
        }
    }

    public function render()
    {
        $events = EventModel::with(['category', 'images' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->latest()->paginate(10);

        return view('livewire.dashboard.events.index', compact('events'))
            ->layout('components.layouts.dashboard');
    }
}
