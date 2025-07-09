<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class Projects extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $department = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'department' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingDepartment()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Project::where('is_published', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        $projects = $query->paginate(12);

        return view('livewire.frontend.projects', [
            'projects' => $projects
        ]);
    }
}
