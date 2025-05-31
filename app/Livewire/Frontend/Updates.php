<?php

namespace App\Livewire\Frontend;

use App\Models\BlogPost;
use Livewire\Component;

class Updates extends Component
{
    public function render()
    {
         $news = BlogPost::orderBy('created_at', 'desc')->paginate(9);
        return view('livewire.frontend.updates',compact('news'));
    }
}
