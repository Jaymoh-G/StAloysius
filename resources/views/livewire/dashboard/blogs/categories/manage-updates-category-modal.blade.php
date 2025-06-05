<div>
    <div class="modal-header">
        <h5 class="modal-title">
            @if($updateCategoryId)
                @if($isDeleteMode)
                    Delete News Category
                @else
                    Edit News Category
                @endif
            @else
                Create News Category
            @endif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
    </div>
    <div class="modal-body">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($isDeleteMode && $updateCategoryId)
            <p>Are you sure you want to delete the category "{{ $name }}"?</p>
            <p class="text-danger">This action cannot be undone.</p>
        @else
            <div class="mb-3">
                <label for="name" class="form-label">News Category Name</label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Cancel</button>

        @if($updateCategoryId)
            @if($isDeleteMode)
                <button wire:click="confirmDelete" class="btn btn-danger">Delete</button>
            @else
                <button wire:click="save" type="button" class="btn btn-primary">Update</button>
            @endif
        @else
            <button wire:click="save" type="button" class="btn btn-primary">Save</button>
        @endif
    </div>
</div>



