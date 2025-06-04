<?php

namespace App\Filament\Resources\PKLResource\Pages;

use App\Filament\Resources\PKLResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPKL extends ViewRecord
{
    protected static string $resource = PKLResource::class;
    protected static ?string $title = 'Data PKL';
    protected static ?string $slug = 'pkl';
}
