<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;
use App\Models\BlogPost;

class Index extends Component
{

    public $postIdToDelete;

    protected $listeners = ['deletePost'];

    public function deletePost($postId)
    {
        $this->postIdToDelete = $postId;
        $this->dispatch('show-delete-modal');
    }

    public function deletePostConfirmed()
    {
        if ($this->postIdToDelete) {
            BlogPost::find($this->postIdToDelete)?->delete();
            session()->flash('message', 'Blog post deleted successfully!');
            $this->postIdToDelete = null;

            // Optionally refresh posts if you have caching or pagination
            // $this->loadPosts();
        }
    }

    public function render()
    {

        $posts = BlogPost::with('category', 'images')->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.dashboard.blog.index', compact('posts'))->layout('components.layouts.dashboard');
    }
}
