<?php

namespace App\Livewire\Frontend;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class Testimonials extends Component
{
    use WithPagination;

    public $typeFilter = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Testimonial::orderBy('created_at', 'desc');

        if ($this->typeFilter) {
            $query->where('type', $this->typeFilter);
        }

        $testimonials = $query->paginate(12);
        $types = Testimonial::distinct()->pluck('type')->filter();

        return view('livewire.frontend.testimonials', [
            'testimonials' => $testimonials,
            'types' => $types
        ]);
    }

    public function filterByType($type)
    {
        $this->typeFilter = $type;
        $this->resetPage();
    }

    public function clearFilter()
    {
        $this->typeFilter = '';
        $this->resetPage();
    }
}
