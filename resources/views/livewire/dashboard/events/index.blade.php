<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Events</h4>
            <a href="{{ route('dashboard.events.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Add Event
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Venue</th>
                            <th>Event Date</th>
                            <th>Organizer</th>
                            <th>Banner</th>
                            <th>Images</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $index => $event)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->organizer_name }}</td>
                          <td>
                                <img
                                    src="{{ asset('storage/' . $event->banner) }}"
                                    alt="No Custom Banner"
                                    class="img-thumbnail"
                                    style="height: 60px; width: auto"
                                />
                            </td>
 <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @php $featured =
                                    $event->images->firstWhere('is_featured',
                                    true); $others = $event->images->where('id',
                                    '!=', optional($featured)->id)->take(4);
                                    @endphp @if($featured)
                                    <div class="position-relative">
                                        <img
                                            src="{{ asset('storage/' . $featured->path) }}"
                                            alt="Featured Image"
                                            class="img-thumbnail"
                                            style="height: 60px; width: 60px"
                                        />
                                        <span
                                            class="bg-white position-absolute top-0 start-0 m-1"
                                            ><i
                                                class="text-success bi bi-check-circle-fill"
                                            ></i
                                        ></span>
                                    </div>
                                    @endif
                                    <div>
                                        @foreach($others as $image)
                                        <img
                                            src="{{ asset('storage/' . $image->path) }}"
                                            alt="Blog Image"
                                            class="img-thumbnail"
                                            style="height: 60px; width: 60px"
                                        />
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                  <a
                                    href="{{ route('event', $event->slug) }}"
                                    class="btn btn-success shadow btn-xs sharp me-1"
                                    title="view"
                                    target="_blank"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('dashboard.events.edit', $event->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button class="btn btn-danger shadow btn-xs sharp me-1"
                                        wire:click.prevent="deleteEvent({{ $event->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center">No events found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Delete Event</h5></div>
                <div class="modal-body">Are you sure you want to delete this event?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button wire:click="deleteConfirmed" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('show-delete-modal', () => {
        let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });
</script>
@endpush
