<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Event</h4>
        </div>
        <div class="card-body">
            <form
                wire:submit.prevent="submit"
                enctype="multipart/form-data"
                class="needs-validation"
                novalidate
            >
                @csrf

                {{-- Event Title --}} {{-- Event Category --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Event Title</label>
                        <input
                            type="text"
                            id="name"
                            wire:model.lazy="name"
                            class="form-control @error('name') is-invalid @enderror"
                            required
                        />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="event_category_id" class="form-label"
                            >Event Category</label
                        >
                        <select
                            wire:model.defer="event_category_id"
                            class="form-select"
                            id="event_category_id"
                        >
                            <option value="">Select Category</option>
                            @foreach($eventCategories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('event_category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Start Date, End Date, Time, Location --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label"
                            >Start Date</label
                        >
                        <input
                            type="date"
                            id="start_date"
                            wire:model="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            required
                        />
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label"
                            >End Date</label
                        >
                        <input
                            type="date"
                            id="end_date"
                            wire:model="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            required
                        />
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="start_time" class="form-label"
                            >Start Time</label
                        >
                        <input
                            type="time"
                            id="start_time"
                            wire:model="start_time"
                            class="form-control @error('start_time') is-invalid @enderror"
                            required
                        />
                        @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                          <div class="col-md-3">
                        <label for="end_time" class="form-label"
                            >End Time</label
                        >
                        <input
                            type="time"
                            id="end_time"
                            wire:model="end_time"
                            class="form-control @error('end_time') is-invalid @enderror"
                            required
                        />
                        @error('end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Organizer Info --}}
                <div class="row g-3 mb-3 align-items-start">
                    <div class="col-md-6">
                        <label for="location" class="form-label"
                            >Location</label
                        >
                        <input
                            type="text"
                            id="location"
                            wire:model.lazy="location"
                            class="form-control @error('location') is-invalid @enderror"
                            required
                        />
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="organizer_name" class="form-label"
                            >Organizer</label
                        >
                        <input
                            type="text"
                            id="organizer_name"
                            wire:model.lazy="organizer_name"
                            class="form-control @error('organizer_name') is-invalid @enderror"
                            required
                        />
                        @error('organizer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="organizer_description" class="form-label"
                            >Organizer Description</label
                        >
                        <textarea
                            id="organizer_description"
                            wire:model.lazy="organizer_description"
                            rows="3"
                            class="form-control @error('organizer_description') is-invalid @enderror"
                            required
                        ></textarea>
                        @error('organizer_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="organizer_photo" class="form-label"
                            >Organizer Photo</label
                        >
                        <input
                            type="file"
                            id="organizer_photo"
                            wire:model="organizer_photo"
                            class="form-control border-brown @error('organizer_photo') is-invalid @enderror"
                            accept="image/*"
                        />

                        @error('organizer_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror @if ($organizer_photo)
                        <div class="mt-2">
                            <label class="form-label">Preview:</label>
                            <img
                                src="{{ $organizer_photo->temporaryUrl() }}"
                                alt="Organizer Preview"
                                class="img-thumbnail"
                                style="
                                    width: 150px;
                                    height: 90px;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        @elseif ($existingOrganizerPhoto)
                        <div class="mt-2 d-flex align-items-center">
                            <img
                                src="{{
                                    asset('storage/'.$existingOrganizerPhoto)
                                }}"
                                alt="Existing Organizer"
                                class="img-thumbnail me-3"
                                style="
                                    width: 150px;
                                    height: 90px;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Content --}}
                <div wire:ignore class="mb-3">
                    <textarea
                        wire:key="editor-{{ now() }}"
                        id="content"
                        class="form-control"
                        placeholder="Enter content"
                    >
{!! $content !!}</textarea
                    >
                    @error('content')
                    <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Banner Image --}}
                <div class="mb-4">
                    <label class="form-label">Banner Image</label>
                    <input
                        type="file"
                        id="banner"
                        wire:model="banner"
                        class="form-control border-brown @error('banner') is-invalid @enderror"
                        accept="image/*"
                    />

                    @error('banner')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror @if ($banner)
                    <div class="mt-2">
                        <label class="form-label">Preview:</label>
                        <img
                            src="{{ $banner->temporaryUrl() }}"
                            alt="Banner Preview"
                            class="img-thumbnail"
                            style="
                                width: 150px;
                                height: 100%;
                                object-fit: cover;
                            "
                        />
                    </div>
                    @elseif ($existingBanner)
                    <div class="mt-2 d-flex align-items-center">
                        <img
                            src="{{ asset('storage/'.$existingBanner) }}"
                            alt="Existing Banner"
                            class="img-thumbnail me-3"
                            style="
                                width: 150px;
                                height: 100%;
                                object-fit: cover;
                            "
                        />
                        <button
                            wire:click.prevent="deleteBanner"
                            class="btn btn-outline-danger btn-sm"
                        >
                            Remove
                        </button>
                    </div>
                    @endif
                </div>

                {{-- Gallery Images --}}
                <div class="mb-4">
                    <label class="form-label">Gallery Images</label>
                    <input
                        type="file"
                        wire:model="images"
                        multiple
                        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                        accept="image/*"
                    />
                    @error('images')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror @error('images.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <div class="row row-cols-1 row-cols-md-4 g-3 mt-3">
                        @foreach ($images as $index => $image)

                        <div class="col">
                            <div class="card h-100">
                                <img
                                    src="{{ $image->temporaryUrl() }}"
                                    class="card-img-top"
                                    style="
                                        height: 150px;
                                        width: 100%;
                                        object-fit: cover;
                                    "
                                />
                                <div class="card-body p-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            wire:model="featuredImageIndex"
                                            value="{{ $index }}"
                                            id="featuredNew{{ $index }}"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="featuredNew{{ $index }}"
                                            >Featured</label
                                        >
                                    </div>
                                    @error('featured')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror @error('featuredImageIndex')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @endforeach @foreach ($existingImages as $index => $img)
                        <div class="col">
                            <div class="card h-100">
                                <img
                                    src="{{ asset('storage/' . $img->path) }}"
                                    class="card-img-top"
                                    style="
                                        height: 150px;
                                        width: auto;
                                        object-fit: cover;
                                    "
                                />
                                <div
                                    class="card-body p-2 d-flex justify-content-between align-items-center"
                                >
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            wire:model="featuredImageIndex"
                                            value="existing_{{ $index }}"
                                            id="featuredExisting{{ $index }}"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="featuredExisting{{ $index }}"
                                            >Make this Featured Image</label
                                        >
                                    </div>
                                    <button
                                        wire:click.prevent="deleteImage({{ $img->id }})"
                                        class="btn btn-link btn-sm text-danger p-0 ms-2"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ $eventId ? "Update Event" : "Create Event" }}
                    </button>
                </div>
            </form>
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
@endpush
