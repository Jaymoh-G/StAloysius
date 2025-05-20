<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use App\Models\TeamMember;
use Livewire\WithPagination;

class Index extends Component
{

 use WithPagination;

    public function render()
    {
        return view('livewire.dashboard.team.index',[
            'teamMembers' => TeamMember::latest()->paginate(10),
        ])->layout('components.layouts.dashboard');
    }
}
