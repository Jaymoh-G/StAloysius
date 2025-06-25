<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\DepCategory;
use App\Models\DepartmentModel;
use App\Models\TeamMember;

class Department extends Component
{
    public $dep, $departments, $teamMembers;

    public function mount($slug)
    {
        $this->dep = DepartmentModel::with(['depCategory', 'featuredImage', 'images'])->where('slug', $slug)->firstOrFail();
        $this->departments = DepartmentModel::with(['depCategory'])->orderBy('name')->get();
        $this->teamMembers = TeamMember::where('department_id', $this->dep->id)->get();
    }

    public function render()
    {
        return view('livewire.frontend.department', [
            'dep' => $this->dep,
            'departments' => $this->departments,
            'teamMembers' => $this->teamMembers
        ]);
    }
}
