<?php

namespace App\Livewire\Dashboard\Blogs\Categories;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.blogs.categories.index',[
            'cats' => Category::latest()->get()
        ])->layout('components.layouts.dashboard');
    }
}
