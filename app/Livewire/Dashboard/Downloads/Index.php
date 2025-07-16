<?php

namespace App\Livewire\Dashboard\Downloads;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Download;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $perPage = 10;

    protected $queryString = ['search', 'category'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $download = Download::findOrFail($id);
        $download->delete();
        session()->flash('message', 'Download deleted successfully!');
    }

    public function toggleActive($id)
    {
        $download = Download::findOrFail($id);
        $download->is_active = !$download->is_active;
        $download->save();
    }

    public function render()
    {
        $query = Download::query();
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }
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
        return view('livewire.dashboard.downloads.index', [
            'downloads' => $downloads,
            'categories' => $categories,
        ])->layout('components.layouts.dashboard');
    }
}
