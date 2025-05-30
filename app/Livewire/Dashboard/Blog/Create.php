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
    public $title, $slug, $content, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $paragraph5, $paragraph6, $paragraph7, $category_id;
    public $postId;
    public $images = [];
    public $categories = [];
    public $featuredImageIndex = null;
    public $featured = false;
    public $banner;
    public $existingBanner;
    public $existingImages = [];
    protected $listeners = ['updateContent', 'categoryCreated' => 'refreshCategories'];


    public function mount($postId = null)
    {


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
            for ($i = 1; $i <= 7; $i++) {
                $this->{'paragraph' . $i} = $post->{'paragraph' . $i};
            }
        }
    }

    public function updateContent($value)
    {

        $this->content = $value;
        // Extract paragraphs
        preg_match_all('/<p[^>]*>(.*?)<\/p>/i', $value, $matches);
        $paragraphs = $matches[1];

        // Assign paragraphs to variables (sanitize or decode HTML as needed)
        for ($i = 0; $i < 7; $i++) {
            $this->{'paragraph' . ($i + 1)} = $paragraphs[$i] ?? null;
        }
    }

    public function refreshCategories($newCategoryId = null)
    {
        $this->categories = Category::all();
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
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $this->postId,
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|max:2048',
            'banner' => 'image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'featured' => $this->featured,
            'paragraph1' => $this->paragraph1,
            'paragraph2' => $this->paragraph2,
            'paragraph3' => $this->paragraph3,
            'paragraph4' => $this->paragraph4,
            'paragraph5' => $this->paragraph5,
            'paragraph6' => $this->paragraph6,
            'paragraph7' => $this->paragraph7,
        ];

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
            $blog->images()->create(['path' => $path, 'is_featured' => $index == $this->featuredImageIndex,]);
        }
        session()->flash('message', $this->postId ? 'Blog post updated!' : 'Blog post created!');
        $this->dispatch('resetEditor');
        return redirect()->route('dashboard.blog.index'); // 👈 Redirect to the listing page
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
        return view('livewire.dashboard.blog.create')->layout('components.layouts.dashboard');
    }
}
