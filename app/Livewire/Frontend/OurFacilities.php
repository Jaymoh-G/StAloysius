<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\FacilityModel;

class OurFacilities extends Component
{
    public function render()
    {
        $facilities = FacilityModel::with(['department', 'images' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->orderBy('updated_at', 'desc')->get();

        return view('livewire.frontend.our-facilities', [
            'facilities' => $facilities
        ]);
    }
}
