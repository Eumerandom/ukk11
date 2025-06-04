<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use App\Models\PKL;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;
    protected static ?string $title = 'Data Siswa';
    protected static ?string $slug = 'siswa';

        protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Siswa')
                ->icon('heroicon-o-plus')
                ->url(SiswaResource::getUrl('create'))
                ->color('primary')
                ->button()
                ->visible(function () {
                    $user = auth()->user();
                    if ($user->hasRole('super_admin')) {
                        return true;
                    }
                    if (!$user->siswa)
                        return false;
                    return !PKL::where('siswa_id', $user->siswa->id)->exists();
                }),
        ];
    }
}
