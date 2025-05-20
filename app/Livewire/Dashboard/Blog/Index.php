<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;

class Index extends Component
{
    
    public function render()
    {
        return view('livewire.dashboard.blog.index')->layout('components.layouts.dashboard');
    }
}
