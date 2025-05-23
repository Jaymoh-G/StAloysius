<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\DepCategory;
use App\Models\DepartmentModel;

class Department extends Component
{
       public $dep,$depCats;
        public function mount($slug)
    {
         $this->dep = DepartmentModel::with('depCategory')->where('slug', $slug)->firstOrFail();
        $this->depCats = DepCategory::all();
    }


    public function render()
    {
         $deps = DepartmentModel::with('depCategory','images') ->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.frontend.department', compact('deps'));
    }
}
