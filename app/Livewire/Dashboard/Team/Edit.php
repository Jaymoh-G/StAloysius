<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.dashboard.team.edit')->layout('components.layouts.dashboard');
    }
}
