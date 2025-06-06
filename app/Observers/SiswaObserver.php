<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Siswa;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SiswaObserver
{
    /**
     * Handle the Siswa "created" event.
     */
    public function created(Siswa $siswa): void
    {
        
    }

    /**
     * Handle the Siswa "updated" event.
     */
    public function updated(Siswa $siswa): void
    {
        if ($user = $siswa->user) {
            $user->name = $siswa->nama;
            $user->email = $siswa->email;
            $user->save();
        }
    }

    /**
     * Handle the Siswa "deleted" event.
     */
    public function deleted(Siswa $siswa): void
    {
        if ($user = $siswa->user) {
            $user->delete();
        }
    }

    /**
     * Handle the Siswa "restored" event.
     */
    public function restored(Siswa $siswa): void
    {
        //
    }

    /**
     * Handle the Siswa "force deleted" event.
     */
    public function forceDeleted(Siswa $siswa): void
    {
        //
    }
}
