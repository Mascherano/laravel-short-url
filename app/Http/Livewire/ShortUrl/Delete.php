<?php

namespace App\Http\Livewire\ShortUrl;

use Livewire\Component;

class Delete extends Component
{

    public $shorturl;
    public $confirmingShortDeletion = false;

    public function confirmShortDeletion()
    {
        $this->dispatchBrowserEvent('confirming-delete-short');
        $this->confirmingShortDeletion = true;
    }

    public function deletePost()
    {
        dd($this->shorturl);
        $this->resetErrorBag();
        $this->shorturl->forceDelete(); //elimino el post.

        session()->flash('success', 'Url eliminada con exito');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.short-url.delete');
    }
}
