<?php

namespace App\Livewire\Frontend;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AlbumCategory;

class Gallery extends Component
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

    public function filterByCategory($categorySlug)
    {
        $this->categoryFilter = $categorySlug;
        $this->resetPage();

        // Update URL without full page reload
        $url = route('gallery', ['category' => $categorySlug]);
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function resetFilter()
    {
        $this->categoryFilter = '';
        $this->resetPage();

        // Update URL without full page reload
        $url = route('gallery');
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function render()
    {
        $categories = AlbumCategory::orderBy('name')->get();

        // Get albums with image counts
        $query = Album::select('albums.*')
            ->with('category')
            ->withCount('images');

        if ($this->categoryFilter) {
            // Find category by slug
            $category = AlbumCategory::where('slug', $this->categoryFilter)->first();
            if ($category) {
                $query->where('album_category_id', $category->id);
            }
        }

        $query->orderBy('created_at', 'desc');

        // Paginate albums - 6 per page (2 rows of 3 columns)
        $albums = $query->paginate(6);

        return view('livewire.frontend.gallery', [
            'categories' => $categories,
            'albums' => $albums,
        ]);
    }
}
































