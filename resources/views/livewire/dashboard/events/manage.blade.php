<div>
 <form wire:submit.prevent="submit" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Event Title</label>
        <input type="text" id="name" wire:model.lazy="name" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" id="slug" wire:model.lazy="slug" class="form-control @error('slug') is-invalid @enderror" readonly>
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" id="start_date" wire:model="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" id="end_date" wire:model="end_date" class="form-control @error('end_date') is-invalid @enderror" required>
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="time" class="form-label">Event Time</label>
        <input type="time" id="time" wire:model="time" class="form-control @error('time') is-invalid @enderror" required>
        @error('time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" id="location" wire:model.lazy="location" class="form-control @error('location') is-invalid @enderror" required>
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="organizer" class="form-label">Organizer Name</label>
        <input type="text" id="organizer" wire:model.lazy="organizer" class="form-control @error('organizer') is-invalid @enderror" required>
        @error('organizer')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="ckeditor" class="form-label">Event Description</label>
        <textarea wire:ignore id="ckeditor" wire:model="content" class="form-control @error('content') is-invalid @enderror" rows="4"></textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="banner" class="form-label">Banner Image</label>
        <input type="file" id="banner" wire:model="banner" class="form-control @error('banner') is-invalid @enderror" accept="image/*">
        @error('banner')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($existingBanner)
            <div class="mt-2 d-flex align-items-center">
                <img src="{{ asset('storage/' . $existingBanner) }}" alt="Banner" class="img-thumbnail me-3" style="width: 150px; height: 90px; object-fit: cover;">
                <button wire:click.prevent="deleteBanner" class="btn btn-outline-danger btn-sm">Remove</button>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label class="form-label">Gallery Images</label>
        <input type="file" wire:model="images" multiple class="form-control @error('images.*') is-invalid @enderror" accept="image/*">
        @error('images.*')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        <div class="row row-cols-3 g-3 mt-3">
            @foreach ($images as $index => $image)
                <div class="col position-relative">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image preview" class="img-fluid rounded shadow-sm" style="height: 120px; object-fit: cover; width: 100%;">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" wire:model="featuredImageIndex" value="{{ $index }}" id="featuredNew{{ $index }}">
                        <label class="form-check-label" for="featuredNew{{ $index }}">
                            Featured
                        </label>
                    </div>
                </div>
            @endforeach

            @foreach ($existingImages as $index => $img)
                <div class="col position-relative">
                    <img src="{{ asset('storage/' . $img->path) }}" alt="Existing image" class="img-fluid rounded shadow-sm" style="height: 120px; object-fit: cover; width: 100%;">
                    <div class="form-check mt-2 d-flex justify-content-between align-items-center">
                        <input class="form-check-input" type="radio" wire:model="featuredImageIndex" value="existing_{{ $index }}" id="featuredExisting{{ $index }}">
                        <label class="form-check-label" for="featuredExisting{{ $index }}">
                            Featured
                        </label>
                        <button wire:click.prevent="deleteImage({{ $img->id }})" class="btn btn-link btn-sm text-danger p-0 ms-2">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary px-4">
            {{ $eventId ? 'Update Event' : 'Create Event' }}
        </button>
    </div>
</form>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                ClassicEditor.create(document.querySelector('#ckeditor'))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('content', editor.getData());
                            Livewire.dispatch('updateContent', { value: editor.getData() });
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

                Livewire.on('resetEditor', () => {
                    if (ClassicEditor.instances['ckeditor']) {
                        ClassicEditor.instances['ckeditor'].setData('');
                    }
                });
            });
        </script>
    @endpush
</div>
