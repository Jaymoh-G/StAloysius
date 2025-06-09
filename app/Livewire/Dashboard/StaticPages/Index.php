<?php

namespace App\Livewire\Dashboard\StaticPages;

use App\Models\StaticPage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pages = StaticPage::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy('title')
            ->paginate(10);

        return view('livewire.dashboard.static-pages.index', [
            'pages' => $pages
        ])->layout('components.layouts.dashboard');
    }

    public function deletePage($id)
    {
        $page = StaticPage::findOrFail($id);

        // Delete associated images
        foreach ($page->images as $image) {
            \Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        // Delete banner image if exists
        if ($page->banner_image) {
            \Storage::disk('public')->delete($page->banner_image);
        }

        $page->delete();
        session()->flash('message', 'Page deleted successfully.');
    }
}


