<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Activity Log</h2>
        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input
                        type="text"
                        id="search"
                        wire:model.live.debounce.300ms="search"
                        class="form-control"
                        placeholder="Search activities..."
                    />
                </div>
                <div class="col-md-3">
                    <label for="timeFilter" class="form-label"
                        >Time Period</label
                    >
                    <select
                        id="timeFilter"
                        wire:model.live="filter"
                        class="form-select"
                    >
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="moduleFilter" class="form-label">Module</label>
                    <select
                        id="moduleFilter"
                        wire:model.live="moduleFilter"
                        class="form-select"
                    >
                        <option value="all">All Modules</option>
                        @foreach($availableModules as $module => $displayName)
                        <option value="{{ $module }}">
                            {{ $displayName }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="perPage" class="form-label">Per Page</label>
                    <select
                        id="perPage"
                        wire:model.live="perPage"
                        class="form-select"
                    >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities List -->
    <div class="card">
        <div class="card-body">
            @if($activities->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Module</th>
                            <th>Date</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <td>
                                <span
                                    class="badge bg-{{ $activity->action_color }}"
                                >
                                    {{ ucfirst($activity->action) }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $activity->description }}</strong>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user me-2 text-muted"></i>
                                    {{ $activity->user->name }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $activity->module_display_name }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    <div>
                                        {{ $activity->created_at->format('M j, Y') }}
                                    </div>
                                    <small
                                        class="text-muted"
                                        >{{ $activity->created_at->format('g:i A') }}</small
                                    >
                                </div>
                            </td>
                            <td>
                                @if($activity->properties &&
                                count($activity->properties) > 0)
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#activityModal{{ $activity->id }}"
                                >
                                    <i class="fas fa-eye"></i> View
                                </button>
                                @else
                                <span class="text-muted">No details</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $activities->firstItem() }} to
                    {{ $activities->lastItem() }} of
                    {{ $activities->total() }} activities
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $activities->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Activity Detail Modals -->
            @foreach($activities as $activity) @if($activity->properties &&
            count($activity->properties) > 0)
            <div
                class="modal fade"
                id="activityModal{{ $activity->id }}"
                tabindex="-1"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Activity Details</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Action:</strong>
                                    {{ ucfirst($activity->action) }}<br />
                                    <strong>Module:</strong>
                                    {{ $activity->module_display_name }}<br />
                                    <strong>User:</strong>
                                    {{ $activity->user->name }}<br />
                                    <strong>Date:</strong>
                                    {{ $activity->created_at->format('M j, Y g:i A') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Description:</strong><br />
                                    {{ $activity->description }}
                                </div>
                            </div>
                            <hr />
                            <h6>Additional Properties:</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Property</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activity->properties as $key
                                        => $value)
                                        <tr>
                                            <td>
                                                <strong>{{
                                                    ucfirst($key)
                                                }}</strong>
                                            </td>
                                            <td>
                                                @if(is_string($value))
                                                {{ $value }}
                                                @elseif(is_array($value))
                                                <pre class="mb-0">{{
                                                    json_encode(
                                                        $value,
                                                        JSON_PRETTY_PRINT
                                                    )
                                                }}</pre>
                                                @else
                                                {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif @endforeach @else
            <div class="text-center py-5">
                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No activities found</h5>
                <p class="text-muted">
                    No activities match your current filters.
                </p>
                @if(!empty($search) || $filter !== 'all' || $moduleFilter !==
                'all')
                <button
                    wire:click="$set('search', '')"
                    class="btn btn-outline-secondary"
                >
                    Clear Filters
                </button>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
