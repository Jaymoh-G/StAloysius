<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class Scholarships extends Component
{
    public $scholarshipPage;
    public $debugInfo = [];

    public function mount()
    {
        // Try different variations of the page name
        $this->scholarshipPage = StaticPage::where('page_name', 'Scholarships')->first();

        if (!$this->scholarshipPage) {
            $this->scholarshipPage = StaticPage::where('page_name', 'Scholarships Page')->first();
        }

        if (!$this->scholarshipPage) {
            $this->scholarshipPage = StaticPage::where('slug', 'scholarships-page')->first();
        }

        // Debug information
        $this->debugInfo = [
            'page_found' => $this->scholarshipPage ? true : false,
            'page_name' => $this->scholarshipPage ? $this->scholarshipPage->page_name : 'Not found',
            'page_id' => $this->scholarshipPage ? $this->scholarshipPage->id : null,
            'total_images' => $this->scholarshipPage ? $this->scholarshipPage->images()->count() : 0,
            'all_pages' => StaticPage::all(['id', 'page_name', 'title'])->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.frontend.scholarships');
    }
}
