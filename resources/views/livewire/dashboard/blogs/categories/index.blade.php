<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Updates Categories</h4>

            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#manageDepCategoryModal"
            >
                Add News Category
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
                        @forelse ($cats as $index => $cat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cat->name}}</td>

                            <td>{{ $cat->updated_at->format("j M, Y") }}</td>
                            <td class="text-end">
                                <a
                                    class="btn btn-primary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#manageDepCategoryModal"
                                    wire:click="$dispatch('editDepCategory', { id: {{ $cat->id }} })"
                                >

                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <!-- Delete Button -->
                                <a
                                    class="btn btn-danger shadow btn-xs sharp me-1"
                                       data-bs-toggle="modal"
                                    data-bs-target="#manageDepCategoryModal"
                                    wire:click="$dispatch('deleteDepCategory', { id: '{{ $cat->id }}' })"

                                >


                                    <i class="fas fa-trash-alt"></i>
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
                @livewire('dashboard.blogs.categories.manage-updates-category-modal')
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("livewire:initialized", () => {
        Livewire.on("closeModal", () => {
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("manageDepCategoryModal")
            );
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
