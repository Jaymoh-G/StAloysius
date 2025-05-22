<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Departments Categories</h4>

            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#manageDepCategoryModal"
            wire:click="$dispatch('editCategory', { id: null })"
            >
                Add New Category
            </button>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table table-hover table-responsive-sm align-middle"
                >
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deps as $index => $dep)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dep->name}}</td>

                            <td>{{ $dep->updated_at->format("j M, Y") }}</td>
                            <td class="text-end">
                                <a
                                    class="btn btn-primary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#manageDepCategoryModal"
                                   wire:click="$dispatch('editCategory', { id: {{ $dep->id }} })"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No categories found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Category Modal -->
    <div
        class="modal fade"
        id="manageDepCategoryModal"
        tabindex="-1"
        aria-labelledby="manageDepCategoryModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                @livewire('dashboard.departments.dep-categories.manage-dep-category-modal')
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('closeModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('manageDepCategoryModal'));
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
