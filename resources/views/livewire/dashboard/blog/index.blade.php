<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">News Posts</h4>
            <a
                href="{{ route('dashboard.blog.create') }}"
                class="btn btn-success"
            >
                <i class="bi bi-plus-lg"></i> Add News
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table table-hover table-responsive-sm align-middle"
                >
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th style="max-width: 300px">Title</th>
                            <th style="max-width: 300px">Post</th>
                            <th>Images</th>
                            <th>Banner</th>
                            <th>Category</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $index => $post)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td
                                style="
                                    max-width: 130px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                "
                            >
                                {{ Str::limit(strip_tags($post->title), 70) }}
                            </td>
                            <td
                                style="
                                    max-width: 130px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                "
                            >
                                {!! Str::limit(strip_tags($post->content), 70)
                                !!}
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @php $featured =
                                    $post->images->firstWhere('is_featured',
                                    true); $others = $post->images->where('id',
                                    '!=', optional($featured)->id)->take(4);
                                    @endphp @if($featured)
                                    <div class="position-relative">
                                        <img
                                            src="{{ asset('storage/' . $featured->path) }}"
                                            alt="Featured Image"
                                            class="img-thumbnail"
                                            style="height: 60px; width: 60px"
                                        />
                                        <span
                                            class="bg-white position-absolute top-0 start-0 m-1"
                                            ><i
                                                class="text-success bi bi-check-circle-fill"
                                            ></i
                                        ></span>
                                    </div>
                                    @endif @foreach($others as $image)
                                    <img
                                        src="{{ asset('storage/' . $image->path) }}"
                                        alt="Blog Image"
                                        class="img-thumbnail"
                                        style="height: 60px; width: 60px"
                                    />
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <img
                                    src="{{ asset('storage/' . $post->banner) }}"
                                    alt="No Custom Banner"
                                    class="img-thumbnail"
                                    style="height: 60px; width: auto"
                                />
                            </td>
                            <td style="max-width: 120px">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </td>
                            <td>{{ ($post->updated_at) }}</td>
                            <td class="text-end">
                                <a
                                    href="{{ route('news.single', $post->slug) }}"
                                    class="btn btn-success shadow btn-xs sharp me-1"
                                    title="view"
                                    target="_blank"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a
                                    href="{{ route('dashboard.blog.edit', $post->id) }}"
                                    class="btn btn-primary shadow btn-xs sharp me-1"
                                    title="Edit"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button
                                    class="btn btn-danger shadow btn-xs sharp"
                                    wire:click.prevent="deletePost({{ $post->id }})"
                                    title="Delete"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No blog posts found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div
        class="modal fade"
        id="deleteModal"
        tabindex="-1"
        aria-labelledby="deleteModalLabel"
        aria-hidden="true"
        wire:ignore.self
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Delete Blog Post
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
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
                        wire:click="deletePostConfirmed"
                        class="btn btn-danger"
                        data-bs-dismiss="modal"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener("show-delete-modal", (event) => {
        var deleteModal = new bootstrap.Modal(
            document.getElementById("deleteModal")
        );
        deleteModal.show();
    });
</script>
@endpush
