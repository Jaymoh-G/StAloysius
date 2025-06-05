<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\BlogImage;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categoryFilter = '';

    public function filterByCategory($categoryId)
    {
        $this->categoryFilter = $categoryId;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->categoryFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $categories = AlbumCategory::orderBy('name')->get();

        // Get albums with image counts
        $query = Album::select('albums.*')
            ->with('category')
            ->withCount('images')
            ->when($this->categoryFilter, function($q) {
                return $q->where('album_category_id', $this->categoryFilter);
            })
            ->orderBy('created_at', 'desc');

        // Paginate albums - 9 per page (3 rows of 3 columns)
        $albums = $query->paginate(9);

        return view('livewire.frontend.gallery', [
            'categories' => $categories,
            'albums' => $albums,
        ]);
    }
}











