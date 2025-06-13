<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Facilities</h4>
            <a href="{{ route('dashboard.facilities.create') }}" class="btn btn-primary">Add New Facility</a>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-hover table-responsive-sm table align-middle">
                <table class="table-bordered table">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Banner</th>
                            <th>Department</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td>{{ Str::limit(strip_tags($facility->name), 70) }}</td>
                                <td>
                                    {!! Str::limit(strip_tags($facility->content), 70) !!}
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $featured = $facility->images->where('is_featured', true)->first();
                                            $others = $facility->images->where('is_featured', false)->take(4);
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
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Facility Image"
                                                class="img-thumbnail" style="height: 60px; width: 60px" />
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $facility->banner) }}" alt="No Custom Banner"
                                        class="img-thumbnail" style="height: 60px; width: auto" />
                                </td>
                                <td>{{ $facility->department->name ?? 'N/A' }}</td>
                                <td>{{ $facility->updated_at->format('j M, Y') }}</td>
                                <td>
                                    <a href="{{ route('facility', $facility->slug) }}"
                                        class="btn btn-info btn-xs sharp me-1 shadow" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('dashboard.facilities.edit', $facility->id) }}"
                                        class="btn btn-primary btn-xs sharp me-1 shadow" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button wire:click="deleteFacility({{ $facility->id }})"
                                        class="btn btn-danger btn-xs sharp me-1 shadow" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $facilities->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this facility?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger"
                        wire:click="deleteConfirmed({{ $facilityIdToDelete }})">Delete</button>
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
                            'Facility has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
@endpush

</div>
