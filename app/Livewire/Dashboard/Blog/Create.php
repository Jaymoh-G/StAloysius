<?php

namespace App\Livewire\Dashboard\Blog;

use Storage;
use Livewire\Component;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\BlogImage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title, $slug, $content, $category_id;
    public $paragraph1, $paragraph2, $paragraph3, $paragraph4, $paragraph5, $paragraph6, $paragraph7;
    public $paragraph8, $paragraph9, $paragraph10, $paragraph11, $paragraph12, $paragraph13, $paragraph14;
    public $paragraph15, $paragraph16, $paragraph17, $paragraph18, $paragraph19, $paragraph20, $paragraph21;
    public $postId;
    public $images = [];
    public $categories = [];
    public $featuredImageIndex = null;
    public $featured = false;
    public $banner;
    public $existingBanner;
    public $existingImages = [];
    public $validationErrors = [];
    protected $listeners = ['updateContent', 'categoryCreated' => 'refreshCategories'];


    public function mount($postId = null)
    {
        // Load categories immediately in mount
        $this->refreshCategories();

        if ($postId) {
            $this->postId = $postId;
            $post = BlogPost::with('images')->findOrFail($postId);

            $this->title = $post->title;
            $this->slug = Str::slug($this->title);
            $this->content = $post->content;
            $this->category_id = $post->category_id;
            $this->featured = $post->featured ?? false;
            $this->existingImages = $post->images;
            $this->existingBanner = $post->banner;

            foreach ($post->images as $index => $image) {
                if ($image->is_featured) {
                    $this->featuredImageIndex = 'existing_' . $index;
                    break;
                }
            }
            // Assign paragraphs
            for ($i = 1; $i <= 21; $i++) {
                $this->{'paragraph' . $i} = $post->{'paragraph' . $i};
            }
        }
    }

    public function updateContent($value)
    {
        $this->content = $value;

        // Extract paragraphs using a more robust pattern that matches HTML tags
        preg_match_all('/<(p|h[1-6]|div|section|article|blockquote)[^>]*>.*?<\/\1>/is', $value, $matches);
        $paragraphs = $matches[0]; // Capture entire HTML tags with content

        // Assign paragraphs to variables (up to 21)
        for ($i = 0; $i < 21; $i++) {
            $this->{'paragraph' . ($i + 1)} = $paragraphs[$i] ?? null;
        }
    }

    public function refreshCategories($newCategoryId = null)
    {
        $this->categories = Category::orderBy('name')->get();
        if ($newCategoryId) {
            $this->category_id = $newCategoryId;
        }
    }
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function submit($content)
    {
        $this->content = $content;

        // Define validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $this->postId,
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
        ];

        // Add image validation rules only if no existing images and no postId (new post)
        if (!$this->postId && count($this->existingImages) === 0) {
            $rules['images'] = 'required|array|min:1';
            $rules['images.*'] = 'image|max:2048';
        } else {
            $rules['images.*'] = 'nullable|image|max:2048';
        }

        // Add banner validation - required for new posts
        if (!$this->postId && !$this->existingBanner) {
            $rules['banner'] = 'required|image|max:2048';
        } else {
            $rules['banner'] = 'nullable|image|max:2048';
        }

        // Add featured image validation
        if (!$this->postId && !$this->featuredImageIndex && count($this->existingImages) === 0 && count($this->images) > 0) {
            $rules['featuredImageIndex'] = 'required';
        }

        // Validate
        $validatedData = $this->validate($rules, [
            'content.required' => 'The content field is required.',
            'images.required' => 'Please upload at least one image.',
            'featuredImageIndex.required' => 'Please select a featured image.',
            'category_id.required' => 'Please select a category.',
            'banner.required' => 'Please upload a banner image.',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'featured' => $this->featured,
        ];

        // Add all paragraphs to the data array
        for ($i = 1; $i <= 21; $i++) {
            $data['paragraph' . $i] = $this->{'paragraph' . $i};
        }

        if ($this->postId) {
            $blog = BlogPost::findOrFail($this->postId);
            $blog->update($data);
        } else {
            $blog = BlogPost::create($data);
        }

        if ($this->banner) {
            // Delete old banner if updating
            if ($this->existingBanner) {
                Storage::disk('public')->delete($this->existingBanner);
            }

            $bannerPath = $this->banner->store('blog_banners', 'public');
            $blog->banner = $bannerPath;
            $blog->save();
        }

        // Reset all existing images to not featured
        if ($this->postId) {
            foreach ($blog->images as $eIndex => $img) {
                $img->update(['is_featured' => false]);
            }
        }

        // Set featured for existing or new image
        if ($this->featuredImageIndex !== null) {
            if (is_numeric($this->featuredImageIndex)) {
                // New uploaded image
                $index = (int) $this->featuredImageIndex;
                if (isset($this->images[$index])) {
                    $image = $blog->images()->latest()->skip(count($this->images) - 1 - $index)->first();
                    if ($image) {
                        $image->update(['is_featured' => true]);
                    }
                }
            } elseif (str_starts_with($this->featuredImageIndex, 'existing_')) {
                $existingIndex = (int) str_replace('existing_', '', $this->featuredImageIndex);
                if (isset($blog->images[$existingIndex])) {
                    $blog->images[$existingIndex]->update(['is_featured' => true]);
                }
            }
        }

        foreach ($this->images as $index => $image) {
            $path = $image->store('blog_images', 'public');
            $blog->images()->create([
                'path' => $path,
                'is_featured' => $index == $this->featuredImageIndex,
            ]);
        }

        session()->flash('message', $this->postId ? 'Blog post updated!' : 'Blog post created!');
        $this->dispatch('resetEditor');
        return redirect()->route('dashboard.blog.index');
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
            $this->existingImages = $this->postId
                ? \App\Models\BlogPost::with('images')->find($this->postId)->images
                : [];
        }
    }

    public function deleteBanner()
    {
        if ($this->existingBanner) {
            Storage::disk('public')->delete($this->existingBanner);
            $this->existingBanner = null;

            if ($this->postId) {
                $blog = BlogPost::find($this->postId);
                $blog->banner = null;
                $blog->save();
            }
        }
    }


    public function render()
    {
        // Ensure categories are loaded in render method as well
        if (empty($this->categories)) {
            $this->refreshCategories();
        }

        return view('livewire.dashboard.blog.create')->layout('components.layouts.dashboard');
    }
}








