<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\DepCategory;
use App\Models\DepartmentModel;
use App\Models\TeamMember;

class Department extends Component
{
    public $dep, $depCats, $teamMembers;

    public function mount($slug)
    {
        $this->dep = DepartmentModel::with(['depCategory', 'featuredImage', 'images'])->where('slug', $slug)->firstOrFail();
        $this->depCats = DepCategory::all();
        $this->teamMembers = TeamMember::where('department_id', $this->dep->id)->get();
    }

    public function render()
    {
        $deps = DepartmentModel::with(['depCategory', 'images'])->orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.frontend.department', compact('deps'));
    }
}
