<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class HowToApply extends Component
{
    public $howToApply;

    public function mount()
    {
        $this->howToApply = StaticPage::where('page_name', 'How to Apply')->first();
    }

    public function render()
    {
        return view('livewire.frontend.how-to-apply');
    }
}
