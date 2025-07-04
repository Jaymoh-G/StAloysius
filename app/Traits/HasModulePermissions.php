<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasModulePermissions
{
    /**
     * Check if the current user has a specific permission through their roles
     */
    public function hasPermission(string $permission): bool
    {
        return Auth::user()?->hasPermissionTo($permission) ?? false;
    }

    /**
     * Check if the current user can view a module through their roles
     */
    public function canView(string $module): bool
    {
        return $this->hasPermission("view {$module}");
    }

    /**
     * Check if the current user can create in a module through their roles
     */
    public function canCreate(string $module): bool
    {
        return $this->hasPermission("create {$module}");
    }

    /**
     * Check if the current user can edit in a module through their roles
     */
    public function canEdit(string $module): bool
    {
        return $this->hasPermission("edit {$module}");
    }

    /**
     * Check if the current user can delete in a module through their roles
     */
    public function canDelete(string $module): bool
    {
        return $this->hasPermission("delete {$module}");
    }

    /**
     * Check if the current user can publish in a module through their roles
     */
    public function canPublish(string $module): bool
    {
        return $this->hasPermission("publish {$module}");
    }

    /**
     * Check if the current user can approve in a module through their roles
     */
    public function canApprove(string $module): bool
    {
        return $this->hasPermission("approve {$module}");
    }

    /**
     * Check if the current user can upload in a module through their roles
     */
    public function canUpload(string $module): bool
    {
        return $this->hasPermission("upload {$module}");
    }

    /**
     * Check if the current user can generate reports through their roles
     */
    public function canGenerateReports(): bool
    {
        return $this->hasPermission("generate reports");
    }

    /**
     * Check if the current user can export reports through their roles
     */
    public function canExportReports(): bool
    {
        return $this->hasPermission("export reports");
    }

    /**
     * Get all permissions for a specific module through user's roles
     */
    public function getModulePermissions(string $module): array
    {
        $user = Auth::user();
        if (!$user) {
            return [];
        }

        $permissions = [];
        $actions = ['view', 'create', 'edit', 'delete', 'publish', 'approve', 'upload'];

        foreach ($actions as $action) {
            $permissionName = "{$action} {$module}";
            if ($user->hasPermissionTo($permissionName)) {
                $permissions[] = $action;
            }
        }

        return $permissions;
    }

    /**
     * Get user's roles
     */
    public function getUserRoles(): array
    {
        $user = Auth::user();
        if (!$user) {
            return [];
        }

        return $user->roles->pluck('name')->toArray();
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return Auth::user()?->hasRole($role) ?? false;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return Auth::user()?->hasAnyRole($roles) ?? false;
    }

    /**
     * Get all permissions the user has through their roles
     */
    public function getAllUserPermissions(): array
    {
        $user = Auth::user();
        if (!$user) {
            return [];
        }

        return $user->getAllPermissions()->pluck('name')->toArray();
    }
}
