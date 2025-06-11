<?php

namespace App\Http\Livewire\Dashboard\Gallery;

use App\Models\GalleryAlbum;
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
            GalleryAlbum::findOrFail($id)->delete();
            session()->flash('message', 'Gallery album deleted successfully!');
        }
    }
}
