<div>
    <div class="row">
        <div class="col-12">
            <div
                class="page-title-box d-flex align-items-center justify-content-between"
            >
                <h4 class="mb-0">Donations Management</h4>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="far fa-check-circle me-2"></i>
            <div>{{ session("message") }}</div>
        </div>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalDonations }}</h4>
                            <p class="mb-0">Total Donations</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">
                                KES {{ number_format($totalAmount, 2) }}
                            </h4>
                            <p class="mb-0">Total Amount</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $pendingDonations }}</h4>
                            <p class="mb-0">Pending</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $completedDonations }}</h4>
                            <p class="mb-0">Completed</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Search by name, email, or reference..."
                    />
                </div>
                <div class="col-md-3">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="typeFilter" class="form-select">
                        <option value="">All Types</option>
                        <option value="external">External</option>
                        <option value="direct">Direct</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button
                        wire:click="$refresh"
                        class="btn btn-secondary w-100"
                    >
                        <i class="fas fa-refresh"></i> Refresh
                    </button>
                </div>
            </div>

            <!-- Donations Table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td>
                                <span
                                    class="badge bg-light text-dark"
                                    >{{ $donation->reference }}</span
                                >
                            </td>
                            <td>{{ $donation->name }}</td>
                            <td>{{ $donation->email }}</td>
                            <td>
                                <strong
                                    class="text-success"
                                    >{{ $donation->formatted_amount }}</strong
                                >
                            </td>
                            <td>
                                @if($donation->donation_type === 'external')
                                <span class="badge bg-primary">External</span>
                                @else
                                <span class="badge bg-info">Direct</span>
                                @endif
                            </td>
                            <td>{!! $donation->status_badge !!}</td>
                            <td>
                                {{ $donation->created_at->format('M d, Y H:i') }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        data-bs-toggle="dropdown"
                                    >
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click="updateStatus({{ $donation->id }}, 'completed')"
                                            >
                                                <i
                                                    class="fas fa-check text-success"
                                                ></i>
                                                Mark Completed
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click="updateStatus({{ $donation->id }}, 'pending')"
                                            >
                                                <i
                                                    class="fas fa-clock text-warning"
                                                ></i>
                                                Mark Pending
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                                wire:click="updateStatus({{ $donation->id }}, 'failed')"
                                            >
                                                <i
                                                    class="fas fa-times text-danger"
                                                ></i>
                                                Mark Failed
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li>
                                            <a
                                                class="dropdown-item text-danger"
                                                href="#"
                                                onclick="if(confirm('Are you sure you want to delete this donation?')) { $wire.deleteDonation({{ $donation->id }}) }"
                                            >
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No donations found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
