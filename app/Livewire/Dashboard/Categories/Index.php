<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    public $name, $category_id;
    public $updateMode = false;
    public $categoryToDelete = null;

    // Add listeners for delete confirmation
    protected $listeners = [
        'confirmDelete',
        'deleteConfirmed',
        'refreshCategories' => '$refresh'
    ];

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
    ];

    public function render()
    {
        return view('livewire.dashboard.categories.index', [
            'categories' => Category::latest()->get(),
        ])->layout('components.layouts.dashboard');
    }
    public function resetFields()
    {
        $this->name = '';
        $this->category_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();
        Category::create(['name' => $this->name]);
        session()->flash('message', 'Category added successfully.');
        $this->resetFields();
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $this->category_id,
        ]);
        $category = Category::findOrFail($this->category_id);
        $category->update(['name' => $this->name]);
        session()->flash('message', 'Category updated.');
        $this->resetFields();
    }

    // Updated delete method with confirmation
    public function confirmDelete($id)
    {
        $this->categoryToDelete = $id;
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            try {
                $category = Category::findOrFail($id);

                // Check if category has associated blog posts
                if ($category->blogPosts()->count() > 0) {
                    session()->flash('error', 'Cannot delete category. It has associated blog posts.');
                    return;
                }

                $category->delete();
                session()->flash('message', 'Category deleted successfully.');
            } catch (\Exception $e) {
                session()->flash('error', 'Error deleting category: ' . $e->getMessage());
            }
        }
    }

    // Legacy delete method - updated to use confirmation
    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }
}
