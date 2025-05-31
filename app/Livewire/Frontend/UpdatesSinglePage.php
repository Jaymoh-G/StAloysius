<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\BlogPost;
use App\Models\Category;

class UpdatesSinglePage extends Component
{
    public $slug;
    public $blog;
    public $categories;



    public function mount($slug)
    {
        $this->slug = $slug;
        $this->blog = BlogPost::with('images')->where('slug', $slug)->firstOrFail();
        $this->categories = Category::withCount('blogPosts')->get();
    }
    public function render()

    {
        $recentPosts = BlogPost::orderBy('created_at', 'desc')->take(3)->get();
        return view('livewire.frontend.updates-single-page', compact('recentPosts'));
    }
}
