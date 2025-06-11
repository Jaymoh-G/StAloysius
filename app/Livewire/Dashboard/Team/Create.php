<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TeamMember;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Create extends Component
{
    use WithFileUploads;

    public $teamMemberId;
    public $name;
    public $position;
    public $description;
    public $experience;
    public $image;
    public $imageTemp;
    public $department_id;
    public $departments;
    public $professional_skills = [];
    public $socials = [];
    public $newSkill = '';
    public $newPercent = '';
    public $newSocial = '';
    public $newSocialLink = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'description' => 'nullable|string',
        'experience' => 'nullable|string',
        'imageTemp' => 'nullable|image|max:1024',
      'department_id' => 'required|exists:department_models,id',

        'professional_skills' => 'array',
        'socials' => 'array'
    ];

    protected $messages = [
        'newSocialLink.url' => 'Please enter a valid URL',
        'department_id.required' => 'Please select a department',
        'department_id.exists' => 'The selected department is invalid',
    ];

    public function mount($teamMemberId = null)
    {
        $this->departments = DepartmentModel::orderBy('name')->get();
        $this->teamMemberId = $teamMemberId;

        if ($teamMemberId) {
            $teamMember = TeamMember::findOrFail($teamMemberId);
            $this->name = $teamMember->name;
            $this->position = $teamMember->position;
            $this->description = $teamMember->description;
            $this->experience = $teamMember->experience;
            $this->image = $teamMember->image;
            $this->department_id = $teamMember->department_id;
            $this->professional_skills = $teamMember->professional_skills ?? [];
            $this->socials = $teamMember->socials ?? [];
        }
    }

    public function addSkill()
    {
        $this->validate([
            'newSkill' => 'required|string|max:255',
            'newPercent' => 'required|numeric|min:0|max:100'
        ]);

        $skills = $this->professional_skills;
        if (!is_array($skills)) {
            $skills = [];
        }

        $skills[$this->newSkill] = (int)$this->newPercent;
        $this->professional_skills = $skills;
        $this->newSkill = '';
        $this->newPercent = '';

        // Debug the skills array after adding
        \Log::info('Skills after adding:', ['skills' => $this->professional_skills]);
    }

    public function removeSkill($skill)
    {
        $skills = $this->professional_skills;
        if (isset($skills[$skill])) {
            unset($skills[$skill]);
         $this->professional_skills = $skills;

        }
    }

    public function addSocial()
    {
        $this->validate([
            'newSocial' => 'required|string|in:facebook,twitter,linkedin,instagram,youtube,website',
            'newSocialLink' => 'required|url'
        ]);

        $socials = $this->socials;
        if (!is_array($socials)) {
            $socials = [];
        }

        $url = $this->newSocialLink;
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = 'https://' . $url;
        }

        $socials[$this->newSocial] = $url;
        $this->socials = $socials;
        $this->newSocial = '';
        $this->newSocialLink = '';

        // Debug the socials array after adding
        \Log::info('Socials after adding:', ['socials' => $this->socials]);
    }

    public function removeSocial($platform)
    {
        $socials = $this->socials;
        if (isset($socials[$platform])) {
            unset($socials[$platform]);
           $this->socials = $socials;

        }
    }

    public function save()
    {
        try {
            $this->validate();

            // Debug the data before saving
            \Log::info('Saving team member with data:', [
                'name' => $this->name,
                'position' => $this->position,
                'description' => $this->description,
                'experience' => $this->experience,
                'professional_skills' => $this->professional_skills,
                'socials' => $this->socials,
                'department_id' => $this->department_id
            ]);

            $data = [
                'name' => $this->name,
                'position' => $this->position,
                'description' => $this->description,
                'experience' => $this->experience,
                'professional_skills' => $this->professional_skills,
                'socials' => $this->socials,
                'department_id' => $this->department_id,
                'slug' => Str::slug($this->name)
            ];

            if ($this->imageTemp) {
                $data['image'] = $this->imageTemp->store('team', 'public');
            }

            if ($this->teamMemberId) {
                $teamMember = TeamMember::findOrFail($this->teamMemberId);
                $teamMember->update($data);
                session()->flash('success', 'Team member updated successfully.');
            } else {
                $teamMember = TeamMember::create($data);
                session()->flash('success', 'Team member created successfully.');
            }

            // Debug the saved data
            \Log::info('Saved team member:', ['team_member' => $teamMember->toArray()]);

            return redirect()->route('dashboard.team.index');
        } catch (\Exception $e) {
            \Log::error('Error saving team member: ' . $e->getMessage());
            session()->flash('error', 'Error saving team member: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.team.create', [
            'departments' => DepartmentModel::orderBy('name')->get()
        ])->layout('components.layouts.dashboard');
    }
}
