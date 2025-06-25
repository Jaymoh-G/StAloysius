<?php

namespace App\Livewire\Frontend;

use App\Models\BlogPost;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Updates extends Component
{
    use WithPagination;

    public $categoryFilter = '';
    protected $paginationTheme = 'bootstrap';

    public function mount($category = null)
    {
        if ($category) {
            $this->categoryFilter = $category;
        }
    }

    public function render()
    {
        $query = BlogPost::orderBy('created_at', 'desc');

        if ($this->categoryFilter) {
            $category = Category::where('slug', $this->categoryFilter)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $news = $query->paginate(9);
        $categories = Category::has('blogPosts')->get();

        return view('livewire.frontend.updates', compact('news', 'categories'));
    }
}
