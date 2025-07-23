<?php

namespace App\Livewire\Dashboard\Downloads;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Download;

class Form extends Component
{
    use WithFileUploads;

    public $downloadId;
    public $title;
    public $description;
    public $category;
    public $is_active = true;
    public $file;
    public $existingFilePath;
    public $existingFileType;

    protected $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|in:admissions,exams_results,forms,jobs,financials,reports',
        'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120', // 5MB, allowed types
    ];

    protected $messages = [
        'file.required' => 'Please select a file to upload.',
        'file.mimes' => 'Only PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, or PNG files are allowed.',
        'file.max' => 'The file size must not exceed 5MB.',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->downloadId = $id;
            $download = Download::findOrFail($id);
            $this->title = $download->title;
            $this->description = $download->description;
            $this->category = $download->category;
            $this->is_active = $download->is_active;
            $this->existingFilePath = $download->file_path;
            $this->existingFileType = $download->file_type;
        }
    }

    public function save()
    {
        $this->validate();
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'is_active' => $this->is_active,
        ];
        if ($this->file) {
            $data['file_path'] = $this->file->store('downloads', 'public');
            $data['file_type'] = $this->file->getClientOriginalExtension();
        } elseif ($this->downloadId && $this->existingFilePath) {
            $data['file_path'] = $this->existingFilePath;
            $data['file_type'] = $this->existingFileType;
        }
        if ($this->downloadId) {
            Download::findOrFail($this->downloadId)->update($data);
            session()->flash('message', 'Download updated successfully!');
        } else {
            Download::create($data);
            session()->flash('message', 'Download created successfully!');
        }
        return redirect()->route('downloads.index');
    }

    public function render()
    {
        $categories = [
            'admissions' => 'Admissions',
            'exams_results' => 'Exams & Results',
            'forms' => 'Forms',
            'jobs' => 'Jobs',
            'financials' => 'Financials',
            'reports' => 'Reports',
        ];
        return view('livewire.dashboard.downloads.form', [
            'categories' => $categories,
        ])->layout('components.layouts.dashboard');
    }

    // Clear the file error when a new file is selected
    public function updatedFile()
    {
        $this->resetErrorBag('file');
    }
}
