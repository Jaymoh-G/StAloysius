<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Log;

class AdmissionPolicy extends Component
{
    public $admissionPolicy;
    

    // display content from database, from static page table, page_name = Admission Policy
    public function mount()
    {
        // Try different variations of the page name
        $this->admissionPolicy = StaticPage::where('page_name', 'Admissions Policy')->first();

        if (!$this->admissionPolicy) {
            $this->admissionPolicy = StaticPage::where('page_name', 'Admission Policy')->first();
        }

        if (!$this->admissionPolicy) {
            $this->admissionPolicy = StaticPage::where('page_name', 'Admission')->first();
        }

        // Debug information
        $this->debugInfo = [
            'page_found' => $this->admissionPolicy ? true : false,
            'page_name' => $this->admissionPolicy ? $this->admissionPolicy->page_name : 'Not found',
            'page_id' => $this->admissionPolicy ? $this->admissionPolicy->id : null,
            'total_images' => $this->admissionPolicy ? $this->admissionPolicy->images()->count() : 0,
            'all_pages' => StaticPage::all(['id', 'page_name', 'title'])->toArray(),
        ];

        if ($this->admissionPolicy) {
            // Check each section for images
            for ($i = 1; $i <= 10; $i++) {
                $sectionImages = $this->admissionPolicy->images()->where('category', "section_{$i}")->count();
                $this->debugInfo["section_{$i}_images"] = $sectionImages;

                // Get actual image data for debugging
                if ($sectionImages > 0) {
                    $images = $this->admissionPolicy->images()->where('category', "section_{$i}")->get();
                    $this->debugInfo["section_{$i}_image_data"] = $images->map(function ($img) {
                        return [
                            'id' => $img->id,
                            'path' => $img->path,
                            'category' => $img->category,
                            'caption' => $img->caption,
                            'full_url' => asset('storage/' . $img->path)
                        ];
                    })->toArray();
                }
            }

            // Also get all images for this page
            $allImages = $this->admissionPolicy->images()->get();
            $this->debugInfo['all_image_data'] = $allImages->map(function ($img) {
                return [
                    'id' => $img->id,
                    'path' => $img->path,
                    'category' => $img->category,
                    'caption' => $img->caption,
                    'static_page_id' => $img->static_page_id
                ];
            })->toArray();
        }

        Log::info('Admission Policy Debug Info:', $this->debugInfo);
    }

    public function render()
    {
        return view('livewire.frontend.admission-policy');
    }
}
