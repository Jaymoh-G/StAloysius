<?php

namespace App\Livewire\Dashboard\Facilities;

use Livewire\Component; 
use App\Models\BlogImage;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\FacilityModel;
use Livewire\WithFileUploads;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads, WithPagination;
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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:facility_models,name,' . $this->facilityId,
            'slug' => 'required|string|max:255|unique:facility_models,slug,' . $this->facilityId,
            'content' => 'required',
            'department_id' => 'required|exists:department_models,id',
            'images.*' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'featuredImageIndex' => 'required',
        ];
    }

    protected $messages = [
        'featuredImageIndex.required' => 'Please select a featured image.',
        'department_id.required' => 'Please select a department.',
    ];

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount($facilityId = null)
    {
        $this->departments = DepartmentModel::all();
        $this->existingImages = collect([]);

        if ($facilityId) {
            $this->facilityId = $facilityId;
            $facility = FacilityModel::with('images')->findOrFail($facilityId);

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
        $this->validate($this->rules());

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
            $facility = FacilityModel::findOrFail($this->facilityId);
            $facility->update($data);
        } else {
            $facility = FacilityModel::create($data);
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
            if (is_numeric($this->featuredImageIndex)) {
                // New uploaded image
                $index = (int) $this->featuredImageIndex;
                if (isset($this->images[$index])) {
                    $image = $facility->images()->latest()->skip(count($this->images) - 1 - $index)->first();
                    if ($image) {
                        $image->update(['is_featured' => true]);
                    }
                }
            } elseif (str_starts_with($this->featuredImageIndex, 'existing_')) {
                $existingIndex = (int) str_replace('existing_', '', $this->featuredImageIndex);
                if (isset($facility->images[$existingIndex])) {
                    $facility->images[$existingIndex]->update(['is_featured' => true]);
                }
            }
        }

        // Upload new images
        foreach ($this->images as $index => $image) {
            $path = $image->store('facility_images', 'public');
            $facility->images()->create([
                'path' => $path,
                'is_featured' => ((string)$index === (string)$this->featuredImageIndex),
            ]);
        }

        session()->flash('message', $this->facilityId ? 'Facility updated!' : 'Facility created!');
        $this->dispatch('resetEditor');
        return redirect()->route('dashboard.facilities.index');
    }

    public function deleteImage($imageId)
    {
        $image = BlogImage::find($imageId);

        if ($image) {
            // Delete the file from storage
            Storage::disk('public')->delete($image->path);

            // Delete the database record
            $image->delete();

            // Refresh the existing images list
            $this->existingImages = $this->facilityId
                ? FacilityModel::with('images')->find($this->facilityId)->images
                : [];
        }
    }

    public function deleteBanner()
    {
        if ($this->existingBanner) {
            Storage::disk('public')->delete($this->existingBanner);
            $this->existingBanner = null;

            if ($this->facilityId) {
                $facility = FacilityModel::find($this->facilityId);
                $facility->banner = null;
                $facility->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.facilities.manage')
            ->layout('components.layouts.dashboard');
    }
}
