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
        if (!User::where('email', $siswa->email)->exists()) {
            $user = User::create([
                'name' => $siswa->nama,
                'email' => $siswa->email,
                'password' => Hash::make($siswa->nis),
                'role' => 'siswa', 
            ]);

            $siswaRole = Role::where('name', 'siswa')->first();
            if ($siswaRole) {
                $user->assignRole($siswaRole);
            }

            $siswa->user_id = $user->id;
            $siswa->saveQuietly();
        }
    }

    /**
     * Handle the Siswa "updated" event.
     */
    public function updated(Siswa $siswa): void
    {
        $user = User::where('email', $siswa->getOriginal('email'))->first();

        if ($user) {
            $user->name = $siswa->nama;
            $user->email = $siswa->email;
            $user->password = Hash::make($siswa->nis);
            $user->save();
        }
    }

    /**
     * Handle the Siswa "deleted" event.
     */
    public function deleted(Siswa $siswa): void
    {
        User::where('email', $siswa->email)->delete();
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
