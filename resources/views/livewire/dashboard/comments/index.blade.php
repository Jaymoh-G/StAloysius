<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="page-title">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="page-title-content">
                            <h3 class="mb-2">Comments Management</h3>
                            <p class="mb-2 d-none d-md-block">
                                Manage blog comments and approvals
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="page-title-content">
                            <div class="d-flex justify-content-end">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="badge bg-primary"
                                            >{{ $stats["total"] }} Total</span
                                        >
                                    </div>
                                    <div class="me-3">
                                        <span class="badge bg-warning"
                                            >{{
                                                $stats["pending"]
                                            }}
                                            Pending</span
                                        >
                                    </div>
                                    <div class="me-3">
                                        <span class="badge bg-success"
                                            >{{
                                                $stats["approved"]
                                            }}
                                            Approved</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session("message") }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <select
                                        wire:model="filter"
                                        class="form-select"
                                    >
                                        <option value="all">
                                            All Comments
                                        </option>
                                        <option value="pending">
                                            Pending Approval
                                        </option>
                                        <option value="approved">
                                            Approved
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <div class="search-box">
                                    <input
                                        type="text"
                                        wire:model.debounce.300ms="search"
                                        class="form-control"
                                        placeholder="Search comments..."
                                    />
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Commenter</th>
                                    <th>Comment</th>
                                    <th>Blog Post</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="{{ $comment->avatar }}"
                                                alt="{{ $comment->name }}"
                                                class="rounded-circle me-2"
                                                width="40"
                                                height="40"
                                            />
                                            <div>
                                                <h6 class="mb-0">
                                                    {{ $comment->name }}
                                                </h6>
                                                <small
                                                    class="text-muted"
                                                    >{{ $comment->email }}</small
                                                >
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="comment-preview">
                                            {{ Str::limit($comment->comment, 100) }}
                                            @if($comment->parent)
                                            <br /><small class="text-muted"
                                                >Reply to:
                                                {{ $comment->parent->name }}</small
                                            >
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('news.single', $comment->blogPost->slug) }}"
                                            target="_blank"
                                        >
                                            {{ Str::limit($comment->blogPost->title, 50) }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($comment->is_approved)
                                        <span class="badge bg-success"
                                            >Approved</span
                                        >
                                        @else
                                        <span class="badge bg-warning"
                                            >Pending</span
                                        >
                                        @endif
                                    </td>
                                    <td>
                                        {{ $comment->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if(!$comment->is_approved)
                                            <button
                                                class="btn btn-sm btn-success me-2"
                                                wire:click="approveComment({{ $comment->id }})"
                                            >
                                                <i class="fas fa-check"></i>
                                                Approve
                                            </button>
                                            @endif
                                            <button
                                                class="btn btn-sm btn-danger"
                                                wire:click="deleteComment({{ $comment->id }})"
                                            >
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted">
                                            No comments found.
                                        </p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete this comment? This
                        action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        wire:click="deleteCommentConfirmed({{
                            $commentIdToDelete
                        }})"
                        data-bs-dismiss="modal"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Approval</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this comment?</p>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="btn btn-success"
                        wire:click="approveCommentConfirmed({{
                            $commentIdToApprove
                        }})"
                        data-bs-dismiss="modal"
                    >
                        Approve
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.on("confirmDelete", (data) => {
                const modal = new bootstrap.Modal(
                    document.getElementById("deleteModal")
                );
                modal.show();
            });

            Livewire.on("confirmApprove", (data) => {
                const modal = new bootstrap.Modal(
                    document.getElementById("approveModal")
                );
                modal.show();
            });
        });
    </script>
</div>
