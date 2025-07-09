<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Category;
use App\Models\BlogPost;
use Livewire\WithPagination;

class NewsCategory extends Component
{
    use WithPagination;

    public $categorySlug;
    public $category;

    public function mount($category)
    {
        $this->categorySlug = $category;
        $this->category = Category::where('slug', $category)->firstOrFail();
    }

    public function render()
    {
        $news = BlogPost::where('category_id', $this->category->id)
            ->with(['category', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('livewire.frontend.news-category', [
            'news' => $news,
            'category' => $this->category
        ]);
    }
}
