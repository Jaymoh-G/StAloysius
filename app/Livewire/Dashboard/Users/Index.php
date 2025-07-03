<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $users;
    public $roles;
    public $permissions;

    protected $listeners = [
        'toggleRole' => 'toggleRole',
        'togglePermission' => 'togglePermission',
    ];

    public function mount()
    {
        $this->users = User::with(['roles', 'permissions'])->get();
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.dashboard.users.index', [
            'users' => $this->users,
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ])->layout('components.layouts.dashboard');
    }

    public function toggleRole($userId, $roleName)
    {
        $user = User::findOrFail($userId);
        if ($user->hasRole($roleName)) {
            $user->removeRole($roleName);
        } else {
            $user->assignRole($roleName);
        }
        $this->users = User::with(['roles', 'permissions'])->get();
    }

    public function togglePermission($userId, $permissionName)
    {
        $user = User::findOrFail($userId);
        if ($user->hasPermissionTo($permissionName)) {
            $user->revokePermissionTo($permissionName);
        } else {
            $user->givePermissionTo($permissionName);
        }
        $this->users = User::with(['roles', 'permissions'])->get();
    }
}
