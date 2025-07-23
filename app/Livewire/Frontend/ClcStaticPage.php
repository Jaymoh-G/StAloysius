<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class ClcStaticPage extends Component
{
    public $clcPage;
    public $images;

    public function mount()
    {
        // Try different variations of the page name, eager loading images
        $this->clcPage = StaticPage::with('images')->where('page_name', 'Christian Life Community')->first();

        if (!$this->clcPage) {
            $this->clcPage = StaticPage::with('images')->where('page_name', 'Christian Life Community Page')->first();
        }

        if (!$this->clcPage) {
            $this->clcPage = StaticPage::with('images')->where('page_name', 'clc')->first();
        }

        $this->images = $this->clcPage ? $this->clcPage->images : collect();
    }

    public function render()
    {
        return view('livewire.frontend.clc-static-page', [
            'clcPage' => $this->clcPage,
            'images' => $this->images,
        ]);
    }
}
