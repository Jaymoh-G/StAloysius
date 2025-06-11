<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-1">
                            <h4 class="card-title">Gallery Images</h4>
                        </div>

                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Search images..."
                                wire:model.live="searchTerm">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" wire:model.live="albumFilter">
                                <option value="">All Albums</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('dashboard.gallery.albums') }}" class="btn btn-info">
                                <i class="fa fa-folder"></i> Manage Albums
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $isEditing ? 'Edit Image' : 'Add Images' }}</h5>
                                    <ul class="nav nav-tabs card-header-tabs mt-2">
                                        <li class="nav-item">
                                            <a class="nav-link {{ $activeTab === 'upload' ? 'active' : '' }}"
                                                href="#" wire:click.prevent="setActiveTab('upload')">
                                                <i class="fa fa-upload"></i> Upload New
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $activeTab === 'existing' ? 'active' : '' }}"
                                                href="#" wire:click.prevent="setActiveTab('existing')">
                                                <i class="fa fa-images"></i> Use Existing
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif

                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    @if ($alertMessage)
                                        <div
                                            class="alert alert-{{ $alertType === 'error' ? 'danger' : $alertType }} alert-dismissible fade show">
                                            {{ $alertMessage }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close" wire:click="$set('alertMessage', '')"></button>
                                        </div>
                                    @endif

                                    <div id="alertContainer"></div>

                                    <form
                                        wire:submit.prevent="{{ $isEditing ? 'updateImage' : ($activeTab === 'upload' ? 'uploadImages' : 'addExistingImagesToAlbum') }}"
                                        id="imageForm">
                                        <div class="mb-3">
                                            <label class="form-label">Album</label>
                                            <select class="form-select @error('album_id') is-invalid @enderror"
                                                wire:model="album_id">
                                                <option value="">Select Album</option>
                                                @foreach ($albums as $album)
                                                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('album_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Caption</label>
                                            <input type="text"
                                                class="form-control @error('caption') is-invalid @enderror"
                                                wire:model="caption" placeholder="Enter image caption">
                                            @error('caption')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @if ($activeTab === 'upload' && !$isEditing)
                                            <div class="mb-3">
                                                <label class="form-label">Images</label>
                                                <input type="file"
                                                    class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                                    wire:model="images" multiple accept="image/*">

                                                @error('images')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                @error('images.*')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <div wire:loading wire:target="images" class="mt-2">
                                                    <div class="spinner-border spinner-border-sm text-primary"
                                                        role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <span class="text-muted">Uploading...</span>
                                                </div>

                                                @if ($images && is_array($images) && count($images) > 0)
                                                    <div class="d-flex mt-2 flex-wrap gap-2">
                                                        @foreach ($images as $index => $image)
                                                            @if ($image && method_exists($image, 'temporaryUrl'))
                                                                <div class="position-relative">
                                                                    <img src="{{ $image->temporaryUrl() }}"
                                                                        class="img-thumbnail"
                                                                        style="height: 80px; width: auto;">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger position-absolute end-0 top-0"
                                                                        wire:click="removeImage({{ $index }})"
                                                                        style="font-size: 0.6rem; padding: 0.1rem 0.3rem;">
                                                                        &times;
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        @if ($activeTab === 'existing')
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Existing Images</label>
                                                    <div>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary me-2"
                                                            wire:click="toggleShowOnlyUnused">
                                                            <i class="fa fa-filter"></i>
                                                            {{ $showOnlyUnused ? 'Show All' : 'Show Unused' }}
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm {{ $showExistingImageActions ? 'btn-danger' : 'btn-outline-danger' }}"
                                                            wire:click="toggleExistingImageActions">
                                                            <i class="fa fa-trash"></i>
                                                            {{ $showExistingImageActions ? 'Cancel Delete' : 'Delete Mode' }}
                                                        </button>
                                                    </div>
                                                </div>

                                                @if ($showExistingImageActions)
                                                    <div class="alert alert-warning">
                                                        <i class="fa fa-exclamation-triangle"></i> Delete mode active.
                                                        Select images to permanently delete from storage.
                                                        <div class="mt-2">
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                wire:click="deleteStorageImages"
                                                                wire:confirm="Are you sure you want to delete these images? This cannot be undone!"
                                                                {{ count($selectedStorageImages) === 0 ? 'disabled' : '' }}>
                                                                Delete Selected ({{ count($selectedStorageImages) }})
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                wire:click="toggleExistingImageActions">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                                @error('selectedExistingImages')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <div class="existing-images-container mt-2"
                                                    style="max-height: 500px; overflow-y: auto;">
                                                    <div class="row g-2">
                                                        @forelse($existingImages as $image)
                                                            <div class="col-6">
                                                                <div class="position-relative"
                                                                    wire:click="{{ $showExistingImageActions ? 'toggleStorageImage' : 'toggleExistingImage' }}('{{ $image['path'] }}')"
                                                                    style="cursor: pointer;">
                                                                    <img src="{{ asset('storage/' . $image['path']) }}"
                                                                        class="img-thumbnail {{ $showExistingImageActions ? (in_array($image['path'], $selectedStorageImages) ? 'border-danger' : '') : (in_array($image['path'], $selectedExistingImages) ? 'border-primary' : '') }}"
                                                                        style="height: 120px; width: 100%; object-fit: cover;">
                                                                    @if ($showExistingImageActions && in_array($image['path'], $selectedStorageImages))
                                                                        <div class="position-absolute end-0 top-0 p-1">
                                                                            <span class="badge bg-danger">
                                                                                <i class="fa fa-trash"></i>
                                                                            </span>
                                                                        </div>
                                                                    @elseif(!$showExistingImageActions && in_array($image['path'], $selectedExistingImages))
                                                                        <div class="position-absolute end-0 top-0 p-1">
                                                                            <span class="badge bg-primary">
                                                                                <i class="fa fa-check"></i>
                                                                            </span>
                                                                        </div>
                                                                    @endif

                                                                    @if (!$image['isUsed'])
                                                                        <div
                                                                            class="position-absolute start-0 top-0 p-1">
                                                                            <span class="badge bg-warning">
                                                                                <i
                                                                                    class="fa fa-exclamation-triangle"></i>
                                                                                Unused
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="col-12">
                                                                <div class="alert alert-info">
                                                                    No {{ $showOnlyUnused ? 'unused ' : '' }}existing
                                                                    images found.
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="d-flex">
                                            @if (!$showExistingImageActions)
                                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                                    @if ($isEditing)
                                                        Update Image
                                                    @elseif($activeTab === 'upload')
                                                        Upload
                                                        Images{{ $album_id ? ' to ' . $albums->firstWhere('id', $album_id)->title : '' }}
                                                    @else
                                                        Add
                                                        Images{{ $album_id ? ' to ' . $albums->firstWhere('id', $album_id)->title : '' }}
                                                    @endif
                                                </button>
                                                @if ($isEditing)
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        wire:click="cancel">
                                                        Cancel
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row row-cols-1 row-cols-md-3 g-2">
                                @forelse($galleryImages as $image)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top"
                                                style="height: 180px; object-fit: cover;">
                                            <div class="card-body px-3 py-2">
                                                <h6 class="card-title mb-1">{{ $image->caption ?? 'No Caption' }}</h6>
                                                <p class="card-text small text-muted mb-0">
                                                    Album: {{ $image->album->title ?? 'None' }}
                                                </p>
                                            </div>
                                            <div class="card-footer d-flex justify-content-end px-2 py-1">
                                                <button class="btn btn-xs btn-info me-1"
                                                    wire:click="editImage({{ $image->id }})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-xs btn-danger"
                                                    wire:click="deleteImage({{ $image->id }})"
                                                    wire:confirm="Are you sure you want to delete this image?">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            No images found. Use the form to add images to your gallery.
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-3">
                                {{ $galleryImages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for Livewire alert events
            window.addEventListener('alert', event => {
                console.log('Alert event received:', event.detail);
                const data = event.detail || {};

                // Create alert element
                const alertContainer = document.getElementById('alertContainer');
                if (alertContainer && data.message) {
                    // Create the alert element
                    const alertDiv = document.createElement('div');
                    alertDiv.className = `alert alert-${data.type || 'info'} alert-dismissible fade show`;
                    alertDiv.role = 'alert';

                    // Add the message
                    alertDiv.innerHTML = data.message;

                    // Add close button
                    const closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.className = 'btn-close';
                    closeButton.setAttribute('data-bs-dismiss', 'alert');
                    closeButton.setAttribute('aria-label', 'Close');
                    alertDiv.appendChild(closeButton);

                    // Add to container
                    alertContainer.innerHTML = ''; // Clear previous alerts
                    alertContainer.appendChild(alertDiv);

                    // Auto-dismiss after 5 seconds
                    setTimeout(() => {
                        alertDiv.classList.remove('show');
                        setTimeout(() => alertDiv.remove(), 150);
                    }, 5000);
                } else {
                    console.error('Alert container not found or no message provided:', data);
                }
            });

            // Add a specific handler for the form submission
            const imageForm = document.getElementById('imageForm');
            const submitBtn = document.getElementById('submitBtn');

            if (imageForm && submitBtn) {
                // Add a click handler to the submit button
                submitBtn.addEventListener('click', function(e) {
                    // Get the active tab
                    const isUploadTab = imageForm.getAttribute('wire:submit.prevent').includes(
                        'uploadImages');
                    const isExistingTab = imageForm.getAttribute('wire:submit.prevent').includes(
                        'addExistingImagesToAlbum');

                    // Only check for files if we're in upload mode and not in editing mode
                    if (isUploadTab) {
                        // Check if there are any files selected
                        const fileInput = imageForm.querySelector('input[type="file"]');
                        if (fileInput && (!fileInput.files || fileInput.files.length === 0)) {
                            e.preventDefault();

                            // Display alert using the same mechanism
                            window.dispatchEvent(new CustomEvent('alert', {
                                detail: {
                                    type: 'warning',
                                    message: 'Please select at least one image to upload.'
                                }
                            }));

                            return false;
                        }
                    }
                });
            }
        });
    </script>
@endpush
