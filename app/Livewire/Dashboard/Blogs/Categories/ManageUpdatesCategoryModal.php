<?php

namespace App\Livewire\Dashboard\Blogs\Categories;

use Livewire\Component;
use App\Models\Category;

class ManageUpdatesCategoryModal extends Component
{
    public $name;
    public $updateCategoryId = null;
    public $isDeleteMode = false;

    // Update listeners to use dispatch/listen pattern
    protected $listeners = [
        'editUpdateCategory',
        'deleteUpdateCategory',
        'resetForm',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->updateCategoryId,
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->updateCategoryId) {
            $updateCategory = Category::find($this->updateCategoryId);
            if ($updateCategory) {
                $updateCategory->update(['name' => $this->name]);
                session()->flash('message', 'Update Category updated successfully!');
            } else {
                session()->flash('error', 'Category not found!');
                return;
            }
        } else {
            $updateCategory = Category::create(['name' => $this->name]);
            session()->flash('message', 'Update Category created successfully!');
        }

        $this->dispatch('categorySaved');
        $this->dispatch('closeModal');
        $this->resetForm();
    }

    public function editUpdateCategory($id)
    {
        try {
            $updateCategory = Category::findOrFail($id);
            $this->updateCategoryId = $updateCategory->id;
            $this->name = $updateCategory->name;
            $this->isDeleteMode = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading category: ' . $e->getMessage());
        }
    }

    public function deleteUpdateCategory($id)
    {
        try {
            $updateCategory = Category::findOrFail($id);
            $this->updateCategoryId = $updateCategory->id;
            $this->name = $updateCategory->name;
            $this->isDeleteMode = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading category for delete: ' . $e->getMessage());
        }
    }

    public function confirmDelete()
    {
        if ($this->updateCategoryId) {
            try {
                $category = Category::findOrFail($this->updateCategoryId);

                // Check if category has associated blog posts
                if ($category->blogPosts()->count() > 0) {
                    session()->flash('error', 'Cannot delete category. It has associated blog posts.');
                    return;
                }

                $category->delete();
                session()->flash('message', 'Category deleted successfully!');
                $this->dispatch('updateCategoryDeleted');
                $this->dispatch('closeModal');
                $this->resetForm();
            } catch (\Exception $e) {
                session()->flash('error', 'Error deleting category: ' . $e->getMessage());
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'updateCategoryId', 'isDeleteMode']);
        $this->resetValidation();
        session()->forget(['message', 'error']);
    }

    public function render()
    {
        return view('livewire.dashboard.blogs.categories.manage-updates-category-modal');
    }
}


