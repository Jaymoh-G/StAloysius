<?php

namespace App\Livewire\Dashboard\Blogs\Categories;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    // Add listeners for category events
    protected $listeners = [
        'categorySaved' => '$refresh',
        'updateCategoryDeleted' => '$refresh'
    ];

    public function editCategory($id)
    {
        // Pass the ID to the modal component
        $this->dispatch('editUpdateCategory', $id);
    }

    public function deleteCategory($id)
    {
        // Pass the ID to the modal component
        $this->dispatch('deleteUpdateCategory', $id);
    }

    public function render()
    {
        return view('livewire.dashboard.blogs.categories.index', [
            'cats' => Category::latest()->get()
        ])->layout('components.layouts.dashboard');
    }
}


