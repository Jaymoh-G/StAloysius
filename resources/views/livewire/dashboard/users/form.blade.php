<div class="container mt-4">
    <h2>{{ $userId ? "Edit User" : "Create User" }}</h2>
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session("success") }}</div>
    @endif
    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                id="name"
                class="form-control"
                wire:model.defer="name"
                required
            />
            @error('name')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                id="email"
                class="form-control"
                wire:model.defer="email"
                required
            />
            @error('email')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"
                >Password
                {{ $userId ? "(leave blank to keep current)" : "" }}</label
            >
            <input type="password" id="password" class="form-control"
            wire:model.defer="password" {{ $userId ? "" : "required" }}>
            @error('password')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Roles</label>
            <div class="row">
                @foreach($allRoles as $role)
                <div class="col-md-3">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value="{{ $role->name }}"
                            wire:model="roles"
                            id="role_{{ $role->id }}"
                        />
                        <label
                            class="form-check-label"
                            for="role_{{ $role->id }}"
                            >{{ $role->name }}</label
                        >
                    </div>
                </div>
                @endforeach
            </div>
            @error('roles')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary"
            >Cancel</a
        >
    </form>
</div>
