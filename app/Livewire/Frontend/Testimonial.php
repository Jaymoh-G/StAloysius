<?php

namespace App\Livewire\Frontend;

use App\Models\Testimonial as TestimonialModel;
use Livewire\Component;

class Testimonial extends Component
{
    public $testimonial;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->testimonial = TestimonialModel::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $relatedTestimonials = TestimonialModel::where('type', $this->testimonial->type)
            ->where('id', '!=', $this->testimonial->id)
            ->take(3)
            ->get();

        return view('livewire.frontend.testimonial', [
            'testimonial' => $this->testimonial,
            'relatedTestimonials' => $relatedTestimonials
        ]);
    }
}
