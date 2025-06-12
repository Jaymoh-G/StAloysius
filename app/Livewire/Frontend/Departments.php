<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Department;
use App\Models\DepartmentModel;
use Illuminate\Support\Str;

class Departments extends Component
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

    protected function limitContent($content, $lines = 3)
    {
        if (empty($content)) {
            return 'Department information coming soon.';
        }

        // Split content into lines
        $contentLines = explode("\n", strip_tags($content));

        // Take only first 3 lines
        $limitedLines = array_slice($contentLines, 0, $lines);

        // Join lines back together
        return implode("\n", $limitedLines);
    }

    public function render()
    {
        $departments = DepartmentModel::with(['featuredImage', 'images'])->get();

        $academicDepts = $departments->filter(function ($dept) {
            return in_array($dept->name, $this->academicDepartments);
        })->map(function ($dept) {
            $dept->content = $this->limitContent($dept->content);
            return $dept;
        });

        $nonAcademicDepts = $departments->filter(function ($dept) {
            return in_array($dept->name, $this->nonAcademicDepartments);
        })->map(function ($dept) {
            $dept->content = $this->limitContent($dept->content);
            return $dept;
        });

        return view('livewire.frontend.departments', [
            'academicDepts' => $academicDepts,
            'nonAcademicDepts' => $nonAcademicDepts
        ]);
    }
}
