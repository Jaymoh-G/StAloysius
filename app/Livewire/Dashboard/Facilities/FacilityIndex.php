<?php

namespace App\Livewire\Dashboard\Facilities;

use Livewire\Component;

class FacilityIndex extends Component
{
    public function render()
    {
        return view('livewire.dashboard.facilities.facility-index')->layout('components.layouts.dashboard');
    }
}
