<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;

class Industris extends Component
{
    use WithPagination;

    public $title = 'Industri';
    public $industris;
    public $search = '';
    public $filter = '';
    public bool $open = false;

    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }
    // public function updatingFilter()
    // {
    //     $this->resetPage();
    // }
    // public function mount()
    // {
    //     $this->search = '';
    //     $this->filter = '';
    //     $this->open = false;
    // }

    public function toggle()
    {
        $this->open = !$this->open;
    }

    public function render()
    {
        $this->industris = Industri::query();

        if ($this->search) {
            $this->industris->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filter) {
            $this->industris->where('bidang_usaha', $this->filter);
        }
        return view(
            'livewire.industri',
            [
                'industris' => $this->industris->orderBy('id', 'desc')->paginate(10),
                // ])->layout('components.layouts.app', [
                //     'title' => $this->title,
                //     'header' => $this->title,
            ]
        );
    }
}
