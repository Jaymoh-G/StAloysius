<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Log;

class SupportUs extends Component
{
    public $supportUs;
    public $donations;
    public $projects;
    public $volunteering;
    public $debugInfo;

    public function mount()
    {
        // Try different variations of the page name
        $this->supportUs = StaticPage::where('page_name', 'Support Us')->first();

        if (!$this->supportUs) {
            $this->supportUs = StaticPage::where('page_name', 'Support us')->first();
        }

        if (!$this->supportUs) {
            $this->supportUs = StaticPage::where('page_name', 'Support')->first();
        }

        // Debug information
        $this->debugInfo = [
            'page_found' => $this->supportUs ? true : false,
            'page_name' => $this->supportUs ? $this->supportUs->page_name : 'Not found',
            'page_id' => $this->supportUs ? $this->supportUs->id : null,
            'total_images' => $this->supportUs ? $this->supportUs->images()->count() : 0,
            'all_pages' => StaticPage::all(['id', 'page_name', 'title'])->toArray(),
        ];

        if ($this->supportUs) {
            // Section debug info
            for ($i = 1; $i <= 3; $i++) {
                $sectionTitle = $this->supportUs->{'section_' . $i . '_title'} ?? null;
                $sectionContent = $this->supportUs->{'section_' . $i . '_content'} ?? null;
                $sectionImage = $this->supportUs->{'section_' . $i . '_image'} ?? null;
                $this->debugInfo["section_{$i}_title"] = $sectionTitle;
                $this->debugInfo["section_{$i}_content_length"] = $sectionContent ? strlen($sectionContent) : 0;
                $this->debugInfo["section_{$i}_image"] = $sectionImage;
            }
            // All images for this page
            $allImages = $this->supportUs->images()->get();
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

        Log::info('Support Us Debug Info:', $this->debugInfo);

        // If found, try to pull section data from the supportUs page
        if ($this->supportUs) {

            $this->projects = (object) [
                'title' => $this->supportUs->section_1_title ?? 'Support Our Projects',
                'content' => $this->supportUs->section_1_content ?? '',
                'image' => $this->supportUs->section_1_image ?? null,
                'images' => $this->supportUs->images()->where('category', 'section_1')->get(),
            ];
            $this->volunteering = (object) [
                'title' => $this->supportUs->section_2_title ?? 'Volunteer Your Service',
                'content' => $this->supportUs->section_2_content ?? '',
                'image' => $this->supportUs->section_2_image ?? null,
                'images' => $this->supportUs->images()->where('category', 'section_2')->get(),
            ];
            $this->donations = (object) [
                'title' => $this->supportUs->section_3_title ?? 'Support Us by Donations',
                'content' => $this->supportUs->section_3_content ?? '',
                'image' => $this->supportUs->section_3_image ?? null,
                'images' => $this->supportUs->images()->where('category', 'section_3')->get(),
            ];
        } else {
            // fallback: nulls
            $empty = collect();
            $this->donations = (object) ['title' => null, 'content' => null, 'image' => null, 'images' => $empty];
            $this->projects = (object) ['title' => null, 'content' => null, 'image' => null, 'images' => $empty];
            $this->volunteering = (object) ['title' => null, 'content' => null, 'image' => null, 'images' => $empty];
        }
    }

    public function render()
    {
        return view('livewire.frontend.support-us', [
            'donations' => $this->donations,
            'projects' => $this->projects,
            'volunteering' => $this->volunteering,
            'supportUs' => $this->supportUs,
        ]);
    }
}
