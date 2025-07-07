<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;
use App\Models\BlogPost;
use App\Services\ActivityService;

class Index extends Component
{

    public $postIdToDelete;

    protected $listeners = ['deletePost'];

    public function deletePost($postId)
    {
        $this->dispatch('confirmDelete', id: $postId);
    }

    public function deletePostConfirmed($id)
    {
        if ($id) {
            $post = BlogPost::find($id);
            if ($post) {
                $title = $post->title;
                $post->delete();
                ActivityService::deleted($post, 'blog', "Deleted news post: {$title}");
                session()->flash('message', 'Blog post deleted successfully!');
            }
        }
    }

    public function render()
    {

        $posts = BlogPost::with('category', 'images')->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.dashboard.blog.index', compact('posts'))->layout('components.layouts.dashboard');
    }
}
