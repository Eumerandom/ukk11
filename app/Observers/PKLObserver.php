<?php

namespace App\Observers;

use App\Models\PKL;

class PKLObserver
{
    /**
     * Handle the PKL "created" event.
     */
    public function created(PKL $pkl): void
    {
        if ($siswa = $pkl->siswa) {
            $siswa->status_pkl = 'aktif';
            $siswa->saveQuietly();
        }
    }

    /**
     * Handle the PKL "deleted" event.
     */
    public function deleted(PKL $pkl): void
    {
        if ($siswa = $pkl->siswa) {
            $hasOtherActivePKL = $siswa->pkls()->where('id', '!=', $pkl->id)->exists();
            if (!$hasOtherActivePKL) {
                $siswa->status_pkl = 'tidak_aktif';
                $siswa->saveQuietly();
            }
        }
    }

    /**
     * Handle the PKL "updated" event.
     */
    public function updated(PKL $pkl): void
    {
        if ($siswa = $pkl->siswa) {
            $siswa->status_pkl = 'aktif';
            $siswa->saveQuietly();
        }
    }
}
