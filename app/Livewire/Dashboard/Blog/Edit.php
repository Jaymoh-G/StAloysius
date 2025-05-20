<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.dashboard.blog.edit')->layout('components.layouts.dashboard');
    }
}
