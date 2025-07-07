<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HasModulePermissions;

class ActivityIndex extends Component
{
    use HasModulePermissions, WithPagination;

    public $filter = 'all'; // all, today, week, month
    public $moduleFilter = 'all';
    public $search = '';
    public $perPage = 20;
    public $page = 1;

    protected $queryString = [
        'filter' => ['except' => 'all'],
        'moduleFilter' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Check if user has any module permissions (any authenticated user can view activities)
        // This is a system-level feature accessible to all dashboard users
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function updatedModuleFilter()
    {
        $this->resetPage();
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

        return array_filter($modules, function ($displayName, $module) {
            if ($module === 'auth') {
                return true;
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

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('action', 'like', '%' . $this->search . '%')
                    ->orWhere('module', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $activities = $query->paginate($this->perPage);

        return view('livewire.dashboard.activity-index', [
            'activities' => $activities,
            'availableModules' => $this->getAvailableModules(),
        ])->layout('components.layouts.dashboard');
    }
}
