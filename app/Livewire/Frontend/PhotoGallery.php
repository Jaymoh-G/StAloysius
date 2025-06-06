<?php

namespace App\Livewire\Frontend;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AlbumCategory;

class PhotoGallery extends Component
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
        $url = route('photos', ['category' => $categorySlug]);
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function resetFilter()
    {
        $this->categoryFilter = '';
        $this->resetPage();

        // Update URL without full page reload
        $url = route('photos');
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function render()
    {
        // Get categories that have albums
        $categories = AlbumCategory::whereHas('albums')->orderBy('name')->get();

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

        // Paginate albums - 9 per page (3 rows of 3 columns)
        $albums = $query->paginate(9);

        return view('livewire.frontend.photo-gallery', [
            'categories' => $categories,
            'albums' => $albums,
        ]);
    }
}