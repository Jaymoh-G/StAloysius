<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Departments Categories</h4>

            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#manageDepCategoryModal"
            >
                Add New Category
            </button>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-responsive-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Parent</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $index = 1; @endphp

                        <!-- Main Categories -->
                        @forelse ($mainCategories as $main)
                        <tr class="table-primary">
                            <td>{{ $index++ }}</td>
                            <td><strong>{{ $main->name }}</strong></td>
                            <td>Main Category</td>
                            <td>-</td>
                            <td>{{ $main->updated_at->format('j M, Y') }}</td>
                            <td class="text-end">
                                <a class="btn btn-primary shadow btn-xs sharp me-1"
                                   data-bs-toggle="modal"
                                   data-bs-target="#manageDepCategoryModal"
                                   wire:click="$dispatch('editDepCategory', { id: {{ $main->id }} })">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger shadow btn-xs sharp me-1"
                                   href="javascript:void(0);"
                                   onclick="confirmDeleteCategory('{{ $main->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Sub Categories -->
                        @foreach ($main->children as $child)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td class="ps-4">{{ $child->name }}</td>
                            <td>Sub Category</td>
                            <td>{{ $child->parent->name }}</td>
                            <td>{{ $child->updated_at->format('j M, Y') }}</td>
                            <td class="text-end">
                                <a class="btn btn-primary shadow btn-xs sharp me-1"
                                   data-bs-toggle="modal"
                                   data-bs-target="#manageDepCategoryModal"
                                   wire:click="$dispatch('editDepCategory', { id: {{ $child->id }} })">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger shadow btn-xs sharp me-1"
                                   href="javascript:void(0);"
                                   onclick="confirmDeleteCategory('{{ $child->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @empty
                        <!-- No main categories -->
                        @endforelse

                        <!-- Standalone Categories (for backward compatibility) -->
                        @foreach ($standaloneCategories as $dep)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $dep->name }}</td>
                            <td>Standard Category</td>
                            <td>-</td>
                            <td>{{ $dep->updated_at->format('j M, Y') }}</td>
                            <td class="text-end">
                                <a class="btn btn-primary shadow btn-xs sharp me-1"
                                   data-bs-toggle="modal"
                                   data-bs-target="#manageDepCategoryModal"
                                   wire:click="$dispatch('editDepCategory', { id: {{ $dep->id }} })">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger shadow btn-xs sharp me-1"
                                   href="javascript:void(0);"
                                   onclick="confirmDeleteCategory('{{ $dep->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @if($mainCategories->isEmpty() && $standaloneCategories->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No categories found.</td>
                        </tr>
                        @endif
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
    function confirmDeleteCategory(id) {
        if (confirm('Are you sure you want to delete this department category? This action cannot be undone.')) {
            Livewire.dispatch('deleteCategory', { id: id });
        }
    }

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('deleteCategory', (data) => {
            @this.delete(data.id);
        });

        Livewire.on("closeModal", () => {
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("manageDepCategoryModal")
            );
            if (modal) {
                modal.hide();

                // Force a refresh after modal is closed
                setTimeout(() => {
                    Livewire.dispatch('$refresh');
                }, 300);
            }
        });

        Livewire.on("categorySaved", (data) => {
            // Force a refresh when category is saved
            Livewire.dispatch('$refresh');
        });

        Livewire.on("categoryDeleted", () => {
            Livewire.dispatch('$refresh');
        });

        Livewire.on("depCategoryDeleted", () => {
            Livewire.dispatch('$refresh');
        });
    });
</script>

