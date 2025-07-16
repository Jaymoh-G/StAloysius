<?php

namespace App\Livewire\Dashboard\Careers;

use App\Models\JobCategory;
use App\Models\JobVacancy;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobVacancyForm extends Component
{
    use WithFileUploads;

    public $jobId;
    public $title;
    public $slug;
    public $job_category_id;
    public $description;
    public $deadline;
    public $application_email;
    public $is_active = true;
    public $pdf; // for file upload
    public $existingPdfPath;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'job_category_id' => 'required|exists:job_categories,id',
        'description' => 'required|string',
        'deadline' => 'required|date|after:today',
        'application_email' => 'required|email',
        'is_active' => 'boolean',
        'pdf' => 'nullable|file|mimes:pdf|max:4096', // 4MB max
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->jobId = $id;
            $job = JobVacancy::findOrFail($id);
            $this->fill($job->toArray());
            $this->deadline = optional($job->deadline)->format('Y-m-d');
            $this->existingPdfPath = $job->pdf_path;
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'job_category_id' => $this->job_category_id,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'application_email' => $this->application_email,
            'is_active' => $this->is_active,
        ];

        // Handle PDF upload
        if ($this->pdf) {
            $data['pdf_path'] = $this->pdf->store('job_pdfs', 'public');
        } elseif ($this->jobId && $this->existingPdfPath) {
            $data['pdf_path'] = $this->existingPdfPath;
        }

        if ($this->jobId) {
            JobVacancy::findOrFail($this->jobId)->update($data);
            session()->flash('message', 'Job vacancy updated successfully!');
        } else {
            JobVacancy::create($data);
            session()->flash('message', 'Job vacancy created successfully!');
        }

        return redirect()->route('dashboard.careers.index');
    }

    public function render()
    {
        return view('livewire.dashboard.careers.job-vacancy-form', [
            'categories' => JobCategory::all(),
        ])->layout('components.layouts.dashboard');
    }
}
