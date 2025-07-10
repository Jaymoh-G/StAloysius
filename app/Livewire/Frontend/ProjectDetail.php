<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;

class ProjectDetail extends Component
{
    public $slug;
    public $project;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->project = Project::with(['featuredImage', 'images', 'department'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.project-detail', [
            'project' => $this->project
        ]);
    }
}
