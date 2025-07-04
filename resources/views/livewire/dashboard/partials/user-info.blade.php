@if(auth()->check())
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-user-circle me-2"></i>
            User Information
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p>
                    <strong>Role:</strong>
                    @foreach(auth()->user()->roles as $role)
                    <span
                        class="badge bg-primary me-1"
                        >{{ ucfirst($role->name) }}</span
                    >
                    @endforeach
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Inherited Permissions:</strong></p>
                <div class="small">
                    @php $permissions =
                    auth()->user()->getAllPermissions()->pluck('name')->take(5);
                    @endphp @foreach($permissions as $permission)
                    <span class="badge bg-secondary me-1 mb-1">{{
                        $permission
                    }}</span>
                    @endforeach @if(auth()->user()->getAllPermissions()->count()
                    > 5)
                    <span class="text-muted"
                        >+{{ auth()->user()->getAllPermissions()->count() - 5 }}
                        more</span
                    >
                    @endif
                </div>
                <small class="text-muted"
                    >Permissions are inherited through roles</small
                >
            </div>
        </div>

        @hasRole('super admin')
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Super Admin Role:</strong> You have full system access
            including role and permission management.
        </div>
        @endhasRole @hasRole('admin')
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Admin Role:</strong> You can manage users and all content
            modules.
        </div>
        @endhasRole @hasRole('editor')
        <div class="alert alert-success mt-3">
            <i class="fas fa-edit me-2"></i>
            <strong>Editor Role:</strong> You can create, edit, and publish
            content.
        </div>
        @endhasRole @hasRole('user')
        <div class="alert alert-secondary mt-3">
            <i class="fas fa-eye me-2"></i>
            <strong>User Role:</strong> You have view-only access to public
            content.
        </div>
        @endhasRole
    </div>
</div>
@endif
