<?php

namespace App\Livewire\Dashboard\Departments;

use Livewire\Component;
use App\Models\Category;
use App\Models\Department;
use DOMDocument;

class Create extends Component
{
    public $title, $category_id, $content;
    public $categories = [];

    // ✅ Listen for event dispatched from CKEditor
    protected $listeners = ['updateContent'];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.dashboard.departments.create')
            ->layout('components.layouts.dashboard');
    }

    // ✅ This method is triggered when CKEditor updates content
    public function updateContent($data)
    {
        $this->content = $data['content'];
    }

    public function save()
    {
        // Debug to check values coming in
 dd($this->content);


        $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
        ]);

        // Extract paragraphs and images from the CKEditor HTML content
        $parsed = $this->extractParagraphsAndImages($this->content);

        Department::create([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'paragraph1' => $parsed['paragraphs'][0] ?? null,
            'paragraph2' => $parsed['paragraphs'][1] ?? null,
            'paragraph3' => $parsed['paragraphs'][2] ?? null,
            'paragraph4' => $parsed['paragraphs'][3] ?? null,
            'image1' => $parsed['images'][0] ?? null,
            'image2' => $parsed['images'][1] ?? null,
            'image3' => $parsed['images'][2] ?? null,
        ]);

        session()->flash('message', 'Department created successfully!');
        $this->reset(['title', 'category_id', 'content']);

        // Optional: Reset CKEditor content
        $this->dispatchBrowserEvent('resetEditor');
    }

    protected function extractParagraphsAndImages($html)
    {
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        $paragraphs = [];
        $images = [];

        foreach ($doc->getElementsByTagName('p') as $p) {
            $text = trim($p->textContent);
            if (!empty($text)) {
                $paragraphs[] = $text;
            }
        }

        foreach ($doc->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!empty($src)) {
                $images[] = $src;
            }
        }

        return [
            'paragraphs' => $paragraphs,
            'images' => $images,
        ];
    }
}
