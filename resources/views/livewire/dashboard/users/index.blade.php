

<div class="container mt-4">
    <h2>User Management</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    wire:change="$emit('toggleRole', {{ $user->id }}, '{{ $role->name }}')"
                                    {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    wire:change="$emit('togglePermission', {{ $user->id }}, '{{ $permission->name }}')"
                                    {{ $user->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">Create New User</a>
</div>
