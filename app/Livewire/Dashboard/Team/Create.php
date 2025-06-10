<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TeamMember;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name, $position, $description, $experience, $image, $teamMemberId, $slug, $department_id;
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
        'newSocialLink' => 'nullable|url',
        'slug' => 'required|string|unique:team_members,slug',
        'department_id' => 'required|exists:department_models,id',
    ];

    protected $messages = [
        'newSocialLink.url' => 'Please enter a valid URL',
        'slug.unique' => 'This name is already taken. Please try a different name.',
        'department_id.required' => 'Please select a department',
        'department_id.exists' => 'The selected department is invalid',
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
            $this->image = $member->image;
            $this->slug = $member->slug;
            $this->department_id = $member->department_id;
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
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
            'slug' => $this->slug,
            'department_id' => $this->department_id,
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
        $this->validate([
            'newSocial' => 'required',
            'newSocialLink' => 'required|url',
        ], [
            'newSocial.required' => 'Please select a social platform',
            'newSocialLink.required' => 'Please enter a URL',
            'newSocialLink.url' => 'Please enter a valid URL',
        ]);

        if ($this->newSocial && $this->newSocialLink) {
            // Ensure URL has http/https prefix
            $url = $this->newSocialLink;
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $url = "https://" . $url;
            }

            $this->socials[$this->newSocial] = $url;
            $this->newSocial = $this->newSocialLink = '';
        }
    }

    public function removeSocial($key)
    {
        unset($this->socials[$key]);
    }

    public function render()
    {
        return view('livewire.dashboard.team.create', [
            'departments' => DepartmentModel::orderBy('name')->get()
        ])->layout('components.layouts.dashboard');
    }
}
