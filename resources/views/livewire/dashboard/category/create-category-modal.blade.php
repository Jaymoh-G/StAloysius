<div>
    <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">
            Add New Category
        </h5>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
        ></button>
    </div>
    <div class="modal-body">
        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input
                    type="text"
                    wire:model.defer="name"
                    class="form-control"
                    id="name"
                    placeholder="Enter category name"
                />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button
                    type="button"
                    class="btn btn-secondary me-2"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

