<?php

namespace App\Livewire\Dashboard\Departments\DepCategories;

use Livewire\Component;
use App\Models\DepCategory;

class ManageDepCategoryModal extends Component
{
    public $name;
    public $depCategoryId = null;
    public $parentId = null;
    public $isMain = false;
    protected $listeners = [
        'editDepCategory' => 'loadDepCategory',
        'deleteDepCategory' => 'loadDepCategoryForDelete',
        'resetForm' => 'resetForm',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:dep_categories,name,' . $this->depCategoryId,
            'parentId' => 'nullable|exists:dep_categories,id',
            'isMain' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->depCategoryId) {
            $depCategory = DepCategory::find($this->depCategoryId);
            $depCategory->update([
                'name' => $this->name,
                'parent_id' => $this->isMain ? null : $this->parentId, // If it's a main category, no parent
                'is_main' => $this->isMain,
            ]);
            $message = 'Department Category updated successfully!';
        } else {
            $depCategory = DepCategory::create([
                'name' => $this->name,
                'parent_id' => $this->isMain ? null : $this->parentId, // If it's a main category, no parent
                'is_main' => $this->isMain,
            ]);
            $message = 'Department Category created successfully!';
        }

        // Dispatch event with the message
        $this->dispatch('categorySaved', $depCategory->id, $message);
        $this->dispatch('closeModal');

        $this->reset();
    }
    public function loadDepCategory($id)
    {
        $depCategory = DepCategory::findOrFail($id);
        $this->depCategoryId = $depCategory->id;
        $this->name = $depCategory->name;
        $this->parentId = $depCategory->parent_id;
        $this->isMain = $depCategory->is_main;
    }

    public function loadDepCategoryForDelete($id)
    {
        $this->reset(['name', 'depCategoryId']); // optional reset
        $depCategory = DepCategory::findOrFail($id);
        $this->depCategoryId = $depCategory->id;
        $this->name = $depCategory->name;
    }


    public function deleteDepCategory()
    {
        if ($this->depCategoryId) {
            DepCategory::find($this->depCategoryId)?->delete();
            $message = 'Department Category deleted successfully!';
            $this->dispatch('categoryDeleted', $message);
            $this->dispatch('closeModal');
            $this->reset();
        }
    }
    public function resetForm()
    {
        $this->reset(['name', 'depCategoryId']);
        $this->resetValidation();
        session()->forget('message');
    }

    public function render()
    {
        return view('livewire.dashboard.departments.dep-categories.manage-dep-category-modal');
    }
}







