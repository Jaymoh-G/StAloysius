<?php

namespace App\Livewire\Dashboard\AlbumCategories;

use App\Models\Album;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\AlbumCategory;


class AlbumCategoryForm extends Component
{
    public $categoryId;
    public $name, $slug;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:album_categories,slug',
    ];
    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $category = AlbumCategory::findOrFail($categoryId);
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
        }
    }
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function save()
    {
        $this->validate();

        AlbumCategory::updateOrCreate(
            ['id' => $this->categoryId],
            ['name' => $this->name, 'slug' => $this->slug]
        );

        session()->flash('message', 'Category saved successfully!');
        return redirect()->route('album.categories.index');
    }

    public function render()
    {
        return view('livewire.dashboard.album-categories.album-category-form')->layout('components.layouts.dashboard');
    }
}
