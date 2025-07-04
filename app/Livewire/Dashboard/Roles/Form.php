<?php

namespace App\Livewire\Dashboard\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class Form extends Component
{
    public $roleId;
    public $name = '';
    public $selectedPermissions = [];
    public $allPermissions = [];
    public $groupedPermissions = [];

    public function mount($role = null)
    {
        $this->roleId = $role;
        $this->allPermissions = Permission::all();
        $this->groupPermissions();

        if ($role) {
            $roleModel = Role::with('permissions')->findOrFail($role);
            $this->name = $roleModel->name;
            $this->selectedPermissions = $roleModel->permissions->pluck('name')->toArray();

            // Debug: Log the selected permissions
            Log::info('Role permissions loaded:', [
                'role_id' => $role,
                'role_name' => $roleModel->name,
                'selected_permissions' => $this->selectedPermissions
            ]);
        }
    }

    public function groupPermissions()
    {
        $grouped = [];
        foreach ($this->allPermissions as $permission) {
            $parts = explode(' ', $permission->name, 2);
            if (count($parts) === 2) {
                [$action, $module] = $parts;
                $grouped[$module][] = [
                    'name' => $permission->name,
                    'action' => $action,
                    'id' => $permission->id,
                ];
            }
        }
        ksort($grouped);
        $this->groupedPermissions = $grouped;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = $this->roleId
            ? Role::findOrFail($this->roleId)
            : Role::create(['name' => $this->name]);

        if ($role->name !== $this->name) {
            $role->name = $this->name;
            $role->save();
        }

        $role->syncPermissions($this->selectedPermissions);

        session()->flash('success', 'Role saved successfully!');
        return redirect()->route('dashboard.roles.index');
    }

    public function render()
    {
        return view('livewire.dashboard.roles.form')->layout('components.layouts.dashboard');
    }
}
