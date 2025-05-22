<div class="container py-4">
    <form wire:submit.prevent="save" class="p-4 bg-white rounded shadow-sm border">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input id="title" type="text" wire:model="title" class="form-control">
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" wire:model="description" class="form-control" rows="3"></textarea>
            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Category Select + Add Button --}}
        <div class="mb-3">
            <label for="album_category_id" class="form-label">Category</label>
            <div class="d-flex gap-2">
                <select id="album_category_id" wire:model="album_category_id" class="form-select">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    + Add
                </button>
            </div>
            @error('album_category_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        {{-- Image Upload --}}
        <div class="mb-3">
            <label for="images" class="form-label">Album Images (Multiple)</label>
            <input id="images" type="file" wire:model="images" multiple class="form-control">
            @error('images.*') <div class="text-danger small">{{ $message }}</div> @enderror
            <div wire:loading wire:target="images" class="form-text">Uploading images...</div>

            @if ($images)
                <div class="row mt-3">
                    @foreach ($images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded shadow-sm" style="height: 150px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">
            Save Album
        </button>
    </form>

    {{-- Livewire Modal for Add Category --}}
    @livewire('dashboard.album-categories.album-category-modal')
</div>

{{-- JS to close modal when Livewire emits "closeModal" --}}
<script>
    window.addEventListener('closeModal', () => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
        modal.hide();
    });
</script>
