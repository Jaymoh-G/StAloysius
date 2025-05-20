<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\TeamMember;

class OurTeam extends Component
{
    public function render()
    {
        return view('livewire.frontend.our-team', [
            'members' => TeamMember::latest()->get()
        ]);
    }
}
