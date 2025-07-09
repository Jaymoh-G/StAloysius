<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-center"
                >
                    <h4 class="card-title">Volunteer Applications</h4>
                    <div class="d-flex gap-2">
                        <input
                            type="text"
                            wire:model.live="search"
                            class="form-control"
                            placeholder="Search applications..."
                            style="width: 250px"
                        />
                        <select
                            wire:model.live="status"
                            class="form-select"
                            style="width: 150px"
                        >
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="contacted">Contacted</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session("message") }}
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Skills</th>
                                    <th>Status</th>
                                    <th>Date Applied</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                <tr>
                                    <td>
                                        <strong
                                            >{{ $application->name }}</strong
                                        >
                                    </td>
                                    <td>
                                        <div>
                                            <i class="far fa-envelope"></i>
                                            {{ $application->email }}
                                        </div>
                                        <div>
                                            <i class="far fa-phone"></i>
                                            {{ $application->tel }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-truncate"
                                            style="max-width: 200px"
                                            title="{{ $application->skills }}"
                                        >
                                            {{ Str::limit($application->skills, 100) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $application->status_badge }}"
                                        >
                                            {{ $application->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $application->created_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                wire:click="openStatusModal({{ $application->id }})"
                                                title="Update Status"
                                            >
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#applicationModal{{ $application->id }}"
                                                title="View Details"
                                            >
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                wire:click="deleteApplication({{ $application->id }})"
                                                onclick="return confirm('Are you sure you want to delete this application?')"
                                                title="Delete"
                                            >
                                                <i class="far fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Application Details Modal -->
                                <div
                                    class="modal fade"
                                    id="applicationModal{{ $application->id }}"
                                    tabindex="-1"
                                >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Volunteer Application
                                                    Details
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>
                                                            Personal Information
                                                        </h6>
                                                        <p>
                                                            <strong
                                                                >Name:</strong
                                                            >
                                                            {{ $application->name }}
                                                        </p>
                                                        <p>
                                                            <strong
                                                                >Email:</strong
                                                            >
                                                            {{ $application->email }}
                                                        </p>
                                                        <p>
                                                            <strong
                                                                >Phone:</strong
                                                            >
                                                            {{ $application->tel }}
                                                        </p>
                                                        <p>
                                                            <strong
                                                                >Status:</strong
                                                            >
                                                            <span
                                                                class="badge {{ $application->status_badge }}"
                                                            >
                                                                {{ $application->status_text }}
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <strong
                                                                >Applied:</strong
                                                            >
                                                            {{ $application->created_at->format('F j, Y \a\t g:i A') }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>
                                                            Skills & Expertise
                                                        </h6>
                                                        <p>
                                                            {{ $application->skills }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($application->additional_information)
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <h6>
                                                            Additional
                                                            Information
                                                        </h6>
                                                        <p>
                                                            {{ $application->additional_information }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    wire:click="openStatusModal({{ $application->id }})"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Update Status
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No volunteer applications found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
@if($showStatusModal && $selectedApplication)
<div class="modal fade show" style="display: block" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Application Status</h5>
                <button
                    type="button"
                    class="btn-close"
                    wire:click="closeStatusModal"
                ></button>
            </div>
            <div class="modal-body">
                <p>
                    <strong>Applicant:</strong> {{ $selectedApplication->name }}
                </p>
                <p>
                    <strong>Current Status:</strong>
                    <span
                        class="badge {{ $selectedApplication->status_badge }}"
                    >
                        {{ $selectedApplication->status_text }}
                    </span>
                </p>
                <hr />
                <h6>Select New Status:</h6>
                <div class="d-grid gap-2">
                    <button
                        type="button"
                        class="btn btn-warning"
                        wire:click="updateStatus('pending')"
                    >
                        <i class="far fa-clock"></i> Pending
                    </button>
                    <button
                        type="button"
                        class="btn btn-info"
                        wire:click="updateStatus('contacted')"
                    >
                        <i class="far fa-phone"></i> Contacted
                    </button>
                    <button
                        type="button"
                        class="btn btn-success"
                        wire:click="updateStatus('approved')"
                    >
                        <i class="far fa-check"></i> Approved
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        wire:click="updateStatus('rejected')"
                    >
                        <i class="far fa-times"></i> Rejected
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    wire:click="closeStatusModal"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
