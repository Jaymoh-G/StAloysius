<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class ContactUs extends Component
{
    public $pageData;

    public function mount()
    {
        $this->pageData = StaticPage::where('page_name', 'Contact Us')
            ->orWhere('slug', 'contact-us')
            ->orWhere('title', 'Contact Us')
            ->first();
    }

    public function render()
    {
        return view('livewire.frontend.contact-us', [
            'pageData' => $this->pageData
        ]);
    }
}
