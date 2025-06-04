<?php

namespace App\Livewire\Siswa;

use App\Models\PKL;
use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TabelPkl extends Component
{

    public function render()
    {
        $siswa = Siswa::where('email', Auth::user()->email)->first();
        $pkl = PKL::with(['industri', 'guru'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        return view('livewire.siswa.tabel-pkl', [
            'siswa' => $siswa,
            'pkl' => $pkl,
        ]);
    }

    
}
