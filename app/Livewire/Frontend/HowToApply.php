<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class HowToApply extends Component

{
    public $howToApply;
    public $debugInfo = [];

    public function mount()
    {
        // Try different variations of the page name
        $this->howToApply = StaticPage::where('page_name', 'How To Apply')->first();

        if (!$this->howToApply) {
            $this->howToApply = StaticPage::where('page_name', 'How to Apply Page')->first();
        }

        if (!$this->howToApply) {
            $this->howToApply = StaticPage::where('slug', 'how-to-apply-page')->first();
        }
        if (!$this->howToApply) {
            $this->howToApply = StaticPage::where('page_name', 'How To Apply')->first();
        }

        if (!$this->howToApply) {
            $this->howToApply = StaticPage::where('page_name', 'How To Apply')->first();
        }

        if (!$this->howToApply) {
            $this->howToApply = StaticPage::where('slug', 'how-to-apply')->first();
        }



    }

    public function render()
    {
        return view('livewire.frontend.how-to-apply');
    }
}



