<?php

namespace App\Livewire\Dashboard\Careers;

use App\Models\JobCategory;
use App\Models\JobVacancy;
use Illuminate\Support\Str;
use Livewire\Component;

class JobVacancyForm extends Component
{
    public $jobId;
    public $title;
    public $slug;
    public $job_category_id;
    public $description;
    public $deadline;
    public $application_email;
    public $is_active = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'job_category_id' => 'required|exists:job_categories,id',
        'description' => 'required|string',
        'deadline' => 'required|date|after:today',
        'application_email' => 'required|email',
        'is_active' => 'boolean',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->jobId = $id;
            $job = JobVacancy::findOrFail($id);
            $this->fill($job->toArray());
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
