<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Event Categories</h4>

            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#manageEventCategoryModal"
            >
                Add New Category
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->updated_at->format("j M, Y") }}</td>
                                <td class="text-end">
                                    <a
                                        class="btn btn-primary shadow btn-xs sharp me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#manageEventCategoryModal"
                                        wire:click="$dispatch('editEventCategory', { id: {{ $category->id }} })"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a
                                        class="btn btn-danger shadow btn-xs sharp me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#manageEventCategoryModal"
                                        wire:click="$dispatch('deleteEventCategory', { id: '{{ $category->id }}' })"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Event Category Modal -->
    <div
        class="modal fade"
        id="manageEventCategoryModal"
        tabindex="-1"
        aria-labelledby="manageEventCategoryModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                @livewire('dashboard.events.categories.manage-event-category-modal');


            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("livewire:initialized", () => {
        Livewire.on("closeModal", () => {
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("manageEventCategoryModal")
            );
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
