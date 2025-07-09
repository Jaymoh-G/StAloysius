<?php

namespace App\Livewire\Dashboard\Donations;

use App\Models\Donation;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $typeFilter = '';
    public $selectedDonation = null;
    public $showStatusModal = false;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function updateStatus($donationId, $status)
    {
        $donation = Donation::findOrFail($donationId);
        $donation->update(['status' => $status]);

        session()->flash('message', 'Donation status updated successfully!');
    }

    public function deleteDonation($donationId)
    {
        $donation = Donation::findOrFail($donationId);
        $donation->delete();

        session()->flash('message', 'Donation deleted successfully!');
    }

    public function render()
    {
        $query = Donation::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('reference', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->typeFilter) {
            $query->where('donation_type', $this->typeFilter);
        }

        $donations = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalDonations = Donation::count();
        $totalAmount = Donation::sum('amount');
        $pendingDonations = Donation::where('status', 'pending')->count();
        $completedDonations = Donation::where('status', 'completed')->count();

        return view('livewire.dashboard.donations.index', [
            'donations' => $donations,
            'totalDonations' => $totalDonations,
            'totalAmount' => $totalAmount,
            'pendingDonations' => $pendingDonations,
            'completedDonations' => $completedDonations,
        ])->layout('components.layouts.dashboard');
    }
}
