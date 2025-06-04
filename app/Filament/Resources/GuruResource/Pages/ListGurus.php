<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Models\PKL;
use Filament\Actions;
use App\Filament\Resources\GuruResource;
use Filament\Resources\Pages\ListRecords;

class ListGurus extends ListRecords
{
    protected static string $resource = GuruResource::class;
    protected static ?string $title = 'Data Guru';
    protected static ?string $slug = 'guru';

        protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Guru')
                ->icon('heroicon-o-plus')
                ->url(GuruResource::getUrl('create'))
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
