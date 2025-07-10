<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        <h4 class="card-title">
                            Volunteer Applications <i class="far fa-heart"></i>
                        </h4>
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
                                                <i class="fas fa-envelope"></i>
                                                {{ $application->email }}
                                            </div>
                                            <div>
                                                <i class="fas fa-phone"></i>
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
                                                    wire:click="openEditModal({{ $application->id }})"
                                                    title="Edit Application"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-warning"
                                                    wire:click="openStatusModal({{ $application->id }})"
                                                    title="Update Status"
                                                >
                                                    <i class="fas fa-flag"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#applicationModal{{ $application->id }}"
                                                    title="View Details"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmDelete({{ $application->id }}, '{{ $application->name }}')"
                                                    title="Delete"
                                                >
                                                    <i class="fas fa-trash"></i>
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
                                                                Personal
                                                                Information
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
                                                                Skills &
                                                                Expertise
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

                        <div class="d-flex justify-content-center">
                            {{ $applications->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">{{ session("error") }}</div>
    @endif

    <!-- Edit Application Modal -->
    @if($showEditModal)
    <div
        class="modal fade show"
        style="display: block !important; z-index: 1050"
        tabindex="-1"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Volunteer Application</h5>
                    <button
                        type="button"
                        class="btn-close"
                        wire:click="closeEditModal"
                    ></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateApplication">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editName" class="form-label"
                                    >Full Name *</label
                                >
                                <input
                                    type="text"
                                    id="editName"
                                    wire:model="editName"
                                    class="form-control @error('editName') is-invalid @enderror"
                                    placeholder="Enter full name"
                                />
                                @error('editName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editEmail" class="form-label"
                                    >Email Address *</label
                                >
                                <input
                                    type="email"
                                    id="editEmail"
                                    wire:model="editEmail"
                                    class="form-control @error('editEmail') is-invalid @enderror"
                                    placeholder="Enter email address"
                                />
                                @error('editEmail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="editTel" class="form-label"
                                    >Telephone Number *</label
                                >
                                <input
                                    type="tel"
                                    id="editTel"
                                    wire:model="editTel"
                                    class="form-control @error('editTel') is-invalid @enderror"
                                    placeholder="Enter phone number"
                                />
                                @error('editTel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="editSkills" class="form-label"
                                    >Skills & Expertise *</label
                                >
                                <textarea
                                    id="editSkills"
                                    wire:model="editSkills"
                                    class="form-control @error('editSkills') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Describe skills and expertise"
                                ></textarea>
                                @error('editSkills')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label
                                    for="editAdditionalInformation"
                                    class="form-label"
                                    >Additional Information</label
                                >
                                <textarea
                                    id="editAdditionalInformation"
                                    wire:model="editAdditionalInformation"
                                    class="form-control @error('editAdditionalInformation') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Any additional information"
                                ></textarea>
                                @error('editAdditionalInformation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                wire:click="closeEditModal"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                wire:loading.attr="disabled"
                            >
                                <span
                                    wire:loading.remove
                                    wire:target="updateApplication"
                                >
                                    <i class="fas fa-save me-2"></i>Update
                                    Application
                                </span>
                                <span
                                    wire:loading
                                    wire:target="updateApplication"
                                >
                                    <i class="fas fa-spinner fa-spin me-2"></i
                                    >Updating...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" style="z-index: 1040"></div>
    @endif

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
                        <strong>Applicant:</strong>
                        {{ $selectedApplication->name }}
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
                            <i class="fas fa-clock"></i> Pending
                        </button>
                        <button
                            type="button"
                            class="btn btn-info"
                            wire:click="updateStatus('contacted')"
                        >
                            <i class="fas fa-phone"></i> Contacted
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            wire:click="updateStatus('approved')"
                        >
                            <i class="fas fa-check"></i> Approved
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            wire:click="updateStatus('rejected')"
                        >
                            <i class="fas fa-times"></i> Rejected
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

    <script>
                    function confirmDelete(applicationId, applicationName) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to delete the volunteer application for "${applicationName}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: 'Deleting...',
                                text: 'Please wait while we delete the application.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            @this.deleteApplication(applicationId);
                        }
                    });
                }

                    // Listen for the application-deleted event
        document.addEventListener('livewire:initialized', () => {
            @this.on('application-deleted', () => {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'The volunteer application has been deleted successfully.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
</div>
