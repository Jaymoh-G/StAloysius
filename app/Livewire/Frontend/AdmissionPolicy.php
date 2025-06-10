<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class AdmissionPolicy extends Component
{
    public $admissionPolicy;

    // display content from database, from static page table, page_name = Admission Policy
    public function mount()
    {
        $this->admissionPolicy = StaticPage::where('page_name', 'Admissions Policy')->first();
    }

    public function render()
    {
        return view('livewire.frontend.admission-policy');
    }
}
