<?php

namespace App\Livewire\Dashboard\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);

        // Don't allow deletion of system roles
        if (in_array($role->name, ['super admin', 'admin', 'editor', 'user'])) {
            session()->flash('error', 'Cannot delete system roles.');
            return;
        }

        $role->delete();
        session()->flash('success', 'Role deleted successfully!');
    }

    public function render()
    {
        $roles = Role::with('permissions')->get();

        return view('livewire.dashboard.roles.index', [
            'roles' => $roles
        ])->layout('components.layouts.dashboard');
    }
}
