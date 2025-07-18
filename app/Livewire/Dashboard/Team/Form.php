<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use App\Models\TeamMember;
use Livewire\WithFileUploads;

class Form extends Component
{
    public $team_member_id;
    public $name, $position, $description, $experience, $image;
    public $skills = []; // ['HTML' => 90, ...]
    public $socials = []; // ['linkedin' => '...', ...]
    public $sort_order = 0;

    public $newSkill, $newPercent;
    public $newSocial, $newSocialLink;

    public $imageTemp;
    public $existingImage; // Add this to track existing image

    protected $rules = [
        'name' => 'required|string',
        'position' => 'required|string',
        'description' => 'required|string',
        'experience' => 'required|string',
        'skills' => 'nullable|array',
        'socials' => 'nullable|array',
        'imageTemp' => 'nullable|image|max:2048',
        'sort_order' => 'nullable|integer',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->team_member_id = $id;
            $teamMember = TeamMember::findOrFail($id);

            // Load existing data
            $this->name = $teamMember->name;
            $this->position = $teamMember->position;
            $this->description = $teamMember->description;
            $this->experience = $teamMember->experience;
            $this->skills = $teamMember->professional_skills ?? [];
            $this->socials = $teamMember->socials ?? [];
            $this->existingImage = $teamMember->image;
            $this->sort_order = $teamMember->sort_order ?? 0;
        }
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existingImage; // Keep existing image by default
        if ($this->imageTemp) {
            $imagePath = $this->imageTemp->store('team', 'public');
        }

        TeamMember::updateOrCreate(
            ['id' => $this->team_member_id],
            [
                'name' => $this->name,
                'position' => $this->position,
                'description' => $this->description,
                'experience' => $this->experience,
                'professional_skills' => $this->skills,
                'socials' => $this->socials,
                'image' => $imagePath,
                'sort_order' => $this->sort_order,
            ]
        );

        session()->flash('message', 'Team member saved.');
        return redirect()->route('dashboard.team.index');
    }

    public function render()
    {
        return view('livewire.dashboard.team.form')->layout('components.layouts.dashboard');
    }

    public function addSkill()
    {
        if ($this->newSkill && $this->newPercent !== null) {
            $this->skills[$this->newSkill] = (int) $this->newPercent;
            $this->newSkill = $this->newPercent = '';
        }
    }

    public function removeSkill($key)
    {
        unset($this->skills[$key]);
    }

    public function addSocial()
    {
        if ($this->newSocial && $this->newSocialLink) {
            $this->socials[$this->newSocial] = $this->newSocialLink;
            $this->newSocial = $this->newSocialLink = '';
        }
    }

    public function removeSocial($key)
    {
        unset($this->socials[$key]);
    }
}
