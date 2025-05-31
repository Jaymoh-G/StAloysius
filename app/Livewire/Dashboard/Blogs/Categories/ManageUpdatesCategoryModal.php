<?php

namespace App\Livewire\Dashboard\Blogs\Categories;

use Livewire\Component;
use App\Models\Category;

class ManageUpdatesCategoryModal extends Component

{
    public $name;
    public $updateCategoryId = null;
    protected $listeners = [
        'editUpdateCategory' => 'loadUpdateCategory',
        'deleteUpdateCategory' => 'loadUpdateCategoryForDelete',  // new method for delete load
        'resetForm' => 'resetForm',

    ];

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
            $updateCategory->update(['name' => $this->name]);
            session()->flash('message', ' Update Category updated successfully!');
        } else {
            $updateCategory = Category::create(['name' => $this->name]);
            session()->flash('message', 'Update Category created successfully!');
        }

        $this->dispatch('categorySaved', $updateCategory->id);
        $this->dispatch('closeModal');

        $this->reset();
    }
    public function loadUpdateCategory($id)
    {
        $updateCategory = Category::findOrFail($id);
        $this->updateCategoryId = $updateCategory->id;
        $this->name = $updateCategory->name;
    }

    public function loadUpdateCategoryForDelete($id)
    {
        $this->reset(['name', 'updateCategoryId']); // optional reset
        $updateCategory = Category::findOrFail($id);
        $this->updateCategoryId = $updateCategory->id;
        $this->name = $updateCategory->name;
    }


    public function deleteUpdateCategory()
    {
        if ($this->updateCategoryId) {
            Category::find($this->updateCategoryId)?->delete();
            session()->flash('message', 'Department Category deleted successfully!');
            $this->dispatch('updateCategoryDeleted');
            $this->dispatch('closeModal');
            $this->reset();
        }
    }
    public function resetForm()
    {
        $this->reset(['name', 'updateCategoryId']);
        $this->resetValidation();
        session()->forget('message');
    }



    public function render()
    {
        return view('livewire.dashboard.blogs.categories.manage-updates-category-modal');
    }
}
