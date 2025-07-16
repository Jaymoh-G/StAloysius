<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Projects Management</h4>
                    <div
                        class="d-flex justify-content-between align-items-center"
                    >
                        <div class="d-flex gap-2">
                            <input
                                wire:model.live="search"
                                type="text"
                                class="form-control"
                                placeholder="Search projects..."
                                style="width: 250px"
                            />
                            <select
                                wire:model.live="statusFilter"
                                class="form-select"
                                style="width: 150px"
                            >
                                <option value="">All Status</option>
                                <option value="planning">Planning</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                                <option value="cancelled">Cancelled</option>
                            </select>

                            <select
                                wire:model.live="featuredFilter"
                                class="form-select"
                                style="width: 150px"
                            >
                                <option value="">All Projects</option>
                                <option value="1">Featured Only</option>
                                <option value="0">Not Featured</option>
                            </select>
                        </div>
                        <a
                            href="{{ route('dashboard.projects.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="fas fa-plus"></i> Add New Project
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session("success") }}
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Department</th>
                                    <th>Duration</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $project)
                                <tr>
                                    <td>
                                        @if($project->featuredImage)
                                        <img
                                            src="{{ asset('storage/' . $project->featuredImage->path) }}"
                                            alt="{{ $project->title }}"
                                            class="img-thumbnail"
                                            style="
                                                width: 60px;
                                                height: 60px;
                                                object-fit: cover;
                                            "
                                        />
                                        @else
                                        <div
                                            class="bg-light d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px"
                                        >
                                            <i
                                                class="fas fa-image text-muted"
                                            ></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $project->title }}</strong>
                                        <br />
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i>
                                            Updated:
                                            {{ $project->updated_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $project->status_badge }}"
                                        >
                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $project->department?->name ?? 'none' }}</td>
                                    <td>{{ $project->duration }}</td>
                                    <td>
                                        <button
                                            wire:click="toggleFeatured({{ $project->id }})"
                                            class="btn btn-sm {{ $project->is_featured ? 'btn-success' : 'btn-outline-success' }}"
                                        >
                                            <i
                                                class="fas {{ $project->is_featured ? 'fa-star' : 'fa-star-o' }}"
                                            ></i>
                                        </button>
                                    </td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <a
                                                href="{{ route('project', $project->slug) }}"
                                                class="btn btn-sm btn-info"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a
                                                href="{{ route('dashboard.projects.edit', $project->id) }}"
                                                class="btn btn-sm btn-primary"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button
                                                wire:click="deleteProject({{ $project->id }})"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this project?')"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        No projects found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- bootstrap pagination -->

                    <div class="d-flex justify-content-center">
                        {{ $projects->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
