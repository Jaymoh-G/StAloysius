<?php

namespace App\Livewire\Dashboard\Comments;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all'; // all, pending, approved
    public $commentIdToDelete;
    public $commentIdToApprove;

    protected $listeners = ['deleteComment', 'approveComment'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteComment($commentId)
    {
        $this->commentIdToDelete = $commentId;
        $this->dispatch('confirmDelete', ['id' => $commentId]);
    }

    public function deleteCommentConfirmed($id)
    {
        if ($id) {
            $comment = Comment::find($id);
            if ($comment) {
                $comment->delete();
                session()->flash('message', 'Comment deleted successfully!');
            }
        }
    }

    public function approveComment($commentId)
    {
        $this->commentIdToApprove = $commentId;
        $this->dispatch('confirmApprove', ['id' => $commentId]);
    }

    public function approveCommentConfirmed($id)
    {
        if ($id) {
            $comment = Comment::find($id);
            if ($comment) {
                $comment->update(['is_approved' => true]);
                session()->flash('message', 'Comment approved successfully!');
            }
        }
    }

    public function render()
    {
        $query = Comment::with(['blogPost', 'parent'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('comment', 'like', '%' . $this->search . '%')
                        ->orWhereHas('blogPost', function ($blogQuery) {
                            $blogQuery->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->filter === 'pending', function ($query) {
                $query->where('is_approved', false);
            })
            ->when($this->filter === 'approved', function ($query) {
                $query->where('is_approved', true);
            })
            ->orderBy('created_at', 'desc');

        $comments = $query->paginate(15);

        $stats = [
            'total' => Comment::count(),
            'pending' => Comment::where('is_approved', false)->count(),
            'approved' => Comment::where('is_approved', true)->count(),
        ];

        return view('livewire.dashboard.comments.index', [
            'comments' => $comments,
            'stats' => $stats,
        ])->layout('components.layouts.dashboard');
    }
}
