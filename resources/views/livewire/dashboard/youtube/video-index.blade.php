<div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h5 class="card-title">YouTube Videos</h5>
                        <h6 class="card-subtitle text-muted">Manage YouTube videos for your website</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Search videos..."
                                    wire:model.debounce.300ms="search"
                                />
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" wire:model="categoryFilter">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Add/Edit Form -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $isEditing ? "Edit Video" : "Add Video" }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" placeholder="Enter video title">
                                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <!-- Video ID -->
                                            <div class="mb-3">
                                                <label class="form-label">YouTube Video URL or ID</label>
                                                <input type="text" class="form-control @error('video_id') is-invalid @enderror" wire:model="video_id" placeholder="e.g. https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                                                @error('video_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                <small class="text-muted">Paste the full YouTube URL or just the video ID</small>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model="description" rows="3" placeholder="Enter video description"></textarea>
                                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <!-- Category -->
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <select class="form-select @error('album_category_id') is-invalid @enderror" wire:model="album_category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('album_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <!-- Display Order -->
                                            <div class="mb-3">
                                                <label class="form-label">Display Order</label>
                                                <input type="number" class="form-control @error('order') is-invalid @enderror" wire:model="order">
                                                @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <!-- Featured -->
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="featuredCheck" wire:model="is_featured">
                                                <label class="form-check-label" for="featuredCheck">Featured Video</label>
                                            </div>

                                            <!-- Thumbnail -->
                                            <div class="mb-3">
                                                <label class="form-label">Custom Thumbnail (Optional)</label>
                                                <input type="file" class="form-control @error('temp_thumbnail') is-invalid @enderror" wire:model="temp_thumbnail" accept="image/*">
                                                @error('temp_thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                                <div wire:loading wire:target="temp_thumbnail" class="mt-2">
                                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <span class="text-muted">Uploading...</span>
                                                </div>

                                                @if ($temp_thumbnail)
                                                    <div class="mt-2">
                                                        <img src="{{ $temp_thumbnail->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px;">
                                                    </div>
                                                @elseif($thumbnail && $isEditing)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $thumbnail) }}" class="img-thumbnail" style="max-height: 150px;">
                                                        <p class="text-muted small">Current thumbnail</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Buttons -->
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    {{ $isEditing ? "Update Video" : "Add Video" }}
                                                </button>
                                                @if ($isEditing)
                                                    <button type="button" class="btn btn-outline-secondary" wire:click="cancel">Cancel</button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Video Table -->
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Video</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Featured</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($videos as $video)
                                                <tr>
                                                    <td style="width: 120px">
                                                        <div class="position-relative">
                                                            @if ($video->thumbnail)
                                                                <img src="{{ asset('storage/' . $video->thumbnail) }}" class="img-fluid rounded" alt="{{ $video->title }}">
                                                            @else
                                                                <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" class="img-fluid rounded" alt="{{ $video->title }}">
                                                            @endif
                                                            <div class="position-absolute top-50 start-50 translate-middle">
                                                                <i class="fa fa-play-circle text-white" style="font-size: 2rem; opacity: 0.8;"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ $video->title }}</h6>
                                                        <small class="text-muted">ID: {{ $video->video_id }}</small>
                                                    </td>
                                                    <td>{{ $video->category ? $video->category->name : 'Uncategorized' }}</td>
                                                    <td>
                                                        @if ($video->is_featured)
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info me-1" wire:click="edit({{ $video->id }})">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $video->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No videos found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                @if ($videos->count() > 0)
                                    <div class="mt-3">
                                        {{ $videos->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <p class="text-center">Add videos to get started.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> <!-- End Card Body -->
                </div>
            </div>
        </div>
    </div>
</div>
