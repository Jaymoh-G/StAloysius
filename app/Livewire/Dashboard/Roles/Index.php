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

        // Order roles in specific sequence: user, editor, admin, super admin, then others
        $orderedRoles = $roles->sortBy(function ($role) {
            $order = [
                'user' => 1,
                'editor' => 2,
                'admin' => 3,
                'super admin' => 4
            ];

            return $order[$role->name] ?? 999; // Put other roles at the end
        });

        return view('livewire.dashboard.roles.index', [
            'roles' => $orderedRoles
        ])->layout('components.layouts.dashboard');
    }
}
