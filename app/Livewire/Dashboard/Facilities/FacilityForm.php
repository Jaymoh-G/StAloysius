<?php

namespace App\Livewire\Dashboard\Facilities;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Facility;
/**
 * @method \Illuminate\View\View layout(string $layout)
 */
class FacilityForm extends Component
{
    use WithFileUploads;

    public $facilityId;
    public $title, $slug, $description;
    public $images = [];
    public $title_1, $paragraph_1;
    public $title_2, $paragraph_2;
    public $title_3, $paragraph_3;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|unique:facilities,slug',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|max:2048',
        'title_1' => 'nullable|string|max:255',
        'paragraph_1' => 'nullable|string',
        'title_2' => 'nullable|string|max:255',
        'paragraph_2' => 'nullable|string',
        'title_3' => 'nullable|string|max:255',
        'paragraph_3' => 'nullable|string',
    ];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        $imagePaths = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                $imagePaths[] = $image->store('facilities', 'public');
            }
        }

        Facility::updateOrCreate(
            ['id' => $this->facilityId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'images' => json_encode($imagePaths),
                'title_1' => $this->title_1,
                'paragraph_1' => $this->paragraph_1,
                'title_2' => $this->title_2,
                'paragraph_2' => $this->paragraph_2,
                'title_3' => $this->title_3,
                'paragraph_3' => $this->paragraph_3,
            ]
        );

        session()->flash('message', 'Facility saved successfully!');
        return redirect()->route('facilities.index'); // Adjust if needed
    }

    public function render()
    {
        return view('livewire.dashboard.facilities.facility-form')->layout('components.layouts.dashboard');
    }
}
