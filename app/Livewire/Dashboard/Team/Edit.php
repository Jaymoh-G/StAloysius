<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;

class Edit extends Component
{
    public $teamMemberId;

    public function mount($id)
    {
        $this->teamMemberId = $id;
    }

    public function render()
    {
        return view('livewire.dashboard.team.edit', [
            'teamMemberId' => $this->teamMemberId
        ]);
    }
}
