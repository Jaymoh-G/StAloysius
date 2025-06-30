<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class AboutUs extends Component
{
    public $aboutUsPage;
    public $debugInfo = [];

    public function mount()
    {
        // Try different variations of the page name
        $this->aboutUsPage = StaticPage::where('page_name', 'About Us')->first();

        if (!$this->aboutUsPage) {
            $this->aboutUsPage = StaticPage::where('page_name', 'About Us Page')->first();
        }

        if (!$this->aboutUsPage) {
            $this->aboutUsPage = StaticPage::where('slug', 'about-us-page')->first();
        }

   
    }

    public function render()
    {
        return view('livewire.frontend.about-us');
    }
}
