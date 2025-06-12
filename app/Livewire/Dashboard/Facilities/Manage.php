<?php

namespace App\Livewire\Dashboard\Facilities;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\BlogImage;
use App\Models\Facility;
use App\Models\DepartmentModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;
    public $paragraphs = [];
    public $name, $slug, $content, $department_id;
    public $facilityId;
    public $images = [];
    public $departments = [];
    public $featuredImageIndex = null;
    public $featured = false;
    public $banner;
    public $existingBanner;
    public $existingImages;
    protected $listeners = ['updateContent', 'facilityCreated' => 'refreshFacilities'];
    public $skipDepartmentRefresh = false;

    public function mount($facilityId = null)
    {
        $this->departments = DepartmentModel::all();
        $this->existingImages = collect([]);

        if ($facilityId) {
            $this->facilityId = $facilityId;
            $facility = Facility::with('images')->findOrFail($facilityId);

            $this->name = $facility->name;
            $this->slug = Str::slug($this->name);
            $this->content = $facility->content;
            $this->department_id = $facility->department_id;
            $this->featured = $facility->featured ?? false;
            $this->existingImages = $facility->images;
            $this->existingBanner = $facility->banner;

            foreach ($facility->images as $index => $image) {
                if ($image->is_featured) {
                    $this->featuredImageIndex = 'existing_' . $index;
                    break;
                }
            }
            // Assign paragraphs
            $this->paragraphs = [];
            for ($i = 1; $i <= 7; $i++) {
                $this->paragraphs[$i - 1] = $facility->{'paragraph' . $i};
            }
        }
    }

    public function updateContent($value)
    {
        $this->skipDepartmentRefresh = true;
        $this->content = $value;
        $this->skipDepartmentRefresh = false;

        // Extract paragraphs
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $value, $matches);
        $paragraphs = $matches[0];

        // Assign paragraphs to variables
        $this->paragraphs = [];
        foreach ($paragraphs as $index => $para) {
            $this->paragraphs[$index] = $para;
        }

        // Preserve the selected department
        $this->department_id = $this->department_id;
    }

    public function refreshFacilities($newFacilityId = null)
    {
        if ($newFacilityId) {
            $this->facilityId = $newFacilityId;
            $this->mount($newFacilityId);
        }
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'department_id' => 'required|exists:department_models,id',
            'content' => 'required',
            'banner' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Extract paragraphs from content
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $this->content, $matches);
        $paragraphs = $matches[0];

        $this->paragraphs = [];

        foreach ($paragraphs as $index => $para) {
            if ($index < 7) {
                $this->paragraphs[$index + 1] = $para;
            }
        }

        // Then build $data
        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'content' => $this->content,
            'department_id' => $this->department_id,
            'featured' => $this->featured,
        ];

        foreach ($this->paragraphs as $index => $para) {
            if ($index >= 1 && $index <= 7) {
                $data['paragraph' . $index] = $para;
            }
        }

        if ($this->facilityId) {
            $facility = Facility::findOrFail($this->facilityId);
            $facility->update($data);
        } else {
            $facility = Facility::create($data);
        }

        if ($this->banner) {
            // Delete old banner if updating
            if ($this->existingBanner) {
                Storage::disk('public')->delete($this->existingBanner);
            }

            $bannerPath = $this->banner->store('facility_banners', 'public');
            $facility->banner = $bannerPath;
            $facility->save();
        }

        // Reset all existing images to not featured
        if ($this->facilityId) {
            foreach ($facility->images as $eIndex => $img) {
                $img->update(['is_featured' => false]);
            }
        }

        // Set featured for existing or new image
        if ($this->featuredImageIndex) {
            if (str_starts_with($this->featuredImageIndex, 'existing_')) {
                $index = explode('_', $this->featuredImageIndex)[1];
                $facility->images[$index]->update(['is_featured' => true]);
            } else {
                $index = $this->featuredImageIndex;
                if (isset($this->images[$index])) {
                    $path = $this->images[$index]->store('facility_images', 'public');
                    BlogImage::create([
                        'imageable_id' => $facility->id,
                        'imageable_type' => Facility::class,
                        'path' => $path,
                        'is_featured' => true
                    ]);
                }
            }
        }

        // Upload new images
        foreach ($this->images as $index => $image) {
            if ($index != $this->featuredImageIndex) {
                $path = $image->store('facility_images', 'public');
                BlogImage::create([
                    'imageable_id' => $facility->id,
                    'imageable_type' => Facility::class,
                    'path' => $path,
                    'is_featured' => false
                ]);
            }
        }

        session()->flash('message', 'Facility saved successfully!');
        return redirect()->route('facilities.index');
    }

    public function render()
    {
        return view('livewire.dashboard.facilities.manage')->layout('components.layouts.dashboard');
    }
}
