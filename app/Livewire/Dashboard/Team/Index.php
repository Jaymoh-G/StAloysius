<?php

namespace App\Livewire\Dashboard\Team;

use Livewire\Component;
use App\Models\TeamMember;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    // confirm before deleting the member
    public function deleteMember($id)
    {
        $member = TeamMember::findOrFail($id);

        // Delete the image if it exists
        if ($member->image && Storage::disk('public')->exists($member->image)) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        session()->flash('message', 'Team member deleted successfully!');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    public function render()
    {
        return view('livewire.dashboard.team.index', [
            'teamMembers' => TeamMember::latest()->paginate(10),
        ])->layout('components.layouts.dashboard');
    }
}
