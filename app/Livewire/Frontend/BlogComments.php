<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Request;

class BlogComments extends Component
{
    public $blogPost;
    public $name = '';
    public $email = '';
    public $comment = '';
    public $parentId = null;
    public $replyTo = null;
    public $turnstile_token;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|max:255',
        'comment' => 'required|min:10|max:1000',
        'turnstile_token' => 'required|string',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'name.min' => 'Name must be at least 2 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'comment.required' => 'Please enter your comment.',
        'comment.min' => 'Comment must be at least 10 characters.',
        'comment.max' => 'Comment cannot exceed 1000 characters.',
        'turnstile_token.required' => 'Please complete the CAPTCHA.',
    ];

    public function mount(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    public function setReplyTo($commentId)
    {
        $this->replyTo = $commentId;
        $this->parentId = $commentId;
        $this->dispatch('scrollToCommentForm');
    }

    public function cancelReply()
    {
        $this->replyTo = null;
        $this->parentId = null;
    }

    public function submitComment()
    {
        $this->validate();
        // TODO: Add server-side Turnstile verification here

        $comment = Comment::create([
            'blog_post_id' => $this->blogPost->id,
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment,
            'parent_id' => $this->parentId,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'is_approved' => false, // Comments need approval by default
        ]);

        // Reset form
        $this->reset(['name', 'email', 'comment', 'parentId', 'replyTo']);

        session()->flash('message', 'Your comment has been submitted and is awaiting approval.');
    }

    public function render()
    {
        $comments = $this->blogPost->topLevelComments()
            ->with(['replies' => function ($query) {
                $query->approved()->orderBy('created_at', 'asc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.frontend.blog-comments', [
            'comments' => $comments,
            'commentsCount' => $this->blogPost->approvedComments()->count(),
        ]);
    }
}
