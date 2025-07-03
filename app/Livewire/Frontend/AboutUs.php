<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;
use App\Models\YoutubeVideo;

class AboutUs extends Component
{
    public $aboutUsPage;
    public $debugInfo = [];
    public $featuredVideo;

    public function mount()
    {
        // Try different variations of the page name
        $this->aboutUsPage = StaticPage::with('images')->where('page_name', 'About Us')->first();

        if (!$this->aboutUsPage) {
            $this->aboutUsPage = StaticPage::with('images')->where('page_name', 'About Us Page')->first();
        }

        if (!$this->aboutUsPage) {
            $this->aboutUsPage = StaticPage::with('images')->where('slug', 'about-us-page')->first();
        }



        // Fetch the YouTube video with order 2
        $this->featuredVideo = YoutubeVideo::where('order', 2)->first();
    }

    public function render()
    {
        return view('livewire.frontend.about-us');
    }
}
