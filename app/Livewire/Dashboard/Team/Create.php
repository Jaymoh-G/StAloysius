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

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'position' => 'required|string',
            'description' => 'required|string',
            'experience' => 'required|string',
            'imageTemp' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'department_id' => 'required|exists:department_models,id',
            'professional_skills' => 'array|required',
            'socials' => 'array'
        ];

        // If we're editing, modify the name validation to ignore the current record
        if ($this->teamMemberId) {
            $rules['name'] = 'required|string|max:255|unique:team_members,name,' . $this->teamMemberId;
        } else {
            $rules['name'] = 'required|string|max:255|unique:team_members,name';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'The name field is required.',
        'position.required' => 'The position field is required.',
        'department_id.required' => 'Please select a department.',
        'department_id.exists' => 'The selected department is invalid.',
        'newSocialLink.url' => 'Please enter a valid URL',
        'newSkill.required' => 'The skill field is required.',
        'newPercent.required' => 'The percentage field is required.',
        'newPercent.numeric' => 'The percentage must be a number.',
        'newPercent.min' => 'The percentage must be at least 0.',
        'newPercent.max' => 'The percentage must be at most 100.',
        'newSocial.required' => 'The social platform field is required.',
        'description.required' => 'The description field is required.',
        'experience.required' => 'The experience field is required.',
        'imageTemp.image' => 'The image must be an image.',
        'imageTemp.max' => 'The image must be less than 1024 kilobytes.',
        'imageTemp.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
        'professional_skills.array' => 'The professional skills must be an array.',
        'socials.array' => 'The socials must be an array.',
        'position.required' => 'The position field is required.',

    ];

    public function mount($id = null)
    {
        Log::info('Editing team member', ['id' => $id]);

        $this->departments = DepartmentModel::orderBy('name')->get();
        $this->teamMemberId = $id;

        if ($id) {
            $teamMember = TeamMember::findOrFail($id);
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
        ], [
            'newSkill.required' => 'The skill field is required.',
            'newPercent.required' => 'The percentage field is required.',
            'newPercent.numeric' => 'The percentage must be a number.',
            'newPercent.min' => 'The percentage must be at least 0.',
            'newPercent.max' => 'The percentage must be at most 100.',

        ]);

        $skills = $this->professional_skills;
        if (!is_array($skills)) {
            $skills = [];
        }

        if (array_key_exists($this->newSkill, $skills)) {
            $this->addError('newSkill', 'This skill is already added.');
            return;
        }

        $skills[$this->newSkill] = (int)$this->newPercent;
        $this->professional_skills = $skills;
        $this->newSkill = '';
        $this->newPercent = '';
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
        ], [
            'newSocial.required' => 'The social platform field is required.',
            'newSocial.in' => 'Please select a valid social platform.',
            'newSocialLink.required' => 'The social link field is required.',
            'newSocialLink.url' => 'Please enter a valid URL.'
        ]);

        $socials = $this->socials;
        if (!is_array($socials)) {
            $socials = [];
        }

        if (array_key_exists($this->newSocial, $socials)) {
            $this->addError('newSocial', ucfirst($this->newSocial) . ' is already added.');
            return;
        }

        $url = $this->newSocialLink;
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = 'https://' . $url;
        }

        $socials[$this->newSocial] = $url;
        $this->socials = $socials;
        $this->newSocial = '';
        $this->newSocialLink = '';
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
            $this->validate($this->rules());

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

            return redirect()->route('dashboard.team.index');
        } catch (\Exception $e) {
            $this->addError('general', 'Error saving team member: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.team.create', [
            'departments' => $this->departments
        ])->layout('components.layouts.dashboard');
    }
}
