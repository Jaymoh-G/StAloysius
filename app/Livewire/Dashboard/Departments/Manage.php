<?php

namespace App\Livewire\Dashboard\Departments;

use Storage;
use Livewire\Component;
use App\Models\BlogImage;
use App\Models\DepartmentModel;
use App\Models\DepCategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;
    public $paragraphs = [];
    public $name, $slug, $content, $dep_category_id;
    public $depId;
    public $images = [];
    public $depCategories = [];
    public $featuredImageIndex = null;
    public $featured = false;
    public $banner;
    public $existingBanner;
    public $existingImages = [];
    protected $listeners = ['updateContent', 'depCreated' => 'refreshDepartments'];
    public $skipCategoryRefresh = false;

    public function mount($depId = null)
    {
        // Get main categories with their subcategories
        $this->depCategories = DepCategory::where('is_main', true)
            ->with('children')
            ->get()
            ->map(function ($mainCategory) {
                $mainCategory->formatted_name = $mainCategory->name;
                return $mainCategory;
            });

        // Get standalone categories (for backward compatibility)
        $standaloneCategories = DepCategory::whereNull('parent_id')
            ->where('is_main', false)
            ->get()
            ->map(function ($category) {
                $category->formatted_name = $category->name;
                return $category;
            });

        // Merge all categories
        $this->depCategories = $this->depCategories->concat($standaloneCategories);

        // Get subcategories and format their names
        $subcategories = DepCategory::whereNotNull('parent_id')
            ->with('parent')
            ->get()
            ->map(function ($subcategory) {
                $subcategory->formatted_name = "{$subcategory->parent->name} » {$subcategory->name}";
                return $subcategory;
            });

        // Add subcategories to the collection
        $this->depCategories = $this->depCategories->concat($subcategories);

        if ($depId) {
            $this->depId = $depId;
            $dep = DepartmentModel::with('images')->findOrFail($depId);

            $this->name = $dep->name;
            $this->slug = Str::slug($this->name);
            $this->content = $dep->content;
            $this->dep_category_id = $dep->dep_category_id;
            $this->featured = $dep->featured ?? false;
            $this->existingImages = $dep->images;
            $this->existingBanner = $dep->banner;

            foreach ($dep->images as $index => $image) {
                if ($image->is_featured) {
                    $this->featuredImageIndex = 'existing_' . $index;
                    break;
                }
            }
            // Assign paragraphs
            $this->paragraphs = [];
            for ($i = 1; $i <= 21; $i++) {
                $this->paragraphs[$i - 1] = $dep->{'paragraph' . $i};
            }
        }
    }

    public function updateContent($value)
    {
        // Set flag to skip category refresh
        $this->skipCategoryRefresh = true;

        // Update content
        $this->content = $value;

        // Reset flag after this update cycle
        $this->skipCategoryRefresh = false;

        // Extract paragraphs
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $value, $matches);
        $paragraphs = $matches[0]; // Capture entire HTML tags with content

        // Assign paragraphs to variables (sanitize or decode HTML as needed)
        $this->paragraphs = [];
        foreach ($paragraphs as $index => $para) {
            $this->paragraphs[$index] = $para;
        }

        // Preserve the selected category
        $this->dep_category_id = $this->dep_category_id;
    }
    public function refreshDepartments($newDepId = null)
    {
        // Get main categories with their subcategories
        $this->depCategories = DepCategory::where('is_main', true)
            ->with('children')
            ->get()
            ->map(function ($mainCategory) {
                $mainCategory->formatted_name = $mainCategory->name;
                return $mainCategory;
            });

        // Get standalone categories (for backward compatibility)
        $standaloneCategories = DepCategory::whereNull('parent_id')
            ->where('is_main', false)
            ->get()
            ->map(function ($category) {
                $category->formatted_name = $category->name;
                return $category;
            });

        // Merge all categories
        $this->depCategories = $this->depCategories->concat($standaloneCategories);

        // Get subcategories and format their names
        $subcategories = DepCategory::whereNotNull('parent_id')
            ->with('parent')
            ->get()
            ->map(function ($subcategory) {
                $subcategory->formatted_name = "{$subcategory->parent->name} » {$subcategory->name}";
                return $subcategory;
            });

        // Add subcategories to the collection
        $this->depCategories = $this->depCategories->concat($subcategories);

        if ($newDepId) {
            $this->dep_category_id = $newDepId;
        }
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required',
            'dep_category_id' => 'required|exists:dep_categories,id',
            'images.*' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'featuredImageIndex' => 'required',
            // Add other rules as needed
        ];
    }

    protected $messages = [
        'featuredImageIndex.required' => 'Please select a featured image.',
        'dep_category_id.required' => 'Please select a department category.',
    ];

    public function submit()
    {

        $this->validate([
            'name' => 'required|string|max:255|unique:department_models,name,' . $this->depId,
            'slug' => 'required|string|max:255|unique:department_models,slug,' . $this->depId,
            'dep_category_id' => 'required|exists:dep_categories,id',
            'content' => 'required|string',
         'images.*' => $this->depId ? 'nullable|image|max:2048' : 'required|image|max:2048',
         'banner' => $this->depId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'featured'=>'required',
        ]);

 // Correct paragraph extraction for HTML
    preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $this->content, $matches);
    $paragraphs = $matches[0];

        $this->paragraphs = [];

        foreach ($paragraphs as $index => $para) {
            if ($index < 21) {
                $this->paragraphs[$index + 1] = $para;
            }
        }

        // Then build $data
        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'content' => $this->content,
            'dep_category_id' => $this->dep_category_id,
            'featured' => $this->featured,
        ];

        foreach ($this->paragraphs as $index => $para) {
            if ($index >= 1 && $index <= 21) {
                $data['paragraph' . $index] = $para;
            }
        }


        if ($this->depId) {
            $dep = DepartmentModel::findOrFail($this->depId);
            $dep->update($data);
        } else {
            $dep = DepartmentModel::create($data);
        }
        if ($this->banner) {
            // Delete old banner if updating
            if ($this->existingBanner) {
                Storage::disk('public')->delete($this->existingBanner);
            }

            $bannerPath = $this->banner->store('dep_banners', 'public');
            $dep->banner = $bannerPath;
            $dep->save();
        }

        // Reset all existing images to not featured
        if ($this->depId) {
            foreach ($dep->images as $eIndex => $img) {
                $img->update(['is_featured' => false]);
            }
        }

        // Set featured for existing or new image
        if ($this->featuredImageIndex !== null) {
            if (is_numeric($this->featuredImageIndex)) {
                // New uploaded image
                $index = (int) $this->featuredImageIndex;
                if (isset($this->images[$index])) {
                    $image = $dep->images()->latest()->skip(count($this->images) - 1 - $index)->first();
                    if ($image) {
                        $image->update(['is_featured' => true]);
                    }
                }
            } elseif (str_starts_with($this->featuredImageIndex, 'existing_')) {
                $existingIndex = (int) str_replace('existing_', '', $this->featuredImageIndex);
                if (isset($dep->images[$existingIndex])) {
                    $dep->images[$existingIndex]->update(['is_featured' => true]);
                }
            }
        }

        foreach ($this->images as $index => $image) {
            $path = $image->store('dep_images', 'public');
            $dep->images()->create([
                'path' => $path,
                'is_featured' => ((string)$index === (string)$this->featuredImageIndex),
            ]);
        }
        session()->flash('message', $this->depId ? 'Department updated!' : 'Department created!');
        $this->dispatch('resetEditor');
        return redirect()->route('departments.index'); // 👈 Redirect to the listing page
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
            $this->existingImages = $this->depId
                ? DepartmentModel::with('images')->find($this->depId)->images
                : [];
        }
    }
    public function deleteBanner()
    {
        if ($this->existingBanner) {
            Storage::disk('public')->delete($this->existingBanner);
            $this->existingBanner = null;

            if ($this->depId) {
                $dep = DepartmentModel::find($this->depId);
                $dep->banner = null;
                $dep->save();
            }
        }
    }

    public function render()
    {
        // Only refresh categories if not skipping refresh
        if (!$this->skipCategoryRefresh) {
            $this->refreshDepartments();
        }

        return view('livewire.dashboard.departments.manage')->layout('components.layouts.dashboard');
    }
    public function hydrate()
    {
        // If we're updating content, preserve the selected category
        if ($this->skipCategoryRefresh) {
            // Store the current value
            $currentCategoryId = $this->dep_category_id;

            // After hydration completes, restore the value
            $this->dep_category_id = $currentCategoryId;
        }
    }
}


