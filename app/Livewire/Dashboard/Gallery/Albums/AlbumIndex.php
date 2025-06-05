<?php

namespace App\Livewire\Dashboard\Gallery\Albums;

use Livewire\Component;
use App\Models\Album;
use App\Models\AlbumCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlbumIndex extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title;
    public $description;
    public $album_category_id;
    public $cover_image;
    public $temp_cover_image;
    public $albumId;
    public $isEditing = false;
    public $searchTerm = '';
    public $categoryFilter = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:albums,title,' . $this->albumId,
            'description' => 'nullable|string',
            'album_category_id' => 'required|exists:album_categories,id',
            'temp_cover_image' => $this->isEditing ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function create()
    {
        $this->validate();

        // Generate a unique slug
        $slug = Str::slug($this->title);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists and append a number if it does
        while (Album::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Store cover image
        $coverPath = $this->temp_cover_image->store('albums/covers', 'public');

        Album::create([
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description,
            'album_category_id' => $this->album_category_id,
            'cover_image' => $coverPath,
        ]);

        $this->reset(['title', 'description', 'album_category_id', 'temp_cover_image']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Album created successfully!'
        ]);
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->albumId = $id;

        $album = Album::findOrFail($id);
        $this->title = $album->title;
        $this->description = $album->description;
        $this->album_category_id = $album->album_category_id;
        $this->cover_image = $album->cover_image;
    }

    public function update()
    {
        $this->validate();

        $album = Album::findOrFail($this->albumId);

        // Generate a new slug only if title has changed
        $slug = $album->slug;
        if ($album->title !== $this->title) {
            $slug = Str::slug($this->title);
            $originalSlug = $slug;
            $count = 1;

            // Check if slug exists and append a number if it does
            while (Album::where('slug', $slug)->where('id', '!=', $this->albumId)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description,
            'album_category_id' => $this->album_category_id,
        ];

        // Update cover image if a new one is uploaded
        if ($this->temp_cover_image) {
            // Delete old cover image
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }

            // Store new cover image
            $coverPath = $this->temp_cover_image->store('albums/covers', 'public');
            $data['cover_image'] = $coverPath;
        }

        $album->update($data);

        $this->reset(['title', 'description', 'album_category_id', 'temp_cover_image', 'cover_image', 'albumId', 'isEditing']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Album updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $album = Album::findOrFail($id);

        // Check if album has images
        if ($album->images->count() > 0) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Cannot delete album with images. Remove images first.'
            ]);
            return;
        }

        // Delete cover image
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }

        $album->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Album deleted successfully!'
        ]);
    }

    public function cancel()
    {
        $this->reset(['title', 'description', 'album_category_id', 'temp_cover_image', 'cover_image', 'albumId', 'isEditing']);
    }

    public function render()
    {
        $query = Album::query()
            ->with(['category', 'images'])
            ->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            });

        if ($this->categoryFilter) {
            $query->where('album_category_id', $this->categoryFilter);
        }

        $albums = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = AlbumCategory::orderBy('name')->get();

        return view('livewire.dashboard.gallery.albums.album-index', [
            'albums' => $albums,
            'categories' => $categories
        ])->layout('components.layouts.dashboard');
    }
}



