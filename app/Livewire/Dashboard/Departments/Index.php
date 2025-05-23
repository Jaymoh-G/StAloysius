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
    $this->depIdToDelete = $depId;
    $this->dispatch('show-delete-modal');
}

public function deletePostConfirmed()
{
    if ($this->depIdToDelete) {
        DepartmentModel::find($this->depIdToDelete)?->delete();
        session()->flash('message', 'Blog post deleted successfully!');
        $this->depIdToDelete = null;

        // Optionally refresh posts if you have caching or pagination
        // $this->loadPosts();
    }
}

    public function render()
    {
        $deps = DepartmentModel::with('depCategory','images') ->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.dashboard.departments.index',compact('deps'))->layout('components.layouts.dashboard');
    }
}
