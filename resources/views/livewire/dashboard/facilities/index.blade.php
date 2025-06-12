<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Facilities</h4>
            <a href="{{ route('dashboard.facilities.facilities.create') }}" class="btn btn-primary">Add New Facility</a>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table-bordered table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Featured Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td>{{ $facility->name }}</td>
                                <td>{{ $facility->department->name ?? 'N/A' }}</td>
                                <td>
                                    @if ($facility->featuredImage)
                                        <img src="{{ asset('storage/' . $facility->featuredImage->path) }}"
                                            alt="Featured Image" class="img-thumbnail" style="max-height: 100px;">
                                    @else
                                        No featured image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.facilities.facilities.edit', $facility->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button wire:click="deleteFacility({{ $facility->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $facilities->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('confirmDelete', function(data) {
                    if (confirm('Are you sure you want to delete this facility?')) {
                        @this.deleteConfirmed(data.id);
                    }
                });
            });
        </script>
    @endpush
</div>
