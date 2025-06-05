<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Album Categories</h4>
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

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary me-2">
                                                {{ $isEditing ? 'Update Category' : 'Add Category' }}
                                            </button>
                                            @if($isEditing)
                                                <button type="button" class="btn btn-outline-secondary" wire:click="cancel">
                                                    Cancel
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
                                            <th>Albums</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->albums->count() }}</td>
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
                            </div>

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
