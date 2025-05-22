<?php

namespace App\Livewire\Dashboard\Albums;

use App\Models\Album;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\AlbumCategory;
use Livewire\WithFileUploads;


class AlbumForm extends Component
{
    protected $listeners = ['categoryAdded' => 'refreshCategories'];

public function refreshCategories()
{
    $this->categories = \App\Models\AlbumCategory::all();
}

      use WithFileUploads;
    public $images = [];
        public $albumId;
    public $title, $slug, $description, $album_category_id;
    public $categories;

       protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:albums,slug,' . $this->albumId,
            'description' => 'nullable|string',
            'album_category_id' => 'required|exists:album_categories,id',
              'images.*' => 'image|max:2048', // Optional: Limit to 2MB per image
        ];
    }

    public function mount($albumId = null)
    {
        $this->categories = AlbumCategory::all();

                if ($albumId) {
            $album = Album::findOrFail($albumId);
            $this->albumId = $album->id;
            $this->title = $album->title;
            $this->slug = $album->slug;
            $this->description = $album->description;
            $this->album_category_id = $album->album_category_id;
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }
 public function save()
    {
        $this->validate();

           $imagePaths = [];

             if ($this->images && is_array($this->images)) {
        foreach ($this->images as $image) {
            $imagePaths[] = $image->store('albums', 'public');
        }
    }

        Album::updateOrCreate(
            ['id' => $this->albumId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'album_category_id' => $this->album_category_id,
                'images' => $imagePaths,
            ]
        );

        session()->flash('message', 'Album saved successfully!');
        return redirect()->route('albums.index');
    }


    public function render()
    {
        return view('livewire.dashboard.albums.album-form')->layout('components.layouts.dashboard');
    }
}
