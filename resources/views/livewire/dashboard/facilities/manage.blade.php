<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $facilityId ? 'Edit Facility' : 'Create Facility' }}</h4>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <input type="text" wire:model="name" placeholder="Facility Name" class="form-control"
                        id="name" />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select wire:model.defer="department_id" class="form-control" id="department_id">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:ignore class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea wire:key="editor-{{ now() }}" id="content" placeholder="Enter content"
                        class="form-control @error('content') is-invalid @enderror">
                        {!! $content !!}
                    </textarea>
                    @error('content')
                        <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror

                    <!-- Hidden input to trigger HTML5 validation -->
                    <input type="hidden" id="content-validator" required
                        value="{{ !empty(strip_tags($content)) ? 'valid' : '' }}"
                        oninvalid="this.setCustomValidity('Content is required')" oninput="this.setCustomValidity('')">
                </div>

                {{-- Upload images --}}
                <div class="mb-4">
                    <div class="flex items-center gap-4">
                        <label for="images">Facility Images</label>
                        <input type="file" wire:model="images" multiple class="block" id="images" />
                        @error('images.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Featured Image Selection Section -->
                    <div class="mt-3">
                        <label class="form-label fw-bold">Featured Image <span class="text-danger">*</span></label>

                        <!-- Error message for featured image -->
                        @error('featuredImageIndex')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if (empty($images) && empty($existingImages))
                            <div class="alert alert-warning">
                                Please upload at least one image and select it as featured.
                            </div>
                        @endif

                        <!-- Preview Area for new images -->
                        <div class="d-flex mt-3 flex-wrap gap-3">
                            @foreach ($images as $index => $image)
                                @if (is_object($image))
                                    <div class="position-relative">
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="rounded border"
                                            style="
                            height: 100px;
                            width: auto;
                            object-fit: cover;
                        " />
                                        <div class="form-check mt-1">
                                            <input type="radio" wire:model="featuredImageIndex"
                                                value="{{ $index }}"
                                                class="form-check-input @error('featuredImageIndex') is-invalid @enderror"
                                                id="featured_{{ $index }}" name="featured" required />
                                            <label class="form-check-label" for="featured_{{ $index }}">
                                                Featured
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- Existing Images Section -->
                        @if ($existingImages && count($existingImages))
                            <label class="mt-3">Existing Images</label>
                            <div class="d-flex mt-2 flex-wrap gap-3">
                                @foreach ($existingImages as $index => $image)
                                    <div class="position-relative text-center" style="width: 120px">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Existing Facility Image"
                                            class="rounded border"
                                            style="height: 100px; width: 100%; object-fit: cover;" />
                                        <button type="button" wire:click.prevent="deleteImage({{ $image->id }})"
                                            class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1">
                                            &times;
                                        </button>
                                        <div class="mt-2">
                                            <input type="radio" wire:model="featuredImageIndex"
                                                value="{{ 'existing_' . $index }}"
                                                class="form-check-input @error('featuredImageIndex') is-invalid @enderror"
                                                id="existing_featured_{{ $index }}" name="featured" required />
                                            <label class="form-check-label d-block small"
                                                for="existing_featured_{{ $index }}">
                                                Featured Image
                                            </label>

                                        </div>
                                        @if ($featuredImageIndex == 'existing_' . $index || (isset($image['is_featured']) && $image['is_featured']))
                                            <span class="badge bg-success mt-1">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Show banner preview --}}
                <div class="mb-4">
                    @if ($banner)
                        <div class="my-2">
                            <img src="{{ $banner->temporaryUrl() }}" alt="Banner Preview"
                                class="img-fluid rounded border"
                                style=" height: 100px;
                            width: 50%;
                            object-fit: cover;
                        " />
                            <button wire:click="$set('banner', null)" type="button"
                                class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1" title="remove banner">
                                &times;
                            </button>
                        </div>
                    @elseif ($existingBanner)
                        <div class="position-relative w-50 my-2">
                            <img src="{{ Storage::url($existingBanner) }}" class="h-48 rounded shadow"
                                alt="Current Banner" class="img-fluid rounded border"
                                style="
                                height: 150px;
                                width: 100%;
                                object-fit: cover;
                            " />
                            <button wire:click="deleteBanner" type="button"
                                class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1" title="Delete Banner">
                                &times;
                            </button>
                        </div>
                    @endif
                    <div class="flex items-center gap-4">
                        <label class="block text-sm font-medium text-gray-700">Banner Image</label>
                        <input type="file" wire:model="banner" accept="image/*" class="block" />
                    </div>
                    @error('banner')
                        <span class="alert-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ $facilityId ? 'Update Facility' : 'Create Facility' }}
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('adminassets/vendor/ckeditor/ckeditor.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let editorInstance;
                let debounceTimer;
                let isInitialLoad = true;

                ClassicEditor
                    .create(document.querySelector('#content'), {
                        ckfinder: {
                            uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                        }
                    })
                    .then(editor => {
                        editorInstance = editor;
                        console.log('CKEditor initialized');

                        // Set initial data
                        editor.setData('{!! addslashes($content) !!}');
                        isInitialLoad = false;

                        // Update hidden validator field when content changes
                        const updateValidator = (data) => {
                            const contentValidator = document.getElementById('content-validator');
                            if (contentValidator) {
                                const hasContent = data && data.trim() && strip_tags(data).trim().length > 0;
                                contentValidator.value = hasContent ? 'valid' : '';

                                // Update validation state
                                if (hasContent) {
                                    contentValidator.setCustomValidity('');
                                } else {
                                    contentValidator.setCustomValidity('Content is required');
                                }
                            }
                        };

                        function strip_tags(html) {
                            const doc = new DOMParser().parseFromString(html, 'text/html');
                            return doc.body.textContent || '';
                        }

                        editor.model.document.on("change:data", () => {
                            if (isInitialLoad) return;

                            const data = editor.getData();
                            updateValidator(data);

                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(() => {
                                // Update Livewire property
                                @this.call('updateContent', data);
                            }, 500);
                        });

                        // Listen for Livewire events
                        Livewire.on('resetEditor', () => {
                            editor.setData('');
                            updateValidator('');
                        });

                        // Form validation on submit
                        const form = document.querySelector('form[wire\:submit\.prevent="submit"]');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const content = editor.getData();
                                updateValidator(content);

                                if (!content || !strip_tags(content).trim()) {
                                    let errorMsg = document.querySelector('#content-error-msg');
                                    if (!errorMsg) {
                                        errorMsg = document.createElement('div');
                                        errorMsg.id = 'content-error-msg';
                                        errorMsg.className = 'text-danger mt-2';
                                        errorMsg.textContent = 'The content field is required.';
                                        const editorElement = document.querySelector('#content');
                                        if (editorElement) {
                                            editorElement.parentNode.appendChild(errorMsg);
                                        }
                                    }
                                    errorMsg.style.display = 'block';
                                    e.preventDefault();
                                    e.stopPropagation();
                                    return false;
                                }
                            });
                        }
                    })
                    .catch(error => {
                        // Optionally handle CKEditor initialization error
                    });
            });
        </script>
    @endpush

</div>
