<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\FacilityModel;

class Facility extends Component
{
    public $facility;
    public $slug;
    public $otherFacilities;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->facility = FacilityModel::with(['department', 'images' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->where('slug', $slug)->firstOrFail();

        // Get all facilities
        $this->otherFacilities = FacilityModel::all();

    }

    public function render()
    {
        return view('livewire.frontend.facility', [
            'facility' => $this->facility,
            'otherFacilities' => $this->otherFacilities
        ]);
    }
}
