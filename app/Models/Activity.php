<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'subject_type',
        'subject_id',
        'properties',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    /**
     * Get the user that performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject model (polymorphic relationship)
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get action color for timeline display
     */
    public function getActionColorAttribute(): string
    {
        switch ($this->action) {
            case 'create':
                return 'success';
            case 'update':
                return 'primary';
            case 'delete':
                return 'danger';
            case 'login':
                return 'info';
            case 'logout':
                return 'warning';
            case 'publish':
                return 'success';
            case 'unpublish':
                return 'warning';
            case 'upload':
                return 'info';
            default:
                return 'secondary';
        }
    }

    /**
     * Get action icon for timeline display
     */
    public function getActionIconAttribute(): string
    {
        switch ($this->action) {
            case 'create':
                return 'fas fa-plus-circle';
            case 'update':
                return 'fas fa-edit';
            case 'delete':
                return 'fas fa-trash';
            case 'login':
                return 'fas fa-sign-in-alt';
            case 'logout':
                return 'fas fa-sign-out-alt';
            case 'publish':
                return 'fas fa-check-circle';
            case 'unpublish':
                return 'fas fa-times-circle';
            case 'upload':
                return 'fas fa-upload';
            default:
                return 'fas fa-circle';
        }
    }

    /**
     * Get module display name
     */
    public function getModuleDisplayNameAttribute(): string
    {
        switch ($this->module) {
            case 'blog':
                return 'News';
            case 'events':
                return 'Events';
            case 'gallery':
                return 'Gallery';
            case 'youtube':
                return 'YouTube';
            case 'careers':
                return 'Careers';
            case 'testimonials':
                return 'Testimonials';
            case 'departments':
                return 'Departments';
            case 'facilities':
                return 'Facilities';
            case 'team':
                return 'Team';
            case 'static_pages':
                return 'Static Pages';
            case 'users':
                return 'Users';
            case 'roles':
                return 'Roles';
            case 'permissions':
                return 'Permissions';
            case 'auth':
                return 'System';
            default:
                return ucfirst($this->module);
        }
    }
}
