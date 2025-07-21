<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Services\ActivityService;
use App\Traits\HasModulePermissions;

class RecentActivity extends Component
{
    use HasModulePermissions;

    public $activities = [];
    public $filter = 'all'; // all, today, week, month
    public $moduleFilter = 'all';

    public function mount()
    {
        $this->loadActivities();
    }

    public function loadActivities()
    {
        $query = \App\Models\Activity::with('user')
            ->orderBy('created_at', 'desc');

        // Apply time filter
        switch ($this->filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                break;
        }

        // Apply module filter
        if ($this->moduleFilter !== 'all') {
            $query->where('module', $this->moduleFilter);
        }

        $this->activities = $query->limit(9)->get();
    }

    public function updatedFilter()
    {
        $this->loadActivities();
    }

    public function updatedModuleFilter()
    {
        $this->loadActivities();
    }

    public function getAvailableModules()
    {
        $modules = [
            'blog' => 'News',
            'events' => 'Events',
            'gallery' => 'Gallery',
            'youtube' => 'YouTube',
            'careers' => 'Careers',
            'testimonials' => 'Testimonials',
            'departments' => 'Departments',
            'facilities' => 'Facilities',
            'team' => 'Team',
            'static_pages' => 'Static Pages',
            'users' => 'Users',
            'roles' => 'Roles',
            'permissions' => 'Permissions',
            'auth' => 'System',
        ];

        // Only show modules the user has permission to view
        // Auth module doesn't need view permission - it's always available
        return array_filter($modules, function ($displayName, $module) {
            if ($module === 'auth') {
                return true; // Always show auth module
            }
            return $this->canView($module);
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getTimeAgo($datetime)
    {
        $now = now();
        $diff = $now->diff($datetime);

        if ($diff->y > 0) {
            return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
        } elseif ($diff->m > 0) {
            return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
        } elseif ($diff->d > 0) {
            return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->i > 0) {
            return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
        } else {
            return 'Just now';
        }
    }

    public function render()
    {
        return view('livewire.dashboard.recent-activity', [
            'availableModules' => $this->getAvailableModules(),
        ]);
    }
}
