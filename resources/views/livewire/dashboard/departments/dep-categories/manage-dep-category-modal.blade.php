<div>
    <div class="modal-header">
        <h5 class="modal-title">
            {{ $depCategoryId ? 'Edit Department Category' : 'Create New Department Category' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label">Department Category Name</label>
            <input type="text" wire:model.defer="name" class="form-control" id="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" wire:model="isMain" class="form-check-input" id="isMain">
            <label class="form-check-label" for="isMain">Is Main Category</label>
            <small class="form-text text-muted">Check this if this is a top-level category like "Academic" or "Non-Academic"</small>
        </div>

        <div class="mb-3" @if($isMain) style="display: none;" @endif>
            <label for="parentId" class="form-label">Parent Category</label>
            <select wire:model.defer="parentId" class="form-control" id="parentId" @if($isMain) disabled @endif>
                <option value="">Select a parent category</option>
                @foreach(App\Models\DepCategory::where('is_main', true)->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Select a parent category if this is a sub-category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        @if($depCategoryId)
            <button onclick="confirmDelete()" class="btn btn-danger">Delete</button>
        @endif

        <button wire:click="save" type="button" class="btn btn-primary">
            {{ $depCategoryId ? 'Update Department' : 'Save Department' }}
        </button>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this department category? This action cannot be undone.')) {
            Livewire.dispatch('delete-confirmed');
        }
    }

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('delete-confirmed', () => {
            @this.deleteDepCategory();
        });
    });
</script>




