<?php

namespace App\Livewire\Dashboard\Careers;

use App\Models\JobVacancy;
use Livewire\Component;
use Livewire\WithPagination;

class JobVacancyIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        JobVacancy::findOrFail($id)->delete();
        session()->flash('message', 'Job vacancy deleted successfully!');
    }

    public function render()
    {
        $jobs = JobVacancy::when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.careers.job-vacancy-index', [
            'jobs' => $jobs
        ])->layout('components.layouts.dashboard');
    }
}
