<?php

namespace App\Filament\Resources\PKLResource\Pages;

use App\Models\PKL;
use App\Models\Siswa;
use Filament\Actions;
use App\Filament\Resources\PKLResource;
use Filament\Resources\Pages\ListRecords;

class ListPKLS extends ListRecords
{
    protected static string $resource = PKLResource::class;

    protected static ?string $title = 'Data PKL';
    protected static ?string $slug = 'pkl';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah PKL')
                ->icon('heroicon-o-plus')
                ->url(PKLResource::getUrl('create'))
                ->color('primary')
                ->button()
                ->visible(function () {
                    $user = auth()->user();
                    if (!$user->siswa)
                        return false;
                    return !PKL::where('siswa_id', $user->siswa->id)->exists();
                }),
        ];
    }


}
