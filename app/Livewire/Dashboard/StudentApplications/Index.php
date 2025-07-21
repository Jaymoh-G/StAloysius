<?php

namespace App\Livewire\Dashboard\StudentApplications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentApplication;

class Index extends Component
{
    use WithPagination;
    public $perPage = 10;

    public function render()
    {
        $applications = StudentApplication::orderByDesc('created_at')->paginate($this->perPage);
        return view('livewire.dashboard.student-applications.index', [
            'applications' => $applications
        ])->layout('components.layouts.dashboard');
    }
}
