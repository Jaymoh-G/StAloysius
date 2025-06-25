<?php

namespace App\Livewire\Dashboard\Testimonials;

use Storage;
use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['testimonialUpdated' => '$refresh'];

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            \Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        session()->flash('message', 'Testimonial deleted successfully!');
    }

    public function render()
    {
        $testimonials = Testimonial::latest()->paginate(10);

        return view('livewire.dashboard.testimonials.index', compact('testimonials'))
            ->layout('components.layouts.dashboard');
    }
}
