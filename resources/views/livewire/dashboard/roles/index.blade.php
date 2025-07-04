<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Role Management</h2>
        <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Role
        </a>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session("success") }}
    </div>
    @endif @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session("error") }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Users Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>
                                <strong>{{ ucfirst($role->name) }}</strong>
                                @if(in_array($role->name, ['super admin',
                                'admin', 'editor', 'user']))
                                <span class="badge bg-info ms-2"
                                    >System Role</span
                                >
                                @endif
                            </td>
                            <td>
                                @if($role->permissions->count() > 0)
                                <div class="small">
                                    @php $groupedPermissions = [];
                                    foreach($role->permissions as $permission) {
                                    $parts = explode(' ', $permission->name, 2);
                                    if (count($parts) === 2) {
                                    $groupedPermissions[$parts[1]][] =
                                    $parts[0]; } } @endphp
                                    <div class="row">
                                        @foreach(array_slice($groupedPermissions,
                                        0, 3) as $module => $actions)
                                        <div class="col-md-4 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{
                                                            ucfirst(
                                                                str_replace(
                                                                    "_",
                                                                    " ",
                                                                    $module
                                                                )
                                                            )
                                                        }}
                                                    </h5>
                                                    <p class="card-text">
                                                        {{
                                                            implode(
                                                                ", ",
                                                                $actions
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if(count($groupedPermissions) > 3)
                                    <span class="text-muted"
                                        >+{{
                                            count($groupedPermissions) - 3
                                        }}
                                        more modules</span
                                    >
                                    @endif
                                </div>
                                @else
                                <span class="text-muted">No permissions</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    class="badge bg-primary"
                                    >{{ $role->users_count ?? 0 }}</span
                                >
                            </td>
                            <td>
                                <a
                                    href="{{ route('dashboard.roles.edit', $role->id) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if(!in_array($role->name, ['super admin',
                                'admin', 'editor', 'user']))
                                <button
                                    wire:click="deleteRole({{ $role->id }})"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this role?')"
                                >
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
