<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Blade directive to check if user has permission
        Blade::if('permission', function ($permission) {
            return Auth::user()?->hasPermissionTo($permission) ?? false;
        });

        // Blade directive to check if user can view a module
        Blade::if('canView', function ($module) {
            return Auth::user()?->hasPermissionTo("view {$module}") ?? false;
        });

        // Blade directive to check if user can create in a module
        Blade::if('canCreate', function ($module) {
            return Auth::user()?->hasPermissionTo("create {$module}") ?? false;
        });

        // Blade directive to check if user can edit in a module
        Blade::if('canEdit', function ($module) {
            return Auth::user()?->hasPermissionTo("edit {$module}") ?? false;
        });

        // Blade directive to check if user can delete in a module
        Blade::if('canDelete', function ($module) {
            return Auth::user()?->hasPermissionTo("delete {$module}") ?? false;
        });

        // Blade directive to check if user can publish in a module
        Blade::if('canPublish', function ($module) {
            return Auth::user()?->hasPermissionTo("publish {$module}") ?? false;
        });

        // Blade directive to check if user can approve in a module
        Blade::if('canApprove', function ($module) {
            return Auth::user()?->hasPermissionTo("approve {$module}") ?? false;
        });

        // Blade directive to check if user can upload in a module
        Blade::if('canUpload', function ($module) {
            return Auth::user()?->hasPermissionTo("upload {$module}") ?? false;
        });

        // Blade directive to check if user has any role
        Blade::if('hasRole', function ($role) {
            return Auth::user()?->hasRole($role) ?? false;
        });

        // Blade directive to check if user has any of the given roles
        Blade::if('hasAnyRole', function ($roles) {
            return Auth::user()?->hasAnyRole($roles) ?? false;
        });
    }
}
