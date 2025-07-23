<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class SchoolOfHopePage extends Component
{
    public $schoolOfHopePage;
    public $images;

    public function mount()
    {
        // Try different variations of the page name, eager loading images
        $this->schoolOfHopePage = StaticPage::with('images')->where('page_name', 'School of Hope Page')->first();

        if (!$this->schoolOfHopePage) {
            $this->schoolOfHopePage = StaticPage::with('images')->where('page_name', 'School of Hope')->first();
        }

        if (!$this->schoolOfHopePage) {
            $this->schoolOfHopePage = StaticPage::with('images')->where('page_name', 'school of hope')->first();
        }

        $this->images = $this->schoolOfHopePage ? $this->schoolOfHopePage->images : collect();
    }

    public function render()
    {
        return view('livewire.frontend.school-of-hope-page', [
            'schoolOfHopePage' => $this->schoolOfHopePage,
            'images' => $this->images,
        ]);
    }
}
