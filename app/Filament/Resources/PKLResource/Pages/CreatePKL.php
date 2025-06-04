<?php

namespace App\Filament\Resources\PKLResource\Pages;

use App\Filament\Resources\PKLResource;
use App\Models\Industri;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePKL extends CreateRecord
{
    protected static string $resource = PKLResource::class;
    protected static ?string $title = 'PKL Baru';
    protected static ?string $slug = 'pkl';

    // protected function beforeCreate(): void
    // {
    //     $user = Auth::user();
    //     if (!$user->hasRole('siswa')) {
    //         $this->halt();
    //     }

    //     if ($user->siswa && $user->siswa->status_pkl === 'aktif') {
    //         $this->halt();
    //     }
    // }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();
        
        if ($user->hasRole('siswa') && $user->siswa) {
            $data['siswa_id'] = $user->siswa->id;
        }

        $industri_id = request()->get('industri_id');
        if ($industri_id) {
            $industri = Industri::find($industri_id);
            if ($industri) {
                $data['industri_id'] = $industri->id;
                $data['guru_id'] = $industri->guru_id;
            }
        }

        return $data;
    }

    
    protected function getRedirectUrl(): string
    {
        return '/admin/siswa/dashboard';
        // return '/sija/siswa/dashboard';
    }
}
