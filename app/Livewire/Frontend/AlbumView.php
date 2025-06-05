<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Album;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AlbumView extends Component
{
    public $album;
    public $slug;
    public $images = [];

    public function mount($slug)
    {
        $this->slug = $slug;

        // Get the album
        $this->album = Album::where('slug', $slug)->firstOrFail();

        // Log album ID for debugging
        Log::info('Loading album: ' . $this->album->id . ' - ' . $this->album->title);

        // Get images for this album and filter out missing files
        $dbImages = BlogImage::where('album_id', $this->album->id)
                    ->orderBy('sort_order', 'asc')
                    ->get();

        // Filter images to only include those that exist in storage
        $this->images = $dbImages->filter(function($image) {
            $exists = Storage::disk('public')->exists($image->path);
            if (!$exists) {
                Log::warning('Image file missing: ' . $image->path);
            }
            return $exists;
        });

        Log::info('Found ' . $dbImages->count() . ' total images, ' . $this->images->count() . ' exist in storage');
    }

    public function render()
    {
        return view('livewire.frontend.album-view');
    }
}


