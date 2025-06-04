<?php

namespace App\Observers;

use App\Models\Guru;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class GuruObserver
{
    /**
     * Handle the Guru "created" event.
     */
    public function created(Guru $guru): void
    {
        if (!User::where('email', $guru->email)->exists()) {
            $user = User::create([
                'name' => $guru->nama,
                'email' => $guru->email,
                'password' => Hash::make($guru->nip),
                'role' => 'guru', 
            ]);

            $guruRole = Role::where('name', 'guru')->first();
            if ($guruRole) {
                $user->assignRole($guruRole);
            }

            $guru->user_id = $user->id;
            $guru->saveQuietly();
        }
    }

    /**
     * Handle the Guru "updated" event.
     */
    public function updated(Guru $guru): void
    {
        $user = User::where('email', $guru->getOriginal('email'))->first();

        if ($user) {
            $user->name = $guru->nama;
            $user->email = $guru->email;
            $user->password = Hash::make($guru->nip);
            $user->save();
        }
    }

    /**
     * Handle the Guru "deleted" event.
     */
    public function deleted(Guru $guru): void
    {
        User::where('email', $guru->email)->delete();
    }

    /**
     * Handle the Guru "restored" event.
     */
    public function restored(Guru $guru): void
    {
        //
    }

    /**
     * Handle the Guru "force deleted" event.
     */
    public function forceDeleted(Guru $guru): void
    {
        //
    }
}
