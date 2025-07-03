<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Form extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $roles = [];
    public $permissions = [];
    public $allRoles;
    public $allPermissions;

    public function mount($user = null)
    {
        $this->allRoles = Role::all();
        $this->allPermissions = Permission::all();
        if ($user) {
            $user = User::findOrFail($user);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->roles = $user->roles->pluck('name')->toArray();
            $this->permissions = $user->permissions->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                // Only update password if provided
                'password' => $this->password ? bcrypt($this->password) : $user->password,
            ]);
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }
        $user->syncRoles($this->roles);
        $user->syncPermissions($this->permissions);
        session()->flash('success', 'User saved successfully!');
        return redirect()->route('dashboard.users.index');
    }

    public function render()
    {
        return view('livewire.dashboard.users.form')->layout('components.layouts.dashboard');
    }
}
