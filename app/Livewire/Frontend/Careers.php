<?php

namespace App\Livewire\Frontend;

use App\Models\JobVacancy;
use App\Models\JobCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Careers extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = JobVacancy::where('is_active', true)
            ->where('deadline', '>=', now());

        if ($this->selectedCategory) {
            $query->where('job_category_id', $this->selectedCategory);
        }

        $jobs = $query->latest()->paginate(10);
        $categories = JobCategory::has('vacancies')->get();

        return view('livewire.frontend.careers', [
            'jobs' => $jobs,
            'categories' => $categories
        ]);
    }
}


