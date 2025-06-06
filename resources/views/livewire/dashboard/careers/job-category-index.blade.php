<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Job Categories</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Search categories..." wire:model.live="searchTerm">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $isEditing ? 'Edit Category' : 'Add New Category' }}</h5>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                wire:model="name" placeholder="Enter category name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            @if($isEditing)
                                                <button type="button" class="btn btn-danger" wire:click="cancel">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Update Category
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-success">
                                                    Add Category
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Vacancies</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->vacancies->count() }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info me-1" wire:click="edit({{ $category->id }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="delete({{ $category->id }})"
                                                        wire:confirm="Are you sure you want to delete this category?">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No categories found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (data) => {
                if (data.type === 'success') {
                    toastr.success(data.message);
                } else if (data.type === 'error') {
                    toastr.error(data.message);
                }
            });
        });
    </script>
</div>