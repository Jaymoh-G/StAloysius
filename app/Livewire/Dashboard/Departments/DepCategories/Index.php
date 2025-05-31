<?php

namespace App\Livewire\Dashboard\Departments\DepCategories;

use App\Models\DepCategory;
use Livewire\Component;
/**
 * @method \Illuminate\View\View layout(string $layout)
 */
class Index extends Component
{
    public $name, $dep_category_id;
    public $updateMode = false;

    // Add a listener for the categorySaved event
    protected $listeners = [
        'categorySaved' => 'handleCategorySaved',
        'categoryDeleted' => 'handleCategoryDeleted',
        'depCategoryDeleted' => '$refresh'
    ];

    public function handleCategorySaved($categoryId = null, $message = null)
    {
        if ($message) {
            session()->flash('message', $message);
        }
        $this->dispatch('$refresh');
    }

    public function handleCategoryDeleted($message = null)
    {
        if ($message) {
            session()->flash('message', $message);
        }
        $this->dispatch('$refresh');
    }

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
        // Refresh the component
        $this->dispatch('categorySaved');
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
        // Refresh the component
        $this->dispatch('categorySaved');
    }

    public function delete($id)
    {
        DepCategory::destroy($id);
        session()->flash('message', 'Category deleted successfully.');
        $this->dispatch('$refresh');
    }

    public function render()
    {
        // Get main categories with their subcategories
        $mainCategories = DepCategory::where('is_main', true)
            ->with('children')
            ->latest()
            ->get();

        // Get categories that don't have a parent (for backward compatibility)
        $standaloneCategories = DepCategory::whereNull('parent_id')
            ->where('is_main', false)
            ->latest()
            ->get();

        return view('livewire.dashboard.departments.dep-categories.index', [
            'mainCategories' => $mainCategories,
            'standaloneCategories' => $standaloneCategories,
        ])->layout('components.layouts.dashboard');
    }
}








