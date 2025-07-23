<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class SelfsponsoredStudents extends Component
{
    public $selfsponsoredStudents;
    public $images;

    public function mount()
    {
        // Try different variations of the page name, eager loading images
        $this->selfsponsoredStudents = StaticPage::with('images')->where('page_name', 'Self-Sponsored Students')->first();

        if (!$this->selfsponsoredStudents) {
            $this->selfsponsoredStudents = StaticPage::with('images')->where('page_name', 'Self-Sponsored Students Page')->first();
        }

        if (!$this->selfsponsoredStudents) {
            $this->selfsponsoredStudents = StaticPage::with('images')->where('page_name', 'self sponsored students')->first();
        }

        // Store images collection for easier access in the Blade view
        $this->images = $this->selfsponsoredStudents ? $this->selfsponsoredStudents->images : collect();
    }

    public function render()
    {
        return view('livewire.frontend.selfsponsored-students', [
            'selfsponsoredStudents' => $this->selfsponsoredStudents,
            'images' => $this->images,
        ]);
    }
}
