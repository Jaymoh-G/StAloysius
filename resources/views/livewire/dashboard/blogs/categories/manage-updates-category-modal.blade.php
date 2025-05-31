<div>
    <div class="modal-header">
        <h5 class="modal-title">
            {{ $updateCategoryId ? 'Edit Department Category' : 'Create New Department Category' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Department Category Name</label>
            <input type="text" wire:model.defer="name" class="form-control" id="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        @if($updateCategoryId)
            <button wire:click="deleteDepCategory" class="btn btn-danger">Delete</button>
        @endif

        <button wire:click="save" type="button" class="btn btn-primary">
            {{ $updateCategoryId ? 'Update Category' : 'Save Category' }}
        </button>
    </div>
</div>
