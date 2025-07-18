<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Log;

class FeePayingStudents extends Component
{
    public $feePayingStudents;
    public $debugInfo = [];

    // display content from database, from static page table, page_name = Admission Policy
    public function mount()
    {
        // Try different variations of the page name
        $this->feePayingStudents = StaticPage::where('page_name', 'Fee Paying Students')->first();

        if (!$this->feePayingStudents) {
            $this->feePayingStudents = StaticPage::where('page_name', 'Fee Paying Students Page')->first();
        }

        if (!$this->feePayingStudents) {
            $this->feePayingStudents = StaticPage::where('page_name', 'fee paying students')->first();
        }

        // Debug information
        $this->debugInfo = [
            'page_found' => $this->feePayingStudents ? true : false,
            'page_name' => $this->feePayingStudents ? $this->feePayingStudents->page_name : 'Not found',
            'page_id' => $this->feePayingStudents ? $this->feePayingStudents->id : null,
            'total_images' => $this->feePayingStudents ? $this->feePayingStudents->images()->count() : 0,
            'all_pages' => StaticPage::all(['id', 'page_name', 'title'])->toArray(),
        ];

        if ($this->feePayingStudents) {
            // Check each section for images
            for ($i = 1; $i <= 10; $i++) {
                $sectionImages = $this->feePayingStudents->images()->where('category', "section_{$i}")->count();
                $this->debugInfo["section_{$i}_images"] = $sectionImages;

                // Get actual image data for debugging
                if ($sectionImages > 0) {
                    $images = $this->feePayingStudents->images()->where('category', "section_{$i}")->get();
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
            $allImages = $this->feePayingStudents->images()->get();
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

        Log::info('Fee Paying Students Debug Info:', $this->debugInfo);
    }

    public function render()
    {
        return view('livewire.frontend.fee-paying-students');
    }
}
