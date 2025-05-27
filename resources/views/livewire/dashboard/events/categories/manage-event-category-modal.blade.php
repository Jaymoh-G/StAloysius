<div>
    <div class="modal-header">
        <h5 class="modal-title">
            {{ $eventCategoryId ? 'Edit Event Category' : 'Create New Event Category' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="$emit('resetForm')"></button>
    </div>

    <div class="modal-body">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Event Category Name</label>
            <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter category name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="$emit('resetForm')">
            Cancel
        </button>

        @if($eventCategoryId)
            <button wire:click="deleteEventCategory" class="btn btn-danger">Delete</button>
        @endif

        <button wire:click="save" type="button" class="btn btn-primary">
            {{ $eventCategoryId ? 'Update Category' : 'Save Category' }}
        </button>
    </div>
</div>
