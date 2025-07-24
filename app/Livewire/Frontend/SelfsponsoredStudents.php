<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;

class SelfsponsoredStudents extends Component
{
    public $selfsponsoredStudents;
    public $images;

    protected $listeners = ['staticPageUpdated' => 'reloadData'];

    public function mount()
    {
        $this->reloadData();
    }

    public function reloadData()
    {
        $this->selfsponsoredStudents = \App\Models\StaticPage::with('images')->where('page_name', 'Self-Sponsored Students')->first();

        if (!$this->selfsponsoredStudents) {
            $this->selfsponsoredStudents = \App\Models\StaticPage::with('images')->where('page_name', 'Self-Sponsored Students Page')->first();
        }

        if (!$this->selfsponsoredStudents) {
            $this->selfsponsoredStudents = \App\Models\StaticPage::with('images')->where('page_name', 'self sponsored students')->first();
        }

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
