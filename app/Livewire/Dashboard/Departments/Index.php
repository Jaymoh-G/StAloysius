<?php

namespace App\Livewire\Dashboard\Departments;

use Livewire\Component;
use App\Models\DepartmentModel;

class Index extends Component
{
    public $depIdToDelete;
    protected $listeners = ['deleteDep'];

    public function deleteDep($depId)
    {
        $this->dispatch('confirmDelete', id: $depId);
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            DepartmentModel::find($id)?->delete();
            session()->flash('message', 'Department deleted successfully!');
        }
    }

    public function render()
    {
        $deps = DepartmentModel::with(['depCategory', 'images' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.dashboard.departments.index', compact('deps'))->layout('components.layouts.dashboard');
    }
}
