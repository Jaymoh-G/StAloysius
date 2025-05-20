<?php

namespace App\Livewire\Dashboard\Departments;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.departments.index')->layout('components.layouts.dashboard');
    }
}
