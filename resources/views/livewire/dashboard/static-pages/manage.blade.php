<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                        {{ $pageId ? 'Edit' : 'Create' }} Static Page
                    </h4>
                    <div class="page-title-right">
                        <a href="{{ route('dashboard.static-pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Pages
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="save" id="pageForm">
                            <ul class="nav nav-tabs mb-3" id="pageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $activeTab == 'general' ? 'active' : '' }}"
                                        wire:click.prevent="$set('activeTab', 'general')" type="button">
                                        General
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $activeTab == 'sections' ? 'active' : '' }}"
                                        wire:click.prevent="$set('activeTab', 'sections')" type="button">
                                        Sections
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $activeTab == 'seo' ? 'active' : '' }}"
                                        wire:click.prevent="$set('activeTab', 'seo')" type="button">
                                        SEO
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- General Tab -->
                                <div
                                    class="tab-pane fade {{ $activeTab == 'general' ? 'show active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="page_name" class="form-label">Page Name
                                                    <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('page_name') is-invalid @enderror"
                                                    id="page_name" wire:model.blur="page_name" required />
                                                @error('page_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title
                                                    <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    id="title" wire:model.blur="title"
                                                    wire:keydown="generateSlug" />
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div wire:ignore class="mb-3">
                                                <label for="content" class="form-label">Content
                                                    <span class="text-danger">*</span></label>
                                                <textarea wire:key="editor-{{ now() }}" id="content" placeholder="Enter content"
                                                    class="form-control @error('content') is-invalid @enderror">
                                                    {!! $content !!}
                                                </textarea>
                                                @error('content')
                                                    <div class="text-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <div class="flex items-center gap-4">
                                                    <label for="images">Upload Images
                                                        <span class="text-danger">*</span></label>
                                                    <input type="file" wire:model="images" multiple
                                                        class="form-control @error('images.*') is-invalid @enderror block"
                                                        id="images" />

                                                    @error('images.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- Featured Image Selection Section -->

                                                <div class="mt-3">
                                                    <!-- Preview Area for new images -->
                                                    <div class="d-flex mt-3 flex-wrap gap-3">
                                                        <?php if(isset($images) && count($images)): ?>
                                                        <?php foreach($images as $index =>
                                                        $image): ?>
                                                        <?php if(is_object($image)): ?>
                                                        <div class="position-relative">
                                                            <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                                                class="rounded border"
                                                                style="
                                                                    height: 100px;
                                                                    width: auto;
                                                                    object-fit: cover;
                                                                " />
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- Existing Images Section -->
                                                    @if ($existingImages && count($existingImages))
                                                        <label class="mt-3">Existing Images</label>
                                                        <div class="d-flex mt-2 flex-wrap gap-3">
                                                            <?php foreach($existingImages as $eIndex =>
                                                        $image): ?>
                                                            <div class="position-relative text-center"
                                                                style="width: 120px">
                                                                <img src="{{ asset('storage/' . $image->path) }}"
                                                                    alt="Existing Image" class="rounded border"
                                                                    style="
                                                                    height: 100px;
                                                                    width: 100%;
                                                                    object-fit: cover;
                                                                " />
                                                                <button type="button"
                                                                    wire:click.prevent="deleteImage({{ $image->id }})"
                                                                    class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1">
                                                                    &times;
                                                                </button>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- end of problem -->
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Banner Image</label>
                                                @if ($banner_image)
                                                    <div class="position-relative my-2">
                                                        <img src="{{ $banner_image->temporaryUrl() }}"
                                                            alt="Banner Preview" class="img-fluid rounded border"
                                                            style="
                                                            height: 100px;
                                                            width: 100%;
                                                            object-fit: cover;
                                                        " />
                                                        <button wire:click="$set('banner_image', null)" type="button"
                                                            class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1"
                                                            title="remove banner">
                                                            &times;
                                                        </button>
                                                    </div>
                                                @elseif ($existingBanner)
                                                    <div class="position-relative my-2">
                                                        <img src="{{ Storage::url($existingBanner) }}"
                                                            alt="Current Banner" class="img-fluid rounded border"
                                                            style="
                                                            height: 150px;
                                                            width: 100%;
                                                            object-fit: cover;
                                                        " />
                                                        <button wire:click="deleteBanner" type="button"
                                                            class="btn btn-sm btn-danger position-absolute end-0 top-0 m-1"
                                                            title="Delete Banner">
                                                            &times;
                                                        </button>
                                                    </div>
                                                @endif
                                                <div class="mt-2">
                                                    <input type="file" wire:model="banner_image" accept="image/*"
                                                        class="form-control @error('banner_image') is-invalid @enderror" />
                                                    @error('banner_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sections Tab -->
                                <div
                                    class="tab-pane fade {{ $activeTab == 'sections' ? 'show active' : '' }}">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-sm btn-success"
                                            wire:click="addSection">
                                            <i class="fas fa-plus-circle"></i>
                                            Add Section
                                        </button>
                                    </div>

                                    @if (isset($sections) && count($sections))
                                        @foreach ($sections as $index => $section)
                                            <div class="card mb-3">
                                                <div
                                                    class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">
                                                        Section {{ $index + 1 }}
                                                    </h5>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        wire:click="removeSection({{ $index }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Section Title</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.blur="sections.{{ $index }}.title" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Section Content</label>
                                                        <textarea class="form-control" id="section_content_{{ $index }}"
                                                            wire:model.blur="sections.{{ $index }}.content" rows="4"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Section Images</label>
                                                        <input type="file" class="form-control"
                                                            wire:model="sections.{{ $index }}.images" multiple
                                                            accept="image/*" />

                                                        <!-- Preview of uploaded section images -->
                                                        @if (isset($sections[$index]['images']) && count($sections[$index]['images']) > 0)
                                                            <div class="mt-2">
                                                                <h6>New Images:</h6>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @foreach ($sections[$index]['images'] as $imgIndex => $image)
                                                                        <div class="position-relative">
                                                                            <img src="{{ $image->temporaryUrl() }}"
                                                                                class="img-thumbnail"
                                                                                style="
                                                                    height: 80px;
                                                                    width: auto;
                                                                " />
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger position-absolute end-0 top-0"
                                                                                wire:click="removeSectionImage({{ $index }}, {{ $imgIndex }})"
                                                                                style="
                                                                    font-size: 0.6rem;
                                                                    padding: 0.1rem
                                                                        0.3rem;
                                                                ">
                                                                                &times;
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Display existing section images -->
                                                        @if (isset($sections[$index]['existingImages']) && count($sections[$index]['existingImages']) > 0)
                                                            <div class="mt-3">
                                                                <h6>Existing Images:</h6>
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    @foreach ($sections[$index]['existingImages'] as $image)
                                                                        <div class="position-relative">
                                                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                                                class="img-thumbnail"
                                                                                style="
                                                                    height: 80px;
                                                                    width: auto;
                                                                " />
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger position-absolute end-0 top-0"
                                                                                wire:click="deleteImage({{ $image->id }})"
                                                                                style="
                                                                    font-size: 0.6rem;
                                                                    padding: 0.1rem
                                                                        0.3rem;
                                                                ">
                                                                                &times;
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- SEO Tab -->
                                <div class="tab-pane fade {{ $activeTab == 'seo' ? 'show active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">Meta Title</label>
                                                <input type="text"
                                                    class="form-control @error('meta_title') is-invalid @enderror"
                                                    id="meta_title" wire:model.blur="meta_title" />
                                                <small class="text-muted">Recommended: 50-60
                                                    characters</small>
                                                @error('meta_title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">Meta
                                                    Description</label>
                                                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                                    wire:model.blur="meta_description" rows="3"></textarea>
                                                <small class="text-muted">Recommended: 150-160
                                                    characters</small>
                                                @error('meta_description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Save Page
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('adminassets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let editor;
            let isInitialLoad = true;
            let debounceTimer;

            function strip_tags(html) {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                return doc.body.textContent || '';
            }

            ClassicEditor
                .create(document.querySelector('#content'), {
                    ckfinder: {
                        uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    }
                })
                .then(editorInstance => {
                    editor = editorInstance;

                    // Set initial content
                    editor.setData('{!! addslashes($content) !!}');
                    isInitialLoad = false;

                    // Update content in Livewire when it changes
                    editor.model.document.on("change:data", () => {
                        if (isInitialLoad) return;

                        const data = editor.getData();
                        const hasContent = data && strip_tags(data).trim().length > 0;

                        // Update hidden validator
                        const validator = document.getElementById('content-validator');
                        if (validator) {
                            validator.value = hasContent ? 'valid' : '';
                            validator.setCustomValidity(hasContent ? '' : 'Content is required');
                        }

                        // Show/hide error message
                        const errorMsg = document.querySelector('#content-error-msg');
                        if (errorMsg) {
                            errorMsg.style.display = hasContent ? 'none' : 'block';
                        }

                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('content', data);
                        }, 500);
                    });

                    // Override the submit button
                    const submitBtn = document.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.addEventListener('click', function(e) {
                            e.preventDefault();

                            const content = editor.getData();
                            const hasContent = content && strip_tags(content).trim().length > 0;

                            // Set content in Livewire component
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('content', content);

                            if (!hasContent) {
                                // Show error message
                                const errorMsg = document.querySelector('#content-error-msg');
                                if (errorMsg) {
                                    errorMsg.style.display = 'block';
                                }
                                // Scroll to error
                                document.querySelector('#content').scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                return;
                            }

                            // Hide error message if content is valid
                            const errorMsg = document.querySelector('#content-error-msg');
                            if (errorMsg) {
                                errorMsg.style.display = 'none';
                            }

                            // Submit form
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('save');
                        });
                    }
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
        });
    </script>
@endpush
