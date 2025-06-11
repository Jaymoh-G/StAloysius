<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">News Posts</h4>
            <a href="{{ route('dashboard.blog.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Add News
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-hover table-responsive-sm table align-middle">
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
                                ">
                                    {{ Str::limit(strip_tags($post->title), 70) }}
                                </td>
                                <td
                                    style="
                                    max-width: 130px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
                                    {!! Str::limit(strip_tags($post->content), 70) !!}
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $featured = $post->images->where('is_featured', true)->first();
                                            $others = $post->images->where('is_featured', false)->take(4);
                                        @endphp
                                        @if ($featured)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $featured->path) }}"
                                                    alt="Featured Image" class="img-thumbnail"
                                                    style="height: 60px; width: 60px" />
                                                <span class="position-absolute start-0 top-0 m-1 bg-white"><i
                                                        class="text-success bi bi-check-circle-fill"></i></span>
                                            </div>
                                        @endif
                                        @foreach ($others as $image)
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Blog Image"
                                                class="img-thumbnail" style="height: 60px; width: 60px" />
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $post->banner) }}" alt="No Custom Banner"
                                        class="img-thumbnail" style="height: 60px; width: auto" />
                                </td>
                                <td style="max-width: 120px">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </td>
                                <td>{{ $post->updated_at }}</td>
                                <td class="text-end">
                                    <a href="{{ route('news.single', $post->slug) }}"
                                        class="btn btn-success btn-xs sharp me-1 shadow" title="view" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.blog.edit', $post->id) }}"
                                        class="btn btn-primary btn-xs sharp me-1 shadow" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs sharp me-1 shadow"
                                        wire:click.prevent="deletePost({{ $post->id }})">
                                        <i class="fas fa-trash"></i>
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
                <div class="d-flex justify-content-center mt-3">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('confirmDelete', (data) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deletePostConfirmed(data.id);
                        Swal.fire(
                            'Deleted!',
                            'Blog post has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
@endpush
