<?php

namespace App\Livewire\Dashboard\Testimonials;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads;

    public $name, $type, $testimony, $rating = 5, $image, $existingImage, $testimonialId;


    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:testimonials,name,' . $this->testimonialId,
            'type' => 'required|string',
            'testimony' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',


            'image' => $this->testimonialId ? 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048' : 'required|image|mimes:png,jpg,jpeg,webp|max:2048',

        ];
    }

    public function mount($testimonialId = null)
    {
        if ($testimonialId) {
            $this->testimonialId = $testimonialId;
            $testimonial = Testimonial::findOrFail($testimonialId);

            $this->name = $testimonial->name;
            $this->type = $testimonial->type;
            $this->testimony = $testimonial->testimony;
            $this->rating = $testimonial->rating;
            $this->existingImage = $testimonial->image;
        }
    }

    public function submit()
    {
        $this->validate($this->rules());

        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'testimony' => $this->testimony,
            'rating' => $this->rating,
        ];

        if ($this->image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $imagePath = $this->image->store('testimonials', 'public');
            $data['image'] = $imagePath;
        }

        if ($this->testimonialId) {
            Testimonial::findOrFail($this->testimonialId)->update($data);
            session()->flash('message', 'Testimonial updated successfully!');
        } else {
            Testimonial::create($data);
            session()->flash('message', 'Testimonial created successfully!');
        }

        return redirect()->route('dashboard.testimonials.index');
    }
    public function deleteImage()
    {
        if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
            Storage::disk('public')->delete($this->existingImage);
            $this->existingImage = null;
        }

        $this->image = null;
    }

    public function delete()
    {
        if ($this->testimonialId) {
            $testimonial = Testimonial::findOrFail($this->testimonialId);
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->delete();
            session()->flash('message', 'Testimonial deleted successfully.');
        }

        return redirect()->route('dashboard.testimonials.index');
    }

    public function render()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.dashboard.testimonials.manage', compact('testimonials'))->layout('components.layouts.dashboard');
    }
}
