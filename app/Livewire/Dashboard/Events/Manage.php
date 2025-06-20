<?php

namespace App\Livewire\Dashboard\Events;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\EventModel;
use App\Models\EventCategory;
use App\Models\BlogImage;
use Storage;

class Manage extends Component
{
    use WithFileUploads;

    // Core fields
    public $eventId;
    public $name, $slug, $content, $event_category_id, $featured = false;
    public $start_date, $end_date, $start_time, $end_time, $location;
    public $organizer_name, $organizer_description, $organizer_photo, $existingOrganizerPhoto;

    // Images & banner
    public $images = [], $existingImages = [], $featuredImageIndex = null;
    public $banner, $existingBanner;

    // Paragraphs & categories
    public $paragraphs = [];
    public $eventCategories = [];

    protected $listeners = ['updateContent'];

    public function mount($eventId = null)
    {
        $this->eventCategories = EventCategory::all();

        if ($eventId) {
            $this->eventId = $eventId;
            $event = EventModel::with('images')->findOrFail($eventId);

            // Fill basic fields
            $this->fill($event->only([
                'name',
                'slug',
                'content',
                'event_category_id',
                'start_time',
                'end_time',
                'location',
                'organizer_name',
                'organizer_description',
                'featured',
            ]));

            // Format dates for HTML date inputs (YYYY-MM-DD)
            $this->start_date = $event->start_date->format('Y-m-d');
            $this->end_date = $event->end_date->format('Y-m-d');

            // Fill media fields
            $this->existingImages = $event->images;
            $this->existingBanner = $event->banner;
            $this->existingOrganizerPhoto = $event->organizer_photo;

            // Set featured image
            foreach ($event->images as $index => $img) {
                if ($img->is_featured) {
                    $this->featuredImageIndex = 'existing_' . $index;
                    break;
                }
            }

            // Fill paragraphs
            for ($i = 1; $i <= 21; $i++) {
                $this->paragraphs[$i - 1] = $event->{'paragraph' . $i};
            }
        }
    }

    public function updateContent($value)
    {
        $this->content = $value;
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $value, $matches);
        $this->paragraphs = $matches[0] ?? [];
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function submit()
    {
        // Prepare validation rules
        $rules = [
            'name' => 'required|string|max:255|unique:event_models,name,' . $this->eventId,
            'slug' => 'required|string|max:255|unique:event_models,slug,' . $this->eventId,
            'event_category_id' => 'required|exists:event_categories,id',
            'content' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'organizer_name' => 'required|string|max:255',
            'organizer_description' => 'required|string',
            'organizer_photo' => $this->eventId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'banner' => $this->eventId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];

        // Only require gallery images if there are no existing images
        if (!$this->eventId || ($this->eventId && count($this->existingImages) === 0)) {
            $rules['images'] = 'required|array|min:1';
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        } else if (count($this->images) > 0) {
            // If uploading new images, validate them
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Run validation
        $this->validate($rules);

        // Check for featured image only if we have images (new or existing)
        if (($this->images && count($this->images) > 0) || count($this->existingImages) > 0) {
            if ($this->featuredImageIndex === null) {
                $this->addError('featuredImageIndex', 'Please select a featured image.');
                return;
            }
        }

        // Extract paragraphs from content
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $this->content, $matches);
        $this->paragraphs = array_slice($matches[0] ?? [], 0, 21);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'content' => $this->content,
            'event_category_id' => $this->event_category_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
            'organizer_name' => $this->organizer_name,
            'organizer_description' => $this->organizer_description,
            'featured' => (bool) $this->featured,
        ];

        foreach ($this->paragraphs as $i => $para) {
            $data['paragraph' . ($i + 1)] = $para;
        }

        $event = $this->eventId
            ? tap(EventModel::findOrFail($this->eventId))->update($data)
            : EventModel::create($data);

        // Upload banner
        if ($this->banner) {
            if ($this->existingBanner) Storage::disk('public')->delete($this->existingBanner);
            $event->update(['banner' => $this->banner->store('event_banners', 'public')]);
        }

        // Upload organizer photo
        if ($this->organizer_photo) {
            if ($this->existingOrganizerPhoto) Storage::disk('public')->delete($this->existingOrganizerPhoto);
            $event->update(['organizer_photo' => $this->organizer_photo->store('event_organizers', 'public')]);
        }

        // Reset featured flags on all images
        $event->images()->update(['is_featured' => false]);

        // Handle newly uploaded images
        if ($this->images && count($this->images) > 0) {
            foreach ($this->images as $index => $img) {
                $path = $img->store('event_images', 'public');
                $newImage = $event->images()->create([
                    'path' => $path,
                    'is_featured' => false,
                ]);

                // If this new image index matches featuredImageIndex, mark featured
                if ((string)$this->featuredImageIndex === (string)$index) {
                    $newImage->update(['is_featured' => true]);
                }
            }
        }

        // If featured image is from existing images
        if (str_starts_with($this->featuredImageIndex, 'existing_')) {
            $existingIndex = (int) str_replace('existing_', '', $this->featuredImageIndex);
            $existingImage = $this->existingImages[$existingIndex] ?? null;
            if ($existingImage) {
                $existingImage->update(['is_featured' => true]);
            }
        }

        session()->flash('message', $this->eventId ? 'Event updated!' : 'Event created!');
        return redirect()->route('dashboard.events.index');
    }

    public function deleteImage($imageId)
    {
        $image = BlogImage::find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
            $this->existingImages = EventModel::with('images')->find($this->eventId)->images ?? [];
        }
    }

    public function deleteBanner()
    {
        if ($this->existingBanner) {
            Storage::disk('public')->delete($this->existingBanner);
            EventModel::find($this->eventId)?->update(['banner' => null]);
            $this->existingBanner = null;
        }
    }

    public function deleteOrganizerPhoto()
    {
        if ($this->existingOrganizerPhoto) {
            Storage::disk('public')->delete($this->existingOrganizerPhoto);
            EventModel::find($this->eventId)?->update(['organizer_photo' => null]);
            $this->existingOrganizerPhoto = null;
        }
    }

    public function render()
    {
        $events = EventModel::with('category', 'images')->orderByDesc('updated_at')->get();
        return view('livewire.dashboard.events.manage', compact('events'))
            ->layout('components.layouts.dashboard');
    }
}




