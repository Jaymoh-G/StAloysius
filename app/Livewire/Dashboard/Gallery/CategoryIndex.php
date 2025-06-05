<?php

namespace App\Livewire\Dashboard\Gallery;

use Livewire\Component;
use App\Models\AlbumCategory;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $categoryId;
    public $isEditing = false;
    public $searchTerm = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:album_categories,name,' . $this->categoryId,
        ];
    }

    public function create()
    {
        $this->validate();

        // Generate a unique slug
        $slug = Str::slug($this->name);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists and append a number if it does
        while (AlbumCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        AlbumCategory::create([
            'name' => $this->name,
            'slug' => $slug,
        ]);

        $this->reset(['name']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category created successfully!'
        ]);
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->categoryId = $id;

        $category = AlbumCategory::findOrFail($id);
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $category = AlbumCategory::findOrFail($this->categoryId);

        // Only regenerate slug if name has changed
        if ($category->name !== $this->name) {
            // Generate a unique slug
            $slug = Str::slug($this->name);
            $originalSlug = $slug;
            $count = 1;

            // Check if slug exists and append a number if it does
            while (AlbumCategory::where('slug', $slug)->where('id', '!=', $this->categoryId)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $category->slug = $slug;
        }

        $category->name = $this->name;
        $category->save();

        $this->reset(['name', 'categoryId', 'isEditing']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $category = AlbumCategory::findOrFail($id);

        // Check if category has albums
        if ($category->albums->count() > 0) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Cannot delete category with albums. Remove albums first.'
            ]);
            return;
        }

        $category->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category deleted successfully!'
        ]);
    }

    public function cancel()
    {
        $this->reset(['name', 'categoryId', 'isEditing']);
    }

    public function render()
    {
        $categories = AlbumCategory::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.dashboard.gallery.category-index', [
            'categories' => $categories
        ])->layout('components.layouts.dashboard');
    }
}




