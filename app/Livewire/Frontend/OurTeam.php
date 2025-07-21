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
        'Mathematics Department',
        'Library Department'
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
        $members = TeamMember::with('department')->get();
        $academicMembers = $members->filter(function ($member) {
            return $member->department && in_array($member->department->name, $this->academicDepartments);
        })->sortBy('sort_order');

        $nonAcademicMembers = $members->filter(function ($member) {
            return !$member->department ||
                (!in_array($member->department->name, $this->academicDepartments));
        })->sortBy('sort_order');

        return view('livewire.frontend.our-team', [
            'nonAcademicMembers' => $nonAcademicMembers,
            'academicMembers' => $academicMembers,
        ]);
    }
}
