<?php

namespace App\Livewire\Dashboard\Youtube;

use App\Models\YoutubeVideo;
use App\Models\AlbumCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class VideoIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title;
    public $description;
    public $video_id;
    public $album_category_id;
    public $is_featured = false;
    public $order = 0;
    public $thumbnail;
    public $temp_thumbnail;
    public $videoId;
    public $isEditing = false;
    public $search = '';
    public $categoryFilter = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_id' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                // Extract video ID first
                $extractedId = $this->extractVideoId($value);

                // Check if it's a valid YouTube ID format (11 characters, alphanumeric with some special chars)
                if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $extractedId)) {
                    $fail('Please enter a valid YouTube URL or video ID.');
                }
            }],
            'album_category_id' => 'nullable|exists:album_categories,id',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'temp_thumbnail' => 'nullable|image|max:1024',
        ];
    }

    public function render()
    {
        $videos = YoutubeVideo::with('category')
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function($query) {
                $query->where('album_category_id', $this->categoryFilter);
            })
            ->orderBy('order')
            ->paginate(10);

        $categories = AlbumCategory::orderBy('name')->get();

        return view('livewire.dashboard.youtube.video-index', [
            'videos' => $videos,
            'categories' => $categories
        ])->layout('components.layouts.dashboard');
    }

    public function create()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'video_id' => $this->extractVideoId($this->video_id),
            'album_category_id' => $this->album_category_id,
            'is_featured' => $this->is_featured,
            'order' => $this->order,
            'published_at' => now(),
        ];

        if ($this->temp_thumbnail) {
            $data['thumbnail'] = $this->temp_thumbnail->store('youtube-thumbnails', 'public');
        }

        YoutubeVideo::create($data);

        $this->reset(['title', 'description', 'video_id', 'album_category_id', 'is_featured', 'order', 'temp_thumbnail']);

        // Refresh the page data
        $this->dispatch('videoAdded');

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Video added successfully!'
        ]);
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->videoId = $id;

        $video = YoutubeVideo::findOrFail($id);
        $this->title = $video->title;
        $this->description = $video->description;
        $this->video_id = $video->video_id;
        $this->album_category_id = $video->album_category_id;
        $this->is_featured = $video->is_featured;
        $this->order = $video->order;
        $this->thumbnail = $video->thumbnail;
    }

    public function update()
    {
        $this->validate();

        $video = YoutubeVideo::findOrFail($this->videoId);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'video_id' => $this->extractVideoId($this->video_id),
            'album_category_id' => $this->album_category_id,
            'is_featured' => $this->is_featured,
            'order' => $this->order,
        ];

        if ($this->temp_thumbnail) {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $data['thumbnail'] = $this->temp_thumbnail->store('youtube-thumbnails', 'public');
        }

        $video->update($data);

        $this->reset(['title', 'description', 'video_id', 'album_category_id', 'is_featured', 'order', 'temp_thumbnail']);
        $this->isEditing = false;
        $this->videoId = null;

        // Refresh the page data
        $this->dispatch('videoUpdated');

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Video updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $video = YoutubeVideo::findOrFail($id);

        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        $video->delete();

        // Refresh the page data
        $this->dispatch('videoDeleted');

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Video deleted successfully!'
        ]);
    }

    public function cancel()
    {
        $this->reset(['title', 'description', 'video_id', 'album_category_id', 'is_featured', 'order', 'temp_thumbnail']);
        $this->isEditing = false;
        $this->videoId = null;
    }

    private function extractVideoId($input)
    {
        // Handle full YouTube URLs
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $input, $matches)) {
            return $matches[1];
        }

        // Handle youtu.be short URLs
        if (preg_match('/youtu\.be\/([^?]+)/', $input, $matches)) {
            return $matches[1];
        }

        // Handle embed URLs
        if (preg_match('/youtube\.com\/embed\/([^?]+)/', $input, $matches)) {
            return $matches[1];
        }

        // If it's already just the ID, return it
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        return $input; // Return as is if no pattern matches
    }
}




