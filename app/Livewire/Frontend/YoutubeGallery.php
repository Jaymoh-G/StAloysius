<?php

namespace App\Livewire\Frontend;

use App\Models\YoutubeVideo;
use App\Models\AlbumCategory;
use Livewire\Component;
use Livewire\WithPagination;

class YoutubeGallery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $categoryFilter = '';

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
        $url = route('videos', ['category' => $categorySlug]);
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function resetFilter()
    {
        $this->categoryFilter = '';
        $this->resetPage();

        // Update URL without full page reload
        $url = route('videos');
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function render()
    {
        // Use whereHas instead of has
        $categories = AlbumCategory::whereHas('videos')->orderBy('name')->get();

        $query = YoutubeVideo::with('category')->orderBy('order');

        if ($this->categoryFilter) {
            $category = AlbumCategory::where('slug', $this->categoryFilter)->first();
            if ($category) {
                $query->where('album_category_id', $category->id);
            }
        }

        $videos = $query->paginate(9);

        return view('livewire.frontend.youtube-gallery', [
            'videos' => $videos,
            'categories' => $categories,
        ]);
    }
}




