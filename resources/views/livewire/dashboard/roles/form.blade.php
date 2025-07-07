<div class="container mt-4">
    <h2>{{ $roleId ? "Edit Role" : "Create Role" }}</h2>

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input
                type="text"
                class="form-control"
                wire:model.defer="name"
                required
            />
            @error('name')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($groupedPermissions as $module => $permissions)
                <div class="col-md-2 mb-2">
                    <div class="card h-100">
                        <div class="card-header bg-light fw-bold">
                            @if($module === 'blog') News @else
                            {{ ucfirst(str_replace("_", " ", $module)) }}
                            @endif
                        </div>
                        <div class="card-body">
                            @foreach($permissions as $perm)
                            <div class="form-check mb-1">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    wire:model="selectedPermissions"
                                    value="{{ $perm['name'] }}"
                                    id="perm_{{ $perm['id'] }}"
                                />
                                <label
                                    class="form-check-label"
                                    for="perm_{{ $perm['id'] }}"
                                >
                                    {{ ucfirst($perm["action"]) }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Role</button>
        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary"
            >Cancel</a
        >
    </form>
</div>
