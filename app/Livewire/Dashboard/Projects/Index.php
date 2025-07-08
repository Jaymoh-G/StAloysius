<?php

namespace App\Livewire\Dashboard\Projects;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $priorityFilter = '';
    public $featuredFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'priorityFilter' => ['except' => ''],
        'featuredFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPriorityFilter()
    {
        $this->resetPage();
    }

    public function updatingFeaturedFilter()
    {
        $this->resetPage();
    }

    public function toggleFeatured($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->update(['is_featured' => !$project->is_featured]);
        session()->flash('success', 'Project featured status updated successfully!');
    }

    public function togglePublished($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->update(['is_published' => !$project->is_published]);
        session()->flash('success', 'Project published status updated successfully!');
    }

    public function deleteProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->delete();
        session()->flash('success', 'Project deleted successfully!');
    }

    public function render()
    {
        $query = Project::query()
            ->with(['featuredImage']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('client_name', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->priorityFilter) {
            $query->where('priority', $this->priorityFilter);
        }

        if ($this->featuredFilter !== '') {
            $query->where('is_featured', $this->featuredFilter);
        }

        $projects = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.dashboard.projects.index', [
            'projects' => $projects,
        ])->layout('components.layouts.dashboard');
    }
}
