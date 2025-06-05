<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Albums Management</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Search albums..." wire:model.live="searchTerm">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" wire:model.live="categoryFilter">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 text-end">
                            <a href="{{ route('dashboard.gallery.images') }}" class="btn btn-info">
                                <i class="fa fa-images"></i> Manage Images
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $isEditing ? 'Edit Album' : 'Add Album' }}</h5>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                wire:model="title" placeholder="Enter album title">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                wire:model="description" rows="3" placeholder="Enter album description"></textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-select @error('album_category_id') is-invalid @enderror"
                                                wire:model="album_category_id">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('album_category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Cover Image</label>
                                            <input type="file" class="form-control @error('temp_cover_image') is-invalid @enderror"
                                                wire:model="temp_cover_image" accept="image/*">
                                            @error('temp_cover_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div wire:loading wire:target="temp_cover_image" class="mt-2">
                                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <span class="text-muted">Uploading...</span>
                                            </div>

                                            @if($temp_cover_image)
                                                <div class="mt-2">
                                                    <img src="{{ $temp_cover_image->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px">
                                                </div>
                                            @elseif($cover_image && $isEditing)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $cover_image) }}" class="img-thumbnail" style="max-height: 150px">
                                                    <p class="text-muted small">Current cover image</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary me-2">
                                                {{ $isEditing ? 'Update Album' : 'Add Album' }}
                                            </button>
                                            @if($isEditing)
                                                <button type="button" class="btn btn-outline-secondary" wire:click="cancel">
                                                    Cancel
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($albums as $album)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($album->cover_image)
                                                            <img src="{{ asset('storage/' . $album->cover_image) }}"
                                                                class="rounded me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center"
                                                                style="width: 50px; height: 50px;">
                                                                <i class="fa fa-folder fa-lg text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0">{{ $album->title }}</h6>
                                                            <small class="text-muted">{{ $album->slug }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($album->category)
                                                        {{ $album->category->name }}
                                                    @else
                                                        Uncategorized
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $album->images ? $album->images->count() : 0 }} images
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info me-1" wire:click="edit({{ $album->id }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="delete({{ $album->id }})"
                                                        wire:confirm="Are you sure you want to delete this album?">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No albums found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $albums->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Add this at the end of your file to handle potential JS errors -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add error handling for any JavaScript that accesses properties
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.message);
        });
    });
</script>
@endpush


