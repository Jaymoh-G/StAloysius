<?php

namespace App\Livewire\Dashboard\VolunteerApplications;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VolunteerApplication;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $selectedApplication = null;
    public $showStatusModal = false;
    public $showEditModal = false;

    // Edit form properties
    public $editName = '';
    public $editEmail = '';
    public $editTel = '';
    public $editSkills = '';
    public $editAdditionalInformation = '';

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

    public function openEditModal($applicationId)
    {
        $this->selectedApplication = VolunteerApplication::find($applicationId);
        if ($this->selectedApplication) {
            $this->editName = $this->selectedApplication->name;
            $this->editEmail = $this->selectedApplication->email;
            $this->editTel = $this->selectedApplication->tel;
            $this->editSkills = $this->selectedApplication->skills;
            $this->editAdditionalInformation = $this->selectedApplication->additional_information;
            $this->showEditModal = true;

            // Debug: Log the action
            Log::info('Edit modal opened for application: ' . $applicationId);
        } else {
            session()->flash('error', 'Application not found.');
        }
    }

    public function closeEditModal()
    {
        $this->selectedApplication = null;
        $this->showEditModal = false;
        $this->resetEditForm();
    }

    public function resetEditForm()
    {
        $this->editName = '';
        $this->editEmail = '';
        $this->editTel = '';
        $this->editSkills = '';
        $this->editAdditionalInformation = '';
    }

    public function updateApplication()
    {
        Log::info('Update application method called');

        $this->validate([
            'editName' => 'required|string|max:255',
            'editEmail' => 'required|email|max:255',
            'editTel' => 'required|string|max:20',
            'editSkills' => 'required|string|max:1000',
            'editAdditionalInformation' => 'nullable|string|max:2000',
        ]);

        if ($this->selectedApplication) {
            Log::info('Updating application: ' . $this->selectedApplication->id);

            $this->selectedApplication->update([
                'name' => trim($this->editName),
                'email' => trim($this->editEmail),
                'tel' => trim($this->editTel),
                'skills' => trim($this->editSkills),
                'additional_information' => trim($this->editAdditionalInformation),
            ]);

            $this->closeEditModal();
            session()->flash('message', 'Application updated successfully.');
            Log::info('Application updated successfully');
        } else {
            Log::error('No selected application found for update');
            session()->flash('error', 'No application selected for update.');
        }
    }

    public function deleteApplication($applicationId)
    {
        $application = VolunteerApplication::find($applicationId);
        if ($application) {
            $application->delete();
            session()->flash('message', 'Application deleted successfully.');
            $this->dispatch('application-deleted');
        } else {
            session()->flash('error', 'Application not found.');
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
        ])->layout('components.layouts.dashboard');
    }
}
