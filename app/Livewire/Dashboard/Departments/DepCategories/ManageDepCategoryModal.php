<?php

namespace App\Livewire\Dashboard\Departments\DepCategories;

use Livewire\Component;
use App\Models\DepCategory;

class ManageDepCategoryModal extends Component
{
    public $name;
    public $depCategoryId = null;
    protected $listeners = ['editDepCategory' => 'loadDepCategory'];
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
   public function loadDepCategory($id, $isDelete = false)
{
    $depCategory = DepCategory::findOrFail($id);
    $this->depCategoryId = $depCategory->id;
    $this->name = $depCategory->name;

    if ($isDelete) {
        $this->deleteCategory();
    }
}

    public function deleteDepCategory()
    {
        if ($this->depCategoryId) {
            DepCategory::find($this->depCategoryId)?->delete();
            session()->flash('message', 'Deparment Category deleted successfully!');
            $this->dispatch('categoryDeleted');
            $this->dispatch('closeModal');
            $this->reset();
        }
    }


    public function render()
    {
        return view('livewire.dashboard.departments.dep-categories.manage-dep-category-modal');
    }
}
