<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $depId ? 'Edit Department' : 'Create Department' }}</h4>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">{{ session("message") }}</div>
            @endif

            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <input
                        type="text"
                        wire:model="name"
                        placeholder="name"
                        class="form-control"
                        id="name"
                    />
                    @error('name')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="dep_category_id" class="form-label">Department Category</label>
                    <div class="d-flex gap-2">
                        <select
                            wire:model.defer="dep_category_id"
                            class="form-control"
                            id="dep_category_id"
                        >
                            <option value="">Select Category</option>

                            <!-- Main Categories -->
                            <optgroup label="Main Categories">
                                @foreach($depCategories->where('is_main', true) as $depcat)
                                    <option value="{{ $depcat->id }}" @if($dep_category_id == $depcat->id) selected @endif>
                                        {{ $depcat->name }}
                                    </option>
                                @endforeach
                            </optgroup>

                            <!-- Sub Categories -->
                            <optgroup label="Sub Categories">
                                @foreach($depCategories->where('is_main', false)->whereNotNull('parent_id') as $depcat)
                                    <option value="{{ $depcat->id }}" @if($dep_category_id == $depcat->id) selected @endif>
                                        {{ $depcat->formatted_name }}
                                    </option>
                                @endforeach
                            </optgroup>

                            <!-- Standalone Categories (for backward compatibility) -->
                            @if($depCategories->where('is_main', false)->whereNull('parent_id')->count() > 0)
                                <optgroup label="Standard Categories">
                                    @foreach($depCategories->where('is_main', false)->whereNull('parent_id') as $depcat)
                                        <option value="{{ $depcat->id }}" @if($dep_category_id == $depcat->id) selected @endif>
                                            {{ $depcat->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                        <button
                            type="button"
                            class="btn btn-primary btn-xs text-nowrap"
                            data-bs-toggle="modal"
                            data-bs-target="#ManageDepCategoryModal"
                        >
                            + Add Department Category
                        </button>
                    </div>
                    @error('dep_category_id')
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

                <div class="mb-4">
                    <div class="flex items-center gap-4">
                        <label for="images"> Department Images</label>
                        <input
                            type="file"
                            wire:model="images"
                            multiple
                            class="block"
                            id="images"
                        />

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

                        @if(empty($images) && empty($existingImages))
                        <div class="alert alert-warning">
                            Please upload at least one image and select it as featured.
                        </div>
                        @endif

                        <!-- Preview Area for new images -->
                        <div class="mt-3 d-flex flex-wrap gap-3">
                            @foreach ($images as $index => $image)
                            @if(is_object($image))
                            <div class="position-relative">
                                <img
                                    src="{{ $image->temporaryUrl() }}"
                                    alt="Preview"
                                    class="rounded border"
                                    style="
                                        height: 100px;
                                        width: auto;
                                        object-fit: cover;
                                    "
                                />
                                <div class="form-check mt-1">
                                    <input
                                        type="radio"
                                        wire:model="featuredImageIndex"
                                        value="{{ $index }}"
                                        class="form-check-input @error('featuredImageIndex') is-invalid @enderror"
                                        id="featured_{{ $index }}"
                                        name="featured"
                                        required
                                    />
                                    <label
                                        class="form-check-label"
                                        for="featured_{{ $index }}"
                                    >
                                        Featured
                                    </label>
                                </div>
                            </div>
                            @endif @endforeach
                        </div>

                        <!-- Existing Images Section -->
                        @if ($existingImages && count($existingImages))
                        <label class="mt-3">Existing Images</label>
                        <div class="mt-2 d-flex flex-wrap gap-3">
                            @foreach ($existingImages as $eIndex => $image)
                            <div
                                class="text-center position-relative"
                                style="width: 120px"
                            >
                                <img
                                    src="{{ asset('storage/' . $image->path) }}"
                                    alt="Existing Image"
                                    class="rounded border"
                                    style="
                                        height: 100px;
                                        width: 100%;
                                        object-fit: cover;
                                    "
                                />
                                <button
                                    type="button"
                                    wire:click.prevent="deleteImage({{ $image->id }})"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                >
                                    &times;
                                </button>
                                <div class="mt-2">
                                    <input
                                        type="radio"
                                        wire:model="featuredImageIndex"
                                        value="{{ 'existing_'.$eIndex }}"
                                        class="form-check-input @error('featuredImageIndex') is-invalid @enderror"
                                        id="existing_featured_{{ $eIndex }}"
                                        name="featured"
                                        required
                                    />
                                    <label
                                        class="form-check-label d-block small"
                                        for="existing_featured_{{ $eIndex }}"
                                    >
                                        Featured Image
                                    </label>
                                </div>
                                @if ($featuredImageIndex == 'existing_' .
                                $eIndex || (isset($image['is_featured']) &&
                                $image['is_featured']))
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

                <div class="mb-4">
                    @if ($banner)
                    <div class="my-2">
                        <img
                            src="{{ $banner->temporaryUrl() }}"
                            alt="Banner Preview"
                            class="img-fluid rounded border"
                            style="
                                height: 100px;
                                width: 50%;
                                object-fit: cover;
                            "
                        />
                        <button
                            wire:click="$set('banner', null)"
                            type="button"
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                            title="remove banner"
                        >
                            &times;
                        </button>
                    </div>
                    @elseif ($existingBanner)
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

                <button type="submit" class="btn btn-primary">
                    {{ $depId ? 'Update Department' : 'Create Department' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Category Modal -->
    <div
        class="modal fade"
        id="ManageDepCategoryModal"
        tabindex="-1"
        aria-labelledby="ManageDepCategoryModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                @livewire('dashboard.departments.dep-categories.manage-dep-category-modal')
            </div>
        </div>
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

@endpush @push('scripts')
<script>
    document.addEventListener("livewire:initialized", () => {
        Livewire.on("categorySaved", (categoryId) => {
            // Refresh the departments list with the new category
            @this.refreshDepartments(categoryId);
        });

        Livewire.on("closeModal", () => {
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("ManageDepCategoryModal")
            );
            if (modal) modal.hide();
        });
    });
</script>
@endpush











