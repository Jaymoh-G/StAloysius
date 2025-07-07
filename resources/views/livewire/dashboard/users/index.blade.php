<div class="container mt-4">
    <h2>User Management</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->roles->count() > 0)
                    @foreach($user->roles as $role)
                    <span
                        class="badge bg-primary me-1"
                        >{{ ucfirst($role->name) }}</span
                    >
                    @endforeach @else
                    <span class="text-muted">No roles assigned</span>
                    @endif
                </td>
                <td>
                    <a
                        href="{{ route('dashboard.users.edit', $user->id) }}"
                        class="btn btn-sm btn-primary"
                    >
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">
        Create New User
    </a>
</div>
