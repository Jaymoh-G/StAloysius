<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;
use App\Models\BlogPost;

class Create extends Component
{
    public $title;
    public $content;

    protected $listeners = ['updateContent'];

public function updateContent($value)
{
        dd($this->title,$this->content);

    $this->content = $value;
}


    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        BlogPost::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('message', 'Blog post created successfully!');
        $this->reset(['title', 'content']);
        $this->dispatch('resetEditor');
    }
    public function debug()
{
    dd($this->content,$this->title,);
}


    public function render()
    {
        return view('livewire.dashboard.blog.create')->layout('components.layouts.dashboard');
    }
}
