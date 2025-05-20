<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\TeamMember as TeamMemberModel;  // ← alias it

class TeamMember extends Component
{
    public TeamMemberModel $member;
    public function mount($slug)
    {
        $this->member = TeamMemberModel::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.team-member');
    }
}
