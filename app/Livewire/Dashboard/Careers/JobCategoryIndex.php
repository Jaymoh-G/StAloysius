<?php

namespace App\Livewire\Dashboard\Careers;

use App\Models\JobCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class JobCategoryIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $categoryId;
    public $isEditing = false;
    public $searchTerm = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:job_categories,name,' . $this->categoryId,
        ];
    }

    public function create()
    {
        $this->validate();

        // Generate a unique slug
        $slug = Str::slug($this->name);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists and append a number if it does
        while (JobCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        JobCategory::create([
            'name' => $this->name,
            'slug' => $slug,
        ]);

        $this->reset(['name']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category created successfully!'
        ]);
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->categoryId = $id;

        $category = JobCategory::findOrFail($id);
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $category = JobCategory::findOrFail($this->categoryId);

        // Only regenerate slug if name has changed
        if ($category->name !== $this->name) {
            // Generate a unique slug
            $slug = Str::slug($this->name);
            $originalSlug = $slug;
            $count = 1;

            // Check if slug exists and append a number if it does
            while (JobCategory::where('slug', $slug)->where('id', '!=', $this->categoryId)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $category->slug = $slug;
        }

        $category->name = $this->name;
        $category->save();

        $this->reset(['name', 'categoryId', 'isEditing']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $category = JobCategory::findOrFail($id);

        // Check if category has job vacancies
        if ($category->vacancies->count() > 0) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Cannot delete category with job vacancies. Remove vacancies first.'
            ]);
            return;
        }

        $category->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Category deleted successfully!'
        ]);
    }

    public function cancel()
    {
        $this->reset(['name', 'categoryId', 'isEditing']);
    }

    public function render()
    {
        $categories = JobCategory::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.dashboard.careers.job-category-index', [
            'categories' => $categories
        ])->layout('components.layouts.dashboard');
    }
}
