<?php

namespace App\Livewire\Dashboard\StaticPages;

use App\Models\StaticPage;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public $pageId;
    public $title;
    public $slug;
    public $content;
    public $meta_title;
    public $meta_description;
    public $banner_image;
    public $existingBanner;

    // Section content
    public $section_1_title;
    public $section_1_content;
    public $section_2_title;
    public $section_2_content;
    public $section_3_title;
    public $section_3_content;
    public $section_4_title;
    public $section_4_content;
    public $section_5_title;
    public $section_5_content;
    public $section_6_title;
    public $section_6_content;

    // For multiple images
    public $images = [];
    public $section_1_images = [];
    public $section_2_images = [];
    public $section_3_images = [];
    public $section_4_images = [];
    public $section_5_images = [];
    public $section_6_images = [];

    public $existingImages = [];
    public $existingSection1Images = [];
    public $existingSection2Images = [];
    public $existingSection3Images = [];
    public $existingSection4Images = [];
    public $existingSection5Images = [];
    public $existingSection6Images = [];

    public $activeTab = 'general';

    protected $rules = [
        'title' => 'required|min:3',
        'slug' => 'required',
        'content' => 'nullable',
        'meta_title' => 'nullable|max:70',
        'meta_description' => 'nullable|max:160',
        'banner_image' => 'nullable|image|max:2048',
        'images.*' => 'nullable|image|max:2048',
        'section_1_images.*' => 'nullable|image|max:2048',
        'section_2_images.*' => 'nullable|image|max:2048',
        'section_3_images.*' => 'nullable|image|max:2048',
        'section_4_images.*' => 'nullable|image|max:2048',
        'section_5_images.*' => 'nullable|image|max:2048',
        'section_6_images.*' => 'nullable|image|max:2048',
        'section_1_title' => 'nullable',
        'section_1_content' => 'nullable',
        'section_2_title' => 'nullable',
        'section_2_content' => 'nullable',
        'section_3_title' => 'nullable',
        'section_3_content' => 'nullable',
        'section_4_title' => 'nullable',
        'section_4_content' => 'nullable',
        'section_5_title' => 'nullable',
        'section_5_content' => 'nullable',
        'section_6_title' => 'nullable',
        'section_6_content' => 'nullable',
    ];

    protected $listeners = [
        'updateContent',
        'updateSection1Content',
        'updateSection2Content',
        'updateSection3Content',
        'updateSection4Content',
        'updateSection5Content',
        'updateSection6Content'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->pageId = $id;
            $page = StaticPage::findOrFail($id);
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->existingBanner = $page->banner_image;

            // Load section content
            $this->section_1_title = $page->section_1_title;
            $this->section_1_content = $page->section_1_content;
            $this->section_2_title = $page->section_2_title;
            $this->section_2_content = $page->section_2_content;
            $this->section_3_title = $page->section_3_title;
            $this->section_3_content = $page->section_3_content;
            $this->section_4_title = $page->section_4_title;
            $this->section_4_content = $page->section_4_content;
            $this->section_5_title = $page->section_5_title;
            $this->section_5_content = $page->section_5_content;
            $this->section_6_title = $page->section_6_title;
            $this->section_6_content = $page->section_6_content;

            // Load images
            $this->existingImages = $page->images()->where('category', 'general')->get();
            $this->existingSection1Images = $page->images()->where('category', 'section_1')->get();
            $this->existingSection2Images = $page->images()->where('category', 'section_2')->get();
            $this->existingSection3Images = $page->images()->where('category', 'section_3')->get();
            $this->existingSection4Images = $page->images()->where('category', 'section_4')->get();
            $this->existingSection5Images = $page->images()->where('category', 'section_5')->get();
            $this->existingSection6Images = $page->images()->where('category', 'section_6')->get();
        }
    }

    public function updatedTitle()
    {
        if (!$this->pageId) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function updateContent($content)
    {
        $this->content = $content;
    }

    public function updateSection1Content($content)
    {
        $this->section_1_content = $content;
    }

    public function updateSection2Content($content)
    {
        $this->section_2_content = $content;
    }

    public function updateSection3Content($content)
    {
        $this->section_3_content = $content;
    }

    public function updateSection4Content($content)
    {
        $this->section_4_content = $content;
    }

    public function updateSection5Content($content)
    {
        $this->section_5_content = $content;
    }

    public function updateSection6Content($content)
    {
        $this->section_6_content = $content;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'section_1_title' => $this->section_1_title,
            'section_1_content' => $this->section_1_content,
            'section_2_title' => $this->section_2_title,
            'section_2_content' => $this->section_2_content,
            'section_3_title' => $this->section_3_title,
            'section_3_content' => $this->section_3_content,
            'section_4_title' => $this->section_4_title,
            'section_4_content' => $this->section_4_content,
            'section_5_title' => $this->section_5_title,
            'section_5_content' => $this->section_5_content,
            'section_6_title' => $this->section_6_title,
            'section_6_content' => $this->section_6_content,
            'last_updated_by' => Auth::id(),
        ];

        if ($this->pageId) {
            $page = StaticPage::findOrFail($this->pageId);
            $page->update($data);
        } else {
            $page = StaticPage::create($data);
        }

        // Handle banner image
        if ($this->banner_image) {
            if ($this->existingBanner) {
                Storage::disk('public')->delete($this->existingBanner);
            }

            $bannerPath = $this->banner_image->store('static_page_banners', 'public');
            $page->banner_image = $bannerPath;
            $page->save();
        }

        // Handle general images
        $this->saveImages($page, $this->images, 'general');

        // Handle section images
        $this->saveImages($page, $this->section_1_images, 'section_1');
        $this->saveImages($page, $this->section_2_images, 'section_2');
        $this->saveImages($page, $this->section_3_images, 'section_3');
        $this->saveImages($page, $this->section_4_images, 'section_4');
        $this->saveImages($page, $this->section_5_images, 'section_5');
        $this->saveImages($page, $this->section_6_images, 'section_6');

        session()->flash('message', 'Page saved successfully!');
        return redirect()->route('dashboard.static-pages.index');
    }

    private function saveImages($page, $images, $category)
    {
        if (count($images) > 0) {
            $existingCount = $page->images()->where('category', $category)->count();

            foreach ($images as $index => $image) {
                $path = $image->store('static_page_images', 'public');
                $page->images()->create([
                    'path' => $path,
                    'caption' => '',
                    'category' => $category,
                    'sort_order' => $existingCount + $index + 1
                ]);
            }
        }
    }

    public function deleteImage($imageId)
    {
        $image = BlogImage::find($imageId);

        if ($image) {
            // Delete the file from storage
            Storage::disk('public')->delete($image->path);

            // Delete the database record
            $image->delete();

            // Refresh the existing images lists
            if ($this->pageId) {
                $page = StaticPage::findOrFail($this->pageId);
                $this->existingImages = $page->images()->where('category', 'general')->get();
                $this->existingSection1Images = $page->images()->where('category', 'section_1')->get();
                $this->existingSection2Images = $page->images()->where('category', 'section_2')->get();
                $this->existingSection3Images = $page->images()->where('category', 'section_3')->get();
                $this->existingSection4Images = $page->images()->where('category', 'section_4')->get();
                $this->existingSection5Images = $page->images()->where('category', 'section_5')->get();
                $this->existingSection6Images = $page->images()->where('category', 'section_6')->get();
            }
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.dashboard.static-pages.manage')->layout('components.layouts.dashboard');
    }
}


