<?php

namespace App\Filament\Resources\IndustriResource\Pages;

use App\Filament\Resources\IndustriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndustri extends CreateRecord
{
    protected static string $resource = IndustriResource::class;
    protected static ?string $title = 'Industri Baru';
    protected static ?string $slug = 'industri';

    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
