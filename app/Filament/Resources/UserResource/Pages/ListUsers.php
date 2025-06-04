<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\PKL;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Data User';
    protected static ?string $slug = 'user';

        protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah PKL')
                ->icon('heroicon-o-plus')
                ->url(UserResource::getUrl('create'))
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
