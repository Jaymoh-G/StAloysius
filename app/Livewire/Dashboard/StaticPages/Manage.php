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

    public $pageId, $title, $slug, $content, $meta_title, $meta_description;
    public $banner_image, $existingBanner, $page_name;
    public $paragraphs = [];
    public $images = [];
    public $existingImages = [];
    public $sections = [];
    public $activeTab = 'general';

    protected $listeners = ['updateContent', 'pageCreated' => 'refreshPages'];

    public function mount($id = null)
    {
        if ($id) {
            $page = StaticPage::findOrFail($id);
            $this->pageId = $page->id;
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->existingBanner = $page->banner_image;
            $this->existingImages = $page->images()->where('category', 'general')->get();
            $this->page_name = $page->page_name;

            // Load paragraphs
            for ($i = 1; $i <= 21; $i++) {
                $this->paragraphs[$i - 1] = $page->{'paragraph' . $i};
            }

            $this->loadSections($page);
        } else {
            $this->addSection();
        }
    }

    public function updatedTitle()
    {
        if (!$this->pageId) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function updateContent($value)
    {
        $this->content = $value;

        // Extract paragraphs using the same logic as the updates/news module
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $value, $matches);
        $paragraphs = $matches[0];
        for ($i = 0; $i < 21; $i++) {
            $this->paragraphs[$i] = $paragraphs[$i] ?? null;
        }
    }

    public function generateSlug()
    {
        if (!empty($this->title)) {
            $this->slug = Str::slug($this->title);
        }
    }

    protected function loadSections($page)
    {
        for ($i = 1; $i <= 10; $i++) {
            $titleField = "section_{$i}_title";
            $contentField = "section_{$i}_content";

            // Only load sections that have content (title or content)
            if (!empty($page->$titleField) || !empty($page->$contentField)) {
                $this->sections[] = [
                    'title' => $page->$titleField,
                    'content' => $page->$contentField,
                    'images' => [],
                    'existingImages' => $page->images()->where('category', "section_{$i}")->get(),
                ];
            }
        }

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
            'existingImages' => [],
        ];

        $this->dispatch('sectionsUpdated');
    }

    public function removeSection($index)
    {
        if (isset($this->sections[$index])) {
            unset($this->sections[$index]);
            $this->sections = array_values($this->sections);
        }

        $this->dispatch('sectionsUpdated');
    }

    public function removeSectionImage($sectionIndex, $imageIndex)
    {
        if (isset($this->sections[$sectionIndex]['images'][$imageIndex])) {
            unset($this->sections[$sectionIndex]['images'][$imageIndex]);
            $this->sections[$sectionIndex]['images'] = array_values($this->sections[$sectionIndex]['images']);
        }
    }

    public function deleteImage($imageId)
    {
        $image = BlogImage::find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();

            if ($this->pageId) {
                $page = StaticPage::find($this->pageId);
                $this->existingImages = $page->images()->where('category', 'general')->get();

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
                $page = StaticPage::find($this->pageId);
                $page->banner_image = null;
                $page->save();
                $this->existingBanner = null;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:static_pages,title,' . $this->pageId,
            'slug' => 'required|string|max:255|unique:static_pages,slug,' . $this->pageId,
            'content' => 'required|string',
            'meta_title' => 'nullable|max:70',
            'meta_description' => 'nullable|max:160',
            'page_name' => 'required|string|max:255|unique:static_pages,page_name,' . $this->pageId,
        ]);

        // Fallback: Extract paragraphs if Livewire updateContent wasn't triggered
        if (empty($this->paragraphs)) {
            preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $this->content, $matches);
            $paragraphs = $matches[0];
            for ($i = 0; $i < 21; $i++) {
                $this->paragraphs[$i] = $paragraphs[$i] ?? null;
            }
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

        for ($i = 0; $i < 21; $i++) {
            $data['paragraph' . ($i + 1)] = $this->paragraphs[$i] ?? null;
        }

        // Reset all section fields
        for ($i = 1; $i <= 10; $i++) {
            $data["section_{$i}_title"] = null;
            $data["section_{$i}_content"] = null;
        }

        foreach ($this->sections as $index => $section) {
            $i = $index + 1;
            if ($i <= 10) {
                $data["section_{$i}_title"] = $section['title'];
                $data["section_{$i}_content"] = $section['content'];
            }
        }

        $page = $this->pageId
            ? tap(StaticPage::findOrFail($this->pageId))->update($data)
            : StaticPage::create($data);

        if ($this->banner_image) {
            if ($this->existingBanner) {
                Storage::disk('public')->delete($this->existingBanner);
            }

            $page->banner_image = $this->banner_image->store('static_page_banners', 'public');
            $page->save();
        }

        foreach ($this->images as $i => $image) {
            $path = $image->store('static_page_images', 'public');
            $page->images()->create([
                'path' => $path,
                'caption' => '',
                'category' => 'general',
                'sort_order' => $i + 1,
            ]);
        }

        foreach ($this->sections as $index => $section) {
            $sectionNumber = $index + 1;
            foreach ($section['images'] ?? [] as $imgIndex => $image) {
                $path = $image->store('static_page_images', 'public');
                $page->images()->create([
                    'path' => $path,
                    'caption' => '',
                    'category' => "section_{$sectionNumber}",
                    'sort_order' => $imgIndex + 1,
                ]);
            }
        }

        session()->flash('message', 'Page saved successfully!');
        return redirect()->route('dashboard.static-pages.index');
    }

    public function render()
    {
        return view('livewire.dashboard.static-pages.manage')->layout('components.layouts.dashboard');
    }
}
