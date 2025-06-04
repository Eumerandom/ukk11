<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;
    protected static ?string $title = 'Guru Baru';
    protected static ?string $slug = 'guru';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
