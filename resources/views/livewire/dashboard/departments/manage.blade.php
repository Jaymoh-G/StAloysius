<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Department</h4>
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
                    <label for="dep_category_id" class="form-label"
                        >Department Category</label
                    >
                    <div class="d-flex gap-2">
                        <select
                            wire:model.defer="dep_category_id"
                            class="form-control"
                            id="dep_category_id"
                        >
                            <option value="">Select Category</option>
                            @foreach($depCategories as $depcat)
                            <option value="{{ $depcat->id }}">
                                {{ $depcat->name }}
                            </option>
                            @endforeach
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
                    <textarea
                        wire:key="editor-{{ now() }}"
                        id="content"
                        placeholder="Enter content"
                        class="form-control"
                    >
                {!! $content !!}
            </textarea
                    >
                    @error('content')
                    <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center gap-4">
                        <label for="images">Upload Images</label>
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

                        {{-- Preview Area --}}
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
                                        class="form-check-input"
                                        id="featured_{{ $index }}"
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
                                        class="form-check-input"
                                        id="existing_featured_{{ $eIndex }}"
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
                            <span class="text-red-500 text-sm">{{
                                $message
                            }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Department
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
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload')."?_token=".csrf_token() }}'
                }
            })
            .then(editor => {
                editor.model.document.on("change:data", () => {
                 @this.call('updateContent', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

@endpush @push('scripts')
<script>
    window.addEventListener("closeModal", () => {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("ManageDepCategoryModal")
        );
        if (modal) modal.hide();
    });
</script>
@endpush
