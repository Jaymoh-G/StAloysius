<?php

namespace App\Livewire\Dashboard\Events\Categories;

use Livewire\Component;
use App\Models\EventCategory;

class ManageEventCategoryModal extends Component
{
    public $name;
    public $eventCategoryId = null;

    protected $listeners = [
        'editEventCategory' => 'loadEventCategory',
        'deleteEventCategory' => 'loadEventCategoryForDelete',
        'resetEventCategoryForm' => 'resetForm',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:event_categories,name,' . $this->eventCategoryId,
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->eventCategoryId) {
            $eventCategory = EventCategory::find($this->eventCategoryId);
            $eventCategory->update(['name' => $this->name]);
            session()->flash('message', 'Event Category updated successfully!');
        } else {
            $eventCategory = EventCategory::create(['name' => $this->name]);
            session()->flash('message', 'Event Category created successfully!');
        }

        $this->dispatch('eventCategorySaved', $eventCategory->id);
        $this->dispatch('eventCategoryUpdated');

        $this->dispatch('closeModal');
        $this->reset();
    }

    public function loadEventCategory($id)
    {
        $eventCategory = EventCategory::findOrFail($id);
        $this->eventCategoryId = $eventCategory->id;
        $this->name = $eventCategory->name;
    }

    public function loadEventCategoryForDelete($id)
    {
        $this->reset(['name', 'eventCategoryId']);
        $eventCategory = EventCategory::findOrFail($id);
        $this->eventCategoryId = $eventCategory->id;
        $this->name = $eventCategory->name;
    }

    public function deleteEventCategory()
    {
        if ($this->eventCategoryId) {
            EventCategory::find($this->eventCategoryId)?->delete();
            session()->flash('message', 'Event Category deleted successfully!');
            $this->dispatch('eventCategoryDeleted');
            $this->dispatch('closeModal');
            $this->reset();
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'eventCategoryId']);
        $this->resetValidation();
        session()->forget('message');
    }

    public function render()
    {
        return view('livewire.dashboard.events.categories.manage-event-category-modal');
    }
}
