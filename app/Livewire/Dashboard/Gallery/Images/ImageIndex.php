<?php

namespace App\Livewire\Dashboard\Gallery\Images;

use Livewire\Component;
use App\Models\Album;
use App\Models\BlogImage; // Changed from Image to BlogImage
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageIndex extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $album_id = '';
    public $caption = '';
    public $images = [];
    public $imageId;
    public $isEditing = false;
    public $albumFilter = '';
    public $searchTerm = '';
    public $activeTab = 'upload'; // 'upload' or 'existing'
    public $selectedExistingImages = [];
    public $showExistingImageActions = false;
    public $selectedStorageImages = [];
    public $alertMessage = '';
    public $alertType = '';
    public $showOnlyUnused = false;

    protected $listeners = ['refreshImages' => '$refresh'];

    // Define rules separately to make them clearer
    protected function rules()
    {
        return [
            'album_id' => 'required|exists:albums,id',
            'caption' => 'nullable|string|max:255',
            'images' => $this->activeTab === 'upload' ? 'required|array|min:1' : 'nullable',
            'images.*' => $this->activeTab === 'upload' ? 'image|max:2048' : 'nullable',
            'selectedExistingImages' => $this->activeTab === 'existing' ? 'required|array|min:1' : 'nullable',
        ];
    }

    public function mount()
    {
        // Initialize with empty values
        $this->reset(['album_id', 'caption', 'images', 'imageId', 'isEditing', 'selectedExistingImages']);
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function toggleExistingImage($path)
    {
        if (in_array($path, $this->selectedExistingImages)) {
            $this->selectedExistingImages = array_diff($this->selectedExistingImages, [$path]);
        } else {
            $this->selectedExistingImages[] = $path;
        }
    }

    public function addExistingImagesToAlbum()
    {
        try {
            $this->validate([
                'album_id' => 'required|exists:albums,id',
                'caption' => 'nullable|string|max:255',
                'selectedExistingImages' => 'required|array|min:1',
            ]);

            $addedCount = 0;

            foreach ($this->selectedExistingImages as $path) {
                // Check if this image is already in the album
                $exists = BlogImage::where('album_id', $this->album_id)
                    ->where('path', $path)
                    ->exists();

                if (!$exists) {
                    BlogImage::create([
                        'album_id' => $this->album_id,
                        'path' => $path,
                        'caption' => $this->caption,
                        'blog_post_id' => null,
                    ]);
                    $addedCount++;
                }
            }

            $this->reset(['album_id', 'caption', 'selectedExistingImages']);
            $this->activeTab = 'upload';

            session()->flash('message', $addedCount . ' existing images added to album successfully!');

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => $addedCount . ' existing images added to album successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Error adding existing images: ' . $e->getMessage());

            session()->flash('error', 'Error adding existing images: ' . $e->getMessage());

            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Error adding existing images: ' . $e->getMessage()
            ]);
        }
    }

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            // Create a new array without the removed image
            $images = $this->images;
            unset($images[$index]);
            $this->images = array_values($images); // Re-index the array
        }
    }

    public function uploadImages()
    {
        try {
            Log::info('Starting image upload process');

            // Validate the form data
            $validatedData = $this->validate([
                'album_id' => 'required|exists:albums,id',
                'caption' => 'nullable|string|max:255',
                'images' => 'required|array|min:1',
                'images.*' => 'image|max:2048',
            ]);

            Log::info('Validation passed, processing ' . count($this->images) . ' images');

            $uploadCount = 0;

            foreach ($this->images as $image) {
                // Make sure each image is a valid UploadedFile object
                if (!$image || !method_exists($image, 'store')) {
                    Log::warning('Invalid image object encountered');
                    continue;
                }

                try {
                    Log::info('Storing image');
                    $path = $image->store('albums/images', 'public');
                    Log::info('Image stored at: ' . $path);

                    BlogImage::create([
                        'album_id' => $this->album_id,
                        'path' => $path,
                        'caption' => $this->caption,
                        'blog_post_id' => null,
                    ]);

                    $uploadCount++;
                    Log::info('Image record created successfully');
                } catch (\Exception $e) {
                    Log::error('Error storing image: ' . $e->getMessage());
                    // Continue with the next image
                }
            }

            Log::info('Upload process completed. Successfully uploaded: ' . $uploadCount . ' images');

            if ($uploadCount > 0) {
                $this->reset(['album_id', 'caption', 'images']);

                session()->flash('message', $uploadCount . ' images uploaded successfully!');

                $this->dispatch('alert', [
                    'type' => 'success',
                    'message' => $uploadCount . ' images uploaded successfully!'
                ]);
            } else {
                $this->addError('images', 'No valid images were uploaded.');

                session()->flash('error', 'No valid images were uploaded.');

                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'No valid images were uploaded.'
                ]);
            }

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Upload error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            session()->flash('error', 'Error uploading images: ' . $e->getMessage());

            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Error uploading images: ' . $e->getMessage()
            ]);
        }
    }

    public function editImage($id)
    {
        $this->isEditing = true;
        $this->imageId = $id;

        $image = BlogImage::findOrFail($id);
        $this->album_id = $image->album_id;
        $this->caption = $image->caption;
    }

    public function updateImage()
    {
        $this->validate([
            'album_id' => 'required|exists:albums,id',
            'caption' => 'nullable|string|max:255',
        ]);

        $image = BlogImage::findOrFail($this->imageId);
        $image->update([
            'album_id' => $this->album_id,
            'caption' => $this->caption,
        ]);

        $this->reset(['album_id', 'caption', 'imageId', 'isEditing']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Image updated successfully!'
        ]);
    }

    public function deleteImage($id)
    {
        $image = BlogImage::findOrFail($id);

        // Delete image file
        Storage::disk('public')->delete($image->path);

        $image->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Image deleted successfully!'
        ]);
    }

    public function cancel()
    {
        $this->reset(['album_id', 'caption', 'imageId', 'isEditing']);
    }

    public function updatedImages()
    {
        // Validate images as soon as they're uploaded
        if (is_array($this->images) && count($this->images) > 0) {
            try {
                $this->validateOnly('images.*', [
                    'images.*' => 'image|max:2048',
                ]);
            } catch (\Exception $e) {
                \Log::error('Image validation error: ' . $e->getMessage());
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'Error validating images: ' . $e->getMessage()
                ]);
            }
        }
    }

    public function toggleExistingImageActions()
    {
        $this->showExistingImageActions = !$this->showExistingImageActions;
        $this->selectedStorageImages = [];
    }

    public function toggleStorageImage($path)
    {
        if (in_array($path, $this->selectedStorageImages)) {
            $this->selectedStorageImages = array_diff($this->selectedStorageImages, [$path]);
        } else {
            $this->selectedStorageImages[] = $path;
        }
    }

    public function deleteStorageImages()
    {
        try {
            if (empty($this->selectedStorageImages)) {
                $this->alertType = 'error';
                $this->alertMessage = 'No images selected for deletion';
                return;
            }

            $deletedCount = 0;
            $errors = [];

            foreach ($this->selectedStorageImages as $path) {
                // Check if image is used in any BlogImage records
                $isUsed = BlogImage::where('path', $path)->exists();

                if ($isUsed) {
                    $errors[] = "Image '$path' is in use and cannot be deleted";
                    continue;
                }

                // Delete the file from storage
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    $deletedCount++;
                } else {
                    $errors[] = "File '$path' not found in storage";
                }
            }

            // Reset selection
            $this->selectedStorageImages = [];
            $this->showExistingImageActions = false;

            // Show success message
            if ($deletedCount > 0) {
                $this->alertType = 'success';
                $this->alertMessage = "$deletedCount images deleted successfully" .
                                     (count($errors) > 0 ? ". " . count($errors) . " errors occurred." : "!");
            } else if (count($errors) > 0) {
                $this->alertType = 'error';
                $this->alertMessage = "Failed to delete images: " . implode(", ", array_slice($errors, 0, 3)) .
                                     (count($errors) > 3 ? " and " . (count($errors) - 3) . " more errors" : "");
            }

        } catch (\Exception $e) {
            Log::error('Error deleting storage images: ' . $e->getMessage());
            $this->alertType = 'error';
            $this->alertMessage = 'Error deleting images: ' . $e->getMessage();
        }
    }

    public function toggleShowOnlyUnused()
    {
        $this->showOnlyUnused = !$this->showOnlyUnused;
        // Reset selections when toggling filter
        $this->selectedStorageImages = [];
        $this->selectedExistingImages = [];
    }

    public function render()
    {
        $query = BlogImage::query()
            ->with('album')
            ->where(function($q) {
                $q->where('caption', 'like', '%' . $this->searchTerm . '%');
            });

        if ($this->albumFilter) {
            $query->where('album_id', $this->albumFilter);
        }

        // Change pagination from 12 to 9 (3 rows × 3 columns)
        $images = $query->orderBy('created_at', 'desc')->paginate(9);
        $albums = Album::orderBy('title')->get();

        // Get all existing images from storage
        $existingImages = [];

        // Get all used image paths from the database
        $usedImagePaths = BlogImage::select('path')->distinct()->pluck('path')->toArray();

        // Get images from public storage directories
        $storageDirectories = ['albums/images', 'blog/images', 'uploads'];

        foreach ($storageDirectories as $directory) {
            if (Storage::disk('public')->exists($directory)) {
                $files = Storage::disk('public')->files($directory);
                foreach ($files as $file) {
                    if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                        // If showing only unused images, check if the image is used
                        $isUsed = in_array($file, $usedImagePaths);
                        if (!$this->showOnlyUnused || !$isUsed) {
                            $existingImages[] = [
                                'path' => $file,
                                'isUsed' => $isUsed
                            ];
                        }
                    }
                }
            }
        }

        // Sort images - unused first, then by path
        usort($existingImages, function($a, $b) {
            if ($a['isUsed'] !== $b['isUsed']) {
                return $a['isUsed'] ? 1 : -1; // Unused images first
            }
            return strcmp($a['path'], $b['path']); // Then alphabetically
        });

        return view('livewire.dashboard.gallery.images.image-index', [
            'galleryImages' => $images,
            'albums' => $albums,
            'existingImages' => $existingImages
        ])->layout('components.layouts.dashboard');
    }
}









