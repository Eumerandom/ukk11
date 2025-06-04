<?php

namespace App\Observers;

use App\Models\Siswa;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role === 'siswa' && !Siswa::where('email', $user->email)->exists() && !Siswa::where('user_id', $user->id)->exists()) {
            Siswa::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nis' => $this->generateNIS(),
                'alamat' => 'Alamat belum diisi',
                'kontak' => '08000000000',
                'email' => $user->email,
            ]);
        }
    }
    private function generateNIS(): string
    {
        do {
            $randomNumber = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $nis = $randomNumber;
        } while (Siswa::where('nis', $nis)->exists());

        return $nis;
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
