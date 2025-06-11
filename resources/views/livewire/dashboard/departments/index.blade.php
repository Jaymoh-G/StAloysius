<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Departments</h4>
            <a href="{{ route('departments.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Add Department
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-hover table-responsive-sm table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th style="max-width: 300px">Name</th>
                            <th style="max-width: 300px">Description</th>
                            <th>Images</th>
                            <th>Banner</th>
                            <th>Category</th>
                            <th>Last Updated</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deps as $index => $dep)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td
                                    style="
                                    max-width: 130px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
                                    {{ Str::limit(strip_tags($dep->name), 70) }}
                                </td>

                                <td
                                    style="
                                    max-width: 130px;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
                                    {!! Str::limit(strip_tags($dep->content), 70) !!}
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $featured = $dep->images->where('is_featured', true)->first();
                                            $others = $dep->images->where('is_featured', false)->take(4);
                                        @endphp
                                        @if ($featured)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $featured->path) }}"
                                                    alt="Featured Image" class="img-thumbnail"
                                                    style="height: 60px; width: 60px" />
                                                <span class="position-absolute start-0 top-0 m-1 bg-white"><i
                                                        class="text-success bi bi-check-circle-fill"></i></span>
                                            </div>
                                        @endif
                                        @foreach ($others as $image)
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Department Image"
                                                class="img-thumbnail" style="height: 60px; width: 60px" />
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $dep->banner) }}" alt="No Custom Banner"
                                        class="img-thumbnail" style="height: 60px; width: auto" />
                                </td>

                                <td style="max-width: 120px">
                                    {{ $dep->depCategory->name ?? 'Uncategorized' }}
                                </td>

                                <td>{{ $dep->updated_at->format('j M, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('department', $dep->slug) }}"
                                        class="btn btn-success btn-xs sharp me-1 shadow" title="view" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('departments.edit', $dep->id) }}"
                                        class="btn btn-primary btn-xs sharp me-1 shadow" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs sharp me-1 shadow"
                                        wire:click.prevent="deleteDep({{ $dep->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    No department found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $deps->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Delete Department
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this department?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" wire:click="deletePostConfirmed" class="btn btn-danger"
                        data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('confirmDelete', (data) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deleteConfirmed(data.id);
                        Swal.fire(
                            'Deleted!',
                            'Department has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
@endpush
