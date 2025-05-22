<?php

namespace App\Livewire\Dashboard\Albums;

use App\Models\Album;
use Livewire\Component;

class AlbumIndex extends Component
{
    public $albumToDelete = null;

    public function confirmDelete($id)
    {
        $this->albumToDelete = $id;
        $this->dispatch('show-delete-modal');
    }

    public function deleteConfirmed()
    {
        if ($this->albumToDelete) {
            $album = Album::find($this->albumToDelete);

            if ($album) {
                $album->delete();
                session()->flash('message', 'Album deleted successfully!');
            }

            $this->albumToDelete = null;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.albums.album-index', [
            'albums' => Album::with('category')->get(),
        ])->layout('components.layouts.dashboard');
    }
}
