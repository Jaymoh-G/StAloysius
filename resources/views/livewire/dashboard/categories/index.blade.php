<div>
    <div class="p-6 bg-white rounded shadow">
        @if (session()->has('message'))
            <div class="alert alert-success mb-4">{{ session('message') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif
    </div>

    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Departments</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Categories</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="input-group mb-3">
                    <input type="text" wire:model="name" class="form-control" placeholder="Category name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                    <button class="btn btn-primary">
                        {{ $updateMode ? 'Update' : 'Add' }}
                    </button>
                    @if ($updateMode)
                        <button type="button" wire:click="resetFields" class="btn btn-secondary">Cancel</button>
                    @endif
                </form>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle" style="min-width: 12.5rem;">Category Name</th>
                                        <th class="align-middle text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @foreach ($categories as $cat)
                                        <tr class="btn-reveal-trigger">
                                            <td class="py-2">{{ $cat->name }}</td>
                                            <td class="text-end">
                                                <span>
                                                    <a href="javascript:void(0);" class="me-4 btn btn-xs btn-primary me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i wire:click="edit({{ $cat->id }})" class="fas fa-pencil-alt color-muted text-end"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-xs btn-danger">
                                                        <i wire:click="confirmDelete({{ $cat->id }})" class="fas fa-trash color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteConfirmed">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', function () {
            Livewire.on('show-delete-confirmation', function () {
                var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                modal.show();
            });
        });
    </script>
</div>



