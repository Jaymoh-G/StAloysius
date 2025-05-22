<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class Departments extends Component
{
     protected $fillable = ['name','slug','content','dep_category_id', 'paragraph1',
        'paragraph2',
        'paragraph3',
        'paragraph4',
        'paragraph5',
        'paragraph6',
        'paragraph7',];

    public function render()
    {
        return view('livewire.frontend.departments');
    }
}
