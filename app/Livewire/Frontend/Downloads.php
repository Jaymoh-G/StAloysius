<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Download;

class Downloads extends Component
{
    use WithPagination;

    public $category = '';
    public $perPage = 12;

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Download::where('is_active', true);
        if ($this->category) {
            $query->where('category', $this->category);
        }
        $downloads = $query->orderByDesc('created_at')->paginate($this->perPage);
        $categories = [
            'admissions' => 'Admissions',
            'exams_results' => 'Exams & Results',
            'forms' => 'Forms',
            'jobs' => 'Jobs',
            'financials' => 'Financials',
            'reports' => 'Reports',
        ];
        return view('livewire.frontend.downloads', [
            'downloads' => $downloads,
            'categories' => $categories,
        ]);
    }
}
