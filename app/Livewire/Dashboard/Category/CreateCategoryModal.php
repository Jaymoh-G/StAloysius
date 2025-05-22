<?php

namespace App\Livewire\Dashboard\Category;

use Livewire\Component;
use App\Models\Category;

class CreateCategoryModal extends Component
{
     public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $this->name,
        ]);

        $this->dispatch('categoryCreated', $category->id);
        $this->dispatch('closeModal');

        $this->reset('name');
        session()->flash('message', 'Category created successfully!');
    }
    public function render()
    {
        return view('livewire.dashboard.category.create-category-modal');
    }
}
