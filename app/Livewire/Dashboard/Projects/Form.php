<?php

namespace App\Livewire\Dashboard\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\BlogImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\DepartmentModel;

class Form extends Component
{
    use WithFileUploads;

    public $projectId;
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $status = 'planning';
    public $technologies_used;
    public $featured_image;
    public $is_featured = false;

    public $sort_order = 0;
    public $images = [];
    public $uploadedImages = [];
    public $existingImages = [];
    public $department_id;
    public $departments;
    public $paragraphs = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|in:planning,in_progress,completed,on_hold,cancelled',
        'department_id' => 'nullable|exists:department_models,id',
        'technologies_used' => 'nullable|string',
        'is_featured' => 'boolean',

        'sort_order' => 'integer|min:0',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function mount($project = null)
    {
        $this->departments = DepartmentModel::all();
        if ($project) {
            $project = Project::with('images')->findOrFail($project);
            $this->projectId = $project->id;
            $this->title = $project->title;
            // Join paragraphs for editing
            $paragraphs = [];
            for ($i = 1; $i <= 21; $i++) {
                $p = $project->{'paragraph' . $i} ?? null;
                if ($p) $paragraphs[] = $p;
            }
            $this->description = implode("\n\n", $paragraphs) ?: $project->description;
            $this->start_date = $project->start_date ? $project->start_date->format('Y-m-d') : null;
            $this->end_date = $project->end_date ? $project->end_date->format('Y-m-d') : null;
            $this->status = $project->status;
            $this->department_id = $project->department_id;
            $this->technologies_used = $project->technologies_used;
            $this->featured_image = $project->featured_image;
            $this->is_featured = $project->is_featured;
            $this->sort_order = $project->sort_order;

            // Load existing images
            $this->existingImages = $project->images()->where('category', 'project')->get();
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'department_id' => $this->department_id,
            'technologies_used' => $this->technologies_used,
            'is_featured' => $this->is_featured,

            'sort_order' => $this->sort_order,
        ];

        // Split description into paragraphs
        $paragraphs = preg_split('/\r?\n\r?\n/', trim($this->description));
        for ($i = 1; $i <= 21; $i++) {
            $data['paragraph' . $i] = $paragraphs[$i - 1] ?? null;
        }

        if ($this->projectId) {
            $project = Project::findOrFail($this->projectId);
            $project->update($data);
        } else {
            $project = Project::create($data);
        }

        // Handle image uploads
        if ($this->images) {
            foreach ($this->images as $index => $image) {
                $path = $image->store('projects', 'public');
                BlogImage::create([
                    'project_id' => $project->id,
                    'path' => $path,
                    'category' => 'project',
                    'is_featured' => $index === 0, // First image is featured
                ]);
            }
        }

        session()->flash('success', 'Project saved successfully!');
        return redirect()->route('dashboard.projects.index');
    }

    public function deleteImage($imageId)
    {
        $image = BlogImage::findOrFail($imageId);

        // Check if this is the featured image
        $isFeatured = $image->is_featured;

        // Delete the image file
        if (file_exists(storage_path('app/public/' . $image->path))) {
            unlink(storage_path('app/public/' . $image->path));
        }

        // Delete the database record
        $image->delete();

        // If this was the featured image, set the first remaining image as featured
        if ($isFeatured && $this->projectId) {
            $firstImage = BlogImage::where('project_id', $this->projectId)
                ->where('category', 'project')
                ->first();

            if ($firstImage) {
                $firstImage->update(['is_featured' => true]);
            }
        }

        // Refresh existing images
        if ($this->projectId) {
            $this->existingImages = BlogImage::where('project_id', $this->projectId)
                ->where('category', 'project')
                ->get();
        }

        session()->flash('success', 'Image deleted successfully!');
    }

    public function setFeaturedImage($imageId)
    {
        if (!$this->projectId) {
            session()->flash('error', 'Project must be saved first.');
            return;
        }

        // Remove featured status from all project images
        BlogImage::where('project_id', $this->projectId)
            ->where('category', 'project')
            ->update(['is_featured' => false]);

        // Set the selected image as featured
        $image = BlogImage::findOrFail($imageId);
        $image->update(['is_featured' => true]);

        // Refresh existing images
        $this->existingImages = BlogImage::where('project_id', $this->projectId)
            ->where('category', 'project')
            ->get();

        session()->flash('success', 'Featured image updated successfully!');
    }

    public function render()
    {
        return view('livewire.dashboard.projects.form', [
            'departments' => $this->departments,
        ])->layout('components.layouts.dashboard');
    }
}
