<?php

namespace App\Livewire\Dashboard\AlbumCategories;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\AlbumCategory;

class AlbumCategoryModal extends Component
{
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:album_categories,slug',
    ];

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }
public function save()
    {
        $this->validate();

        $category = AlbumCategory::create([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);

        // Dispatch event for parent component to refresh category list
        $this->dispatch('categoryAdded', category: $category);

        $this->reset(['name', 'slug']);
        $this->dispatch('closeModal');
    }
    public function render()
    {
        return view('livewire.dashboard.album-categories.album-category-modal');
    }
}
