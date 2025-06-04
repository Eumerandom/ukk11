<?php

namespace App\Filament\Resources\IndustriResource\Pages;

use App\Filament\Resources\IndustriResource;
use App\Models\PKL;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndustris extends ListRecords
{
    protected static string $resource = IndustriResource::class;
    protected static ?string $title = 'Data Industri';
    protected static ?string $slug = 'industri';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Industri')
                ->icon('heroicon-o-plus')
                ->url(IndustriResource::getUrl('create'))
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
