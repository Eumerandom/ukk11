<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\Industri;

class Dashboard extends Component
{
    // public $siswas;
    // public $gurus;
    public $industris;
    public $title = 'Dashboard';
    public function render()
    {
        // $siswas = Siswa::query();
        // $gurus = Guru::query();
        $this->industris = Industri::all();
        // dd($industris);
        return view('livewire.dashboard',[
            'industris' => $this->industris
        ]);
    }
}
