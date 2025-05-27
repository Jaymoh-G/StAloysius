<?php

namespace App\Livewire\Dashboard\Events\Categories;

use App\Models\EventCategory;
use Livewire\Component;
/**
 * @method \Illuminate\View\View layout(string $layout)
 */
class Index extends Component
{
    public $name, $event_category_id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:event_categories,name',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->event_category_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();
        EventCategory::create(['name' => $this->name]);
        session()->flash('message', 'Category added successfully.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $category = EventCategory::findOrFail($id);
        $this->event_category_id = $id;
        $this->name = $category->name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:event_categories,name,' . $this->event_category_id,
        ]);

        $category = EventCategory::findOrFail($this->event_category_id);
        $category->update(['name' => $this->name]);

        session()->flash('message', 'Category updated.');
        $this->resetFields();
    }

    public function delete($id)
    {
        EventCategory::destroy($id);
        session()->flash('message', 'Category deleted.');
    }

    public function render()
    {
        return view('livewire.dashboard.events.categories.index', [
            'categories' => EventCategory::latest()->get(),
        ])->layout('components.layouts.dashboard');
    }
}
