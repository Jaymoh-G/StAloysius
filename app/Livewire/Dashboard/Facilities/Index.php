<?php

namespace App\Livewire\Dashboard\Facilities;

use Livewire\Component;
use App\Models\FacilityModel;

class Index extends Component
{
    public $facilityIdToDelete;
    protected $listeners = ['confirmDelete'];

    public function deleteFacility($facilityId)
    {
        $this->facilityIdToDelete = $facilityId;
        $this->dispatch('confirmDelete', id: $facilityId);
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            FacilityModel::find($id)?->delete();
            session()->flash('message', 'Facility deleted successfully!');
        }
    }

    public function render()
    {
        $facilities = FacilityModel::with(['department', 'images' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.dashboard.facilities.index', compact('facilities'))->layout('components.layouts.dashboard');
    }
}
