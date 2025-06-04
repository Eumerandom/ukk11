<?php

namespace App\Livewire\Siswa;

use App\Models\PKL;
use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function delete($id)
    {
        $pkl = PKL::find($id);

        if ($pkl) {
            $pkl->delete();
            session()->flash('deleted', 'Data PKL berhasil dihapus.');
            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        $siswa = Siswa::where('email', Auth::user()->email)->first();
        $pkl = PKL::with(['industri', 'guru'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        return view('livewire.siswa.dashboard', [
            'siswa' => $siswa,
            'pkl' => $pkl,
        ]);
    }
}
