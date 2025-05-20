<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name, $position, $description, $experience, $image, $teamMemberId;
    public $skills = [];
    public $newSkill, $newPercent;
    public $socials = [];
    public $newSocial, $newSocialLink;
    public $imageTemp;

    protected $rules = [
        'name' => 'required|string',
        'position' => 'required|string',
        'description' => 'required|string',
        'experience' => 'required|string',
        'imageTemp' => 'nullable|image|max:2048',
    ];
    public function mount($id = null)
    {
        if ($id) {
            $this->teamMemberId = $id;
            $member = TeamMember::findOrFail($id);
            $this->name = $member->name;
            $this->position = $member->position;
            $this->description = $member->description;
            $this->experience = $member->experience;
            $this->skills = $member->professional_skills ?? [];
            $this->socials = $member->socials ?? [];
            $this->image = $member->image; // store current image path
        }
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image;

        if ($this->imageTemp) {
            if ($this->image && Storage::disk('public')->exists($this->image)) {
                Storage::disk('public')->delete($this->image);
            }
            $imagePath = $this->imageTemp->store('team', 'public');
        }
        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'experience' => $this->experience,
            'professional_skills' => $this->skills,
            'socials' => $this->socials,
            'image' => $imagePath,
        ];

        if ($this->teamMemberId) {
            TeamMember::findOrFail($this->teamMemberId)->update($data);
            session()->flash('message', 'Team member updated successfully!');
        } else {
            TeamMember::create($data);
            session()->flash('message', 'Team member created successfully!');
        }

        return redirect()->route('dashboard.team.index');
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

    public function render()
    {
        return view('livewire.dashboard.team.create')->layout('components.layouts.dashboard');
    }
}
