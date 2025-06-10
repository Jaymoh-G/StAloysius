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
    public $page_name;

    // For multiple images
    public $images = [];
    public $existingImages = [];

    // Dynamic sections
    public $sections = [];

    public $activeTab = 'general';

    protected $rules = [
        'title' => 'required|min:3',
        'slug' => 'required',
        'content' => 'nullable',
        'meta_title' => 'nullable|max:70',
        'meta_description' => 'nullable|max:160',
        'banner_image' => 'nullable|image|max:2048',
        'images.*' => 'nullable|image|max:2048',
        'sections.*.title' => 'nullable',
        'sections.*.content' => 'nullable',
        'sections.*.images.*' => 'nullable|image|max:2048',
    ];

    public function rules()
    {
        return [
            'page_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:static_pages,slug,' . ($this->pageId ?? ''),
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'images.*' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ];
    }

    public function generateSlug()
    {
        if (!empty($this->title)) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function mount($pageId = null)
    {
        if ($pageId) {
            $page = StaticPage::findOrFail($pageId);
            $this->pageId = $page->id;
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->existingBanner = $page->banner_image;
            $this->existingImages = $page->images;
            $this->page_name = $page->page_name;

            // Load sections
            $this->loadSections($page);
        } else {
            // Initialize with one empty section for new pages
            $this->addSection();
        }
    }

    protected function loadSections($page)
    {
        // Check for section data
        for ($i = 1; $i <= 10; $i++) {
            $titleField = "section_{$i}_title";
            $contentField = "section_{$i}_content";

            if (!empty($page->$titleField) || !empty($page->$contentField)) {
                $this->sections[] = [
                    'title' => $page->$titleField,
                    'content' => $page->$contentField,
                    'images' => [],
                    'existingImages' => $page->images()->where('category', "section_{$i}")->get()
                ];
            }
        }

        // If no sections were found, add an empty one
        if (empty($this->sections)) {
            $this->addSection();
        }
    }

    public function addSection()
    {
        $this->sections[] = [
            'title' => '',
            'content' => '',
            'images' => [],
            'existingImages' => []
        ];

        $this->dispatch('sectionsUpdated');
    }

    public function removeSection($index)
    {
        if (isset($this->sections[$index])) {
            unset($this->sections[$index]);
            $this->sections = array_values($this->sections); // Re-index array
        }

        $this->dispatch('sectionsUpdated');
    }

    public function updatedTitle()
    {
        if (!$this->pageId) {
            $this->slug = Str::slug($this->title);
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

                // Refresh section images
                foreach ($this->sections as $index => $section) {
                    $sectionNumber = $index + 1;
                    if ($sectionNumber <= 10) {
                        $this->sections[$index]['existingImages'] = $page->images()
                            ->where('category', "section_{$sectionNumber}")
                            ->get();
                    }
                }
            }
        }
    }

    public function deleteBanner()
    {
        if ($this->existingBanner) {
            Storage::disk('public')->delete($this->existingBanner);

            if ($this->pageId) {
                $page = StaticPage::findOrFail($this->pageId);
                $page->banner_image = null;
                $page->save();
                $this->existingBanner = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.static-pages.manage')->layout('components.layouts.dashboard');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:static_pages,title,' . $this->pageId,
            'slug' => 'required|string|max:255|unique:static_pages,slug,' . $this->pageId,
            'content' => 'required|string',
            'meta_title' => 'nullable|max:70',
            'meta_description' => 'nullable|max:160',
            'page_name' => 'required|string|max:255',
        ], [
            'content.required' => 'The content field is required.',
            'title.required' => 'The title field is required.',
            'slug.required' => 'The slug field is required.',
            'page_name.required' => 'The page name field is required.',
        ]);

        // Check if content is empty after stripping HTML tags
        if (empty(strip_tags($this->content))) {
            $this->addError('content', 'The content field is required.');
            return;
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'last_updated_by' => Auth::id(),
            'page_name' => $this->page_name,
        ];

        // Clear all section fields first
        for ($i = 1; $i <= 10; $i++) {
            $data["section_{$i}_title"] = null;
            $data["section_{$i}_content"] = null;
        }

        // Then set the ones we have
        foreach ($this->sections as $index => $section) {
            $sectionNumber = $index + 1;
            if ($sectionNumber <= 10) { // Limit to 10 sections
                $data["section_{$sectionNumber}_title"] = $section['title'];
                $data["section_{$sectionNumber}_content"] = $section['content'];
            }
        }

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
        foreach ($this->images as $index => $image) {
            $path = $image->store('static_page_images', 'public');
            $page->images()->create([
                'path' => $path,
                'caption' => '',
                'category' => 'general',
                'sort_order' => $index + 1,
            ]);
        }

        // Handle section images
        foreach ($this->sections as $index => $section) {
            $sectionNumber = $index + 1;
            if ($sectionNumber <= 10 && isset($section['images']) && count($section['images']) > 0) {
                foreach ($section['images'] as $imgIndex => $image) {
                    $path = $image->store('static_page_images', 'public');
                    $page->images()->create([
                        'path' => $path,
                        'caption' => '',
                        'category' => "section_{$sectionNumber}",
                        'sort_order' => $imgIndex + 1,
                    ]);
                }
            }
        }

        session()->flash('message', 'Page saved successfully!');
        return redirect()->route('dashboard.static-pages.index');
    }
}
