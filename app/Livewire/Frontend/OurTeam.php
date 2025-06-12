<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\TeamMember;

class OurTeam extends Component
{
    protected $academicDepartments = [
        'Science Department',
        'Humanities Department',
        'Language Department',
        'Graduates Department',
        'Technical Department',
        'Mathematics Department'
    ];

    protected $nonAcademicDepartments = [
        'Liturgy Department',
        'Development Department',
        'Clubs and Societies Department',
        'Games Department',
        'Students Welfare',
        'Administration Department',
        'Health Department',
        'Kitchen Department',
        'Sanitation Department',
        'Maintenance Department',
        'Secretarial Department'
    ];

    public function render()
    {
        $members = TeamMember::with('department')->latest()->get();

        $nonAcademicMembers = $members->filter(function ($member) {
            return $member->department && in_array($member->department->name, $this->nonAcademicDepartments);
        });

        $academicMembers = $members->filter(function ($member) {
            return $member->department && in_array($member->department->name, $this->academicDepartments);
        });

        $otherMembers = $members->filter(function ($member) {
            return !$member->department ||
                (!in_array($member->department->name, $this->academicDepartments) &&
                    !in_array($member->department->name, $this->nonAcademicDepartments));
        });

        return view('livewire.frontend.our-team', [
            'nonAcademicMembers' => $nonAcademicMembers,
            'academicMembers' => $academicMembers,
            'otherMembers' => $otherMembers
        ]);
    }
}
