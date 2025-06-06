<?php

namespace App\Livewire\Frontend;

use App\Models\JobVacancy;
use Livewire\Component;

class CareerDetail extends Component
{
    public $job;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->job = JobVacancy::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.career-detail');
    }
}