<?php

namespace App\Livewire\Dashboard\VolunteerApplications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VolunteerApplication;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $selectedApplication = null;
    public $showStatusModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function openStatusModal($applicationId)
    {
        $this->selectedApplication = VolunteerApplication::find($applicationId);
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        $this->selectedApplication = null;
        $this->showStatusModal = false;
    }

    public function updateStatus($status)
    {
        if ($this->selectedApplication) {
            $this->selectedApplication->update(['status' => $status]);
            $this->closeStatusModal();
            session()->flash('message', 'Application status updated successfully.');
        }
    }

    public function deleteApplication($applicationId)
    {
        $application = VolunteerApplication::find($applicationId);
        if ($application) {
            $application->delete();
            session()->flash('message', 'Application deleted successfully.');
        }
    }

    public function render()
    {
        $query = VolunteerApplication::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('tel', 'like', '%' . $this->search . '%')
                    ->orWhere('skills', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('livewire.dashboard.volunteer-applications.index', [
            'applications' => $applications
        ]);
    }
}
