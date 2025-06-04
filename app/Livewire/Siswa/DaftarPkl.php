<?php

namespace App\Livewire\Siswa;

use App\Models\PKL;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\Industri;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class DaftarPkl extends Component
{
    use WithPagination;

    // public $industris;
    public $title = 'Daftar Industri';
    public $search = '';
    public $sort = '';

    protected $queryString = ['search', 'sort'];

    public function setSort($type)
    {
        $this->sort = $type;
        $this->resetPage();
    }

    #[On('reload-page')]
    public function reloadPage()
    {
        $this->redirect('/dashboard');
    }

    public function mount()
    {
        $siswa = Siswa::where('email', Auth::user()->email)->first();
        $pkl = PKL::where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        if ($pkl) {
            return redirect()->route('dashboard');
            // lol
        }
    }

    public function render()
    {
        $query = Industri::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });

        if ($this->sort === 'asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($this->sort === 'desc') {
            $query->orderBy('nama', 'desc');
        }

        $industris = $query->paginate(6);

        $siswa = Siswa::where('email', Auth::user()->email)->first();
        $pkl = PKL::where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        // dd($industris);
        return view('livewire.siswa.daftar-pkl', [
            'industris' => $industris,
            'siswa' => $siswa,
            'pkl' => $pkl,
        ]);
    }
}
