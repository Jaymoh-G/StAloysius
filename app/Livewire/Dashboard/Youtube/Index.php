<?php

namespace App\Http\Livewire\Dashboard\YouTube;

use App\Models\YouTubeVideo;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        $this->dispatch('confirmDelete', ['id' => $id]);
    }

    public function deleteConfirmed($id)
    {
        if ($id) {
            YouTubeVideo::findOrFail($id)->delete();
            session()->flash('message', 'YouTube video deleted successfully!');
        }
    }
}
