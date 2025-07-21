<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Recent Activities</h4>
                <a
                    href="{{ route('dashboard.activities.index') }}"
                    class="btn btn-sm btn-outline-primary"
                >
                    All
                </a>
            </div>
            <div class="card-tools mt-2">
                <div class="d-flex gap-2">
                    <!-- Time Filter -->
                    <select
                        wire:model.live="filter"
                        class="form-select form-select-sm"
                        style="width: auto"
                    >
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>

                    <!-- Module Filter -->
                    <select
                        wire:model.live="moduleFilter"
                        class="form-select form-select-sm"
                        style="width: auto"
                    >
                        <option value="all">All Modules</option>
                        @foreach($availableModules as $module => $displayName)
                        <option value="{{ $module }}">
                            {{ $displayName }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(count($activities) > 0)
            <div class="timeline">
                @foreach($activities as $activity)
                <div class="timeline-item">
                    <div
                        class="timeline-badge bg-{{ $activity->action_color }}"
                    >
                        <i class="{{ $activity->action_icon }}"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <div
                                class="d-flex justify-content-between align-items-start"
                            >
                                <div>
                                    <h6 class="timeline-title mb-1">
                                        {{ $activity->description }}
                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $activity->user->name }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-layer-group me-1"></i>
                                        {{ $activity->module_display_name }}
                                    </small>
                                </div>
                                <small class="text-muted">
                                    {{ $this->getTimeAgo($activity->created_at) }}
                                </small>
                            </div>
                        </div>
                        <div class="timeline-body">
                            <div class="d-flex align-items-center">
                                <span
                                    class="badge bg-{{ $activity->action_color }} me-2"
                                >
                                    {{ ucfirst($activity->action) }}
                                </span>
                                <small class="text-muted">
                                    {{ $activity->created_at->format('M j, Y g:i A') }}
                                </small>
                            </div>
                            @if($activity->properties &&
                            count($activity->properties) > 0)
                            <div class="mt-2">
                                @foreach($activity->properties as $key =>
                                $value) @if(is_string($value) && strlen($value)
                                < 100)
                                <small class="text-muted">
                                    <strong>{{ ucfirst($key) }}:</strong>
                                    {{ $value }}
                                </small>
                                @endif @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-4">
                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                <h6 class="text-muted">No activities found</h6>
                <p class="text-muted small">
                    No recent activities match your current filters.
                </p>
            </div>
            @endif
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            left: 20px;
            height: 100%;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 50px;
        }

        .timeline-badge {
            position: absolute;
            left: 11px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            z-index: 1;
        }

        .timeline-panel {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .timeline-panel:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .timeline-title {
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .timeline-body {
            margin-top: 10px;
        }

        /* Action Colors */
        .bg-success {
            background-color: #28a745 !important;
        }
        .bg-primary {
            background-color: #007bff !important;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
        .bg-info {
            background-color: #17a2b8 !important;
        }
        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }
        .bg-secondary {
            background-color: #6c757d !important;
        }

        /* Dark theme support */
        [data-theme-version="dark"] .timeline::before {
            background: #2b2b2b;
        }

        [data-theme-version="dark"] .timeline-panel {
            background: #202020;
            border-color: #2b2b2b;
        }

        [data-theme-version="dark"] .timeline-title {
            color: #fff;
        }

        [data-theme-version="dark"] .text-muted {
            color: #999 !important;
        }
    </style>
</div>
