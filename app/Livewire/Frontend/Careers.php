<?php

namespace App\Livewire\Frontend;

use App\Models\JobVacancy;
use App\Models\JobCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Careers extends Component
{
    use WithPagination;

    public $categoryFilter = '';
    protected $paginationTheme = 'bootstrap';

    public function mount($category = null)
    {
        if ($category) {
            $this->categoryFilter = $category;
        }
        // Add debug log
        logger("Careers mount: category={$category}, categoryFilter={$this->categoryFilter}");
    }

    public function filterByCategory($categorySlug)
    {
        $this->categoryFilter = $categorySlug;
        $this->resetPage();

        // Add debug log
        logger("filterByCategory called with: {$categorySlug}");

        // Update URL without full page reload
        $url = route('careers', ['category' => $categorySlug]);
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function resetFilter()
    {
        $this->categoryFilter = '';
        $this->resetPage();

        // Update URL without full page reload
        $url = route('careers');
        $this->dispatch('urlChanged', ['url' => $url]);
    }

    public function render()
    {
        $query = JobVacancy::where('is_active', true)
            ->where('deadline', '>=', now());

        if ($this->categoryFilter) {
            // Find category by slug
            $category = JobCategory::where('slug', $this->categoryFilter)->first();
            if ($category) {
                $query->where('job_category_id', $category->id);
            }
        }

        $jobs = $query->latest()->paginate(10);
        $categories = JobCategory::has('vacancies')->get();

        // Add detailed debug info
        $debug = "CategoryFilter: '{$this->categoryFilter}', ";
        $debug .= "Categories: " . $categories->count() . ", ";
        $debug .= "Jobs: " . $jobs->count();

        return view('livewire.frontend.careers', [
            'jobs' => $jobs,
            'categories' => $categories,
            'debug' => $debug
        ]);
    }
}







