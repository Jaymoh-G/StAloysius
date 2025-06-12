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
                    <textarea
                        wire:key="editor-{{ now() }}"
                        id="content"
                        placeholder="Enter content"
                        class="form-control @error('content') is-invalid @enderror"
                    >
                        {!! $content !!}
                    </textarea>
                    @error('content')
                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror

                    <!-- Hidden input to trigger HTML5 validation -->
                    <input
                        type="hidden"
                        id="content-validator"
                        required
                        value="{{ !empty(strip_tags($content)) ? 'valid' : '' }}"
                        oninvalid="this.setCustomValidity('Content is required')"
                        oninput="this.setCustomValidity('')"
                    >
                </div>

                <div class="mb-3">
                    <label for="banner" class="form-label">Banner Image</label>
                    @if ($existingBanner)
                      <div class="position-relative my-2 w-50">
                        <img
                            src="{{ Storage::url($existingBanner) }}"
                            class="h-48 rounded shadow"
                            alt="Current Banner"
                            class="img-fluid rounded border"
                            style="
                                height: 150px;
                                width: 100%;
                                object-fit: cover;
                            "
                        />
                        <button
                            wire:click="deleteBanner"
                            type="button"
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                            title="Delete Banner"
                        >
                            &times;
                        </button>
                    </div>
                    @endif
                      <div class="flex items-center gap-4">
                        <label
                            class="block text-sm font-medium text-gray-700"
                            >Banner Image</label
                        >
                        <input
                            type="file"
                            wire:model="banner"
                            accept="image/*"
                            class="block"
                        />
                    </div>
                    @error('banner')
                    <span class="alert-danger">{{
                        $message
                    }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Facility Images</label>
                    @if ($existingImages->count() > 0)
                        <div class="row mb-3">
                            @foreach ($existingImages as $index => $image)
                                <div class="col-md-3 mb-2">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Facility Image"
                                            class="img-thumbnail"
                                            style="height: 150px; width: 100%; object-fit: cover;">
                                        <div class="form-check position-absolute end-0 top-0 m-2">
                                            <input class="form-check-input" type="radio"
                                                wire:model="featuredImageIndex" value="existing_{{ $index }}"
                                                id="featured_{{ $index }}">
                                            <label class="form-check-label"
                                                for="featured_{{ $index }}">Featured</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" wire:model="images" class="form-control" multiple />
                    @error('images.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $facilityId ? 'Update Facility' : 'Create Facility' }}</button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('adminassets/vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let editorInstance;
        let debounceTimer;
        let isInitialLoad = true;

        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload')."?_token=".csrf_token() }}'
                }
            })
            .then(editor => {
                editorInstance = editor;

                // Set initial data
                editor.setData('{!! addslashes($content) !!}');
                isInitialLoad = false;

                // Update hidden validator field when content changes
                const updateValidator = (data) => {
                    const contentValidator = document.getElementById('content-validator');
                    if (contentValidator) {
                        // Check if content has actual text (not just HTML tags)
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

                // Strip HTML tags helper function
                function strip_tags(html) {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    return doc.body.textContent || '';
                }

                // Use debounce to prevent too many updates
                editor.model.document.on("change:data", () => {
                    if (isInitialLoad) return;

                    const data = editor.getData();
                    updateValidator(data);

                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        // Store current category value in a variable
                        const currentCategoryId = document.getElementById('dep_category_id').value;

                        // Update content
                        @this.call('updateContent', data);

                        // Restore category value after content update
                        setTimeout(() => {
                            const categorySelect = document.getElementById('dep_category_id');
                            if (categorySelect && categorySelect.value !== currentCategoryId) {
                                categorySelect.value = currentCategoryId;
                                // Trigger change event to update Livewire
                                categorySelect.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        }, 50);
                    }, 500); // Wait 500ms after typing stops
                });

                // Listen for Livewire events
                Livewire.on('resetEditor', () => {
                    editor.setData('');
                    updateValidator('');
                });

                // Add form submit handler to validate content
                const form = document.querySelector('form[wire\\:submit\\.prevent="submit"]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const content = editor.getData();
                        updateValidator(content);

                        // If content is empty, show error
                        if (!content || !strip_tags(content).trim()) {
                            // Create or show error message
                            let errorMsg = document.querySelector('#content-error-msg');
                            if (!errorMsg) {
                                errorMsg = document.createElement('div');
                                errorMsg.id = 'content-error-msg';
                                errorMsg.className = 'text-danger mt-2';
                                errorMsg.textContent = 'The content field is required.';

                                // Insert after the editor
                                const editorElement = document.querySelector('#content');
                                if (editorElement) {
                                    editorElement.parentNode.appendChild(errorMsg);
                                }
                            }
                            errorMsg.style.display = 'block';

                            // Prevent form submission
                            e.preventDefault();
                            e.stopPropagation();
                            return false;
                        }
                    });
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
    @endpush
</div>
