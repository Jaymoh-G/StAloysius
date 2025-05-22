<?php

namespace App\Livewire\Dashboard\Departments\DepCategories;

use App\Models\DepCategory;
use Livewire\Component;

class Index extends Component
{
    public $name, $dep_category_id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:dep_categories,name',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->dep_category_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();
        DepCategory::create(['name' => $this->name]);
        session()->flash('message', 'Category added successfully.');
        $this->resetFields();
    }
    public function edit($id)
    {
        $dep_category = DepCategory::findOrFail($id);
        $this->dep_category_id = $id;
        $this->name = $dep_category->name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:dep_categories,name,' . $this->dep_category_id,
        ]);
        $dep_category = DepCategory::findOrFail($this->dep_category_id);
        $dep_category->update(['name' => $this->name]);
        session()->flash('message', 'Category updated.');
        $this->resetFields();

    }

    public function delete($id)
    {
        DepCategory::destroy($id);
        session()->flash('message', 'Category deleted.');

    }
    public function render()
    {
        return view('livewire.dashboard.departments.dep-categories.index', [
            'deps' => DepCategory::latest()->get(),
        ])->layout('components.layouts.dashboard');;
    }
}
