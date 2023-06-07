<?php

namespace App\Http\Livewire\ShortUrl;

use Livewire\Component;
use App\Models\ShortUrl;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = 'desc';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.short-url.index', [
            'shortUrls' => ShortUrl::searchShortUrls($this->search)
                            ->orderBy($this->orderBy, $this->orderAsc)
                            ->paginate($this->perPage)
        ]);
    }
}
