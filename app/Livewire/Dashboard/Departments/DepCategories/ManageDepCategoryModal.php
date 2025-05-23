<?php

namespace App\Livewire\Dashboard\Departments\DepCategories;

use Livewire\Component;
use App\Models\DepCategory;

class ManageDepCategoryModal extends Component
{
    public $name;
    public $depCategoryId = null;
    protected $listeners = [
        'editDepCategory' => 'loadDepCategory',
        'deleteDepCategory' => 'loadDepCategoryForDelete',  // new method for delete load
        'resetForm' => 'resetForm',

    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:dep_categories,name,' . $this->depCategoryId,
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->depCategoryId) {
            $depCategory = DepCategory::find($this->depCategoryId);
            $depCategory->update(['name' => $this->name]);
            session()->flash('message', ' Department Category updated successfully!');
        } else {
            $depCategory = DepCategory::create(['name' => $this->name]);
            session()->flash('message', 'Department Category created successfully!');
        }

        $this->dispatch('categorySaved', $depCategory->id);
        $this->dispatch('closeModal');

        $this->reset();
    }
    public function loadDepCategory($id)
    {
        $depCategory = DepCategory::findOrFail($id);
        $this->depCategoryId = $depCategory->id;
        $this->name = $depCategory->name;
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
            session()->flash('message', 'Department Category deleted successfully!');
            $this->dispatch('depCategoryDeleted');
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
