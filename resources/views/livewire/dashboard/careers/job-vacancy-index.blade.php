<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Job Vacancies</h4>
                    <a href="{{ route('dashboard.careers.create') }}" class="btn btn-primary">Add New Job</a>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Search jobs..."
                                wire:model.live="search">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-hover table-bordered table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->category->name ?? 'N/A' }}</td>
                                        <td>{{ $job->deadline->format('M d, Y') }}</td>
                                        <td>
                                            @if ($job->is_active)
                                                @if ($job->deadline->isPast())
                                                    <span class="badge bg-warning">Expired</span>
                                                @else
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('careers.show', $job->slug) }}"
                                                class="btn btn-sm btn-success me-1" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.careers.edit', $job->id) }}"
                                                class="btn btn-sm btn-info me-1">
                                                <i class="fa fa-edit"></i>
                                            </a>


                                            <button class="btn btn-sm btn-danger"
                                                wire:click.prevent="delete({{ $job->id }})"
                                                class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No job vacancies found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $jobs->links() }}
                        </div>
                    </div>
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
                        @this.deleteConfirmed(data.id)
                        Swal.fire(
                            'Deleted!',
                            'Job vacancy has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
