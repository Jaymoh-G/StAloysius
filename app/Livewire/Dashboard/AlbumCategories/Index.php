<?php

namespace App\Livewire\Dashboard\AlbumCategories;

use App\Models\AlbumCategory;
use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
      public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted.');
    }
    public function render()
    {
        return view('livewire.dashboard.album-categories.index', [
            'categories' => AlbumCategory::latest()->get(),
        ])->layout('components.layouts.dashboard');
    }
}
