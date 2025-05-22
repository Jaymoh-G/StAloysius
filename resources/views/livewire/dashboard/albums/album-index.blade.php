<div class="container py-4">
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Albums</h4>
        <a href="{{ route('albums.create') }}" class="btn btn-primary">+ New Album</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr>
                        <td>{{ $album->title }}</td>
                        <td>{{ $album->category->name ?? '—' }}</td>
                        <td>
                            @if ($album->images)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($album->images as $img)
                                        <img src="{{ asset('storage/' . $img) }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">No images</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                            <button wire:click="confirmDelete({{ $album->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No albums found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteAlbumModal" tabindex="-1" aria-labelledby="deleteAlbumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAlbumModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this album?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="deleteConfirmed" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('show-delete-modal', event => {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteAlbumModal'));
        deleteModal.show();
    });
</script>
