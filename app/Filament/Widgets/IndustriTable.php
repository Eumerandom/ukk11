<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Industri;
use Filament\Tables\Table;
use Tables\Columns\ViewColumn;
use App\Filament\Resources\IndustriResource;
use Filament\Widgets\TableWidget as BaseWidget;


class IndustriTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Daftar Industri yang Bermitra';

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(IndustriResource::getEloquentQuery())
            ->defaultSort('id', 'asc')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => Industri::orderBy('id')->pluck('id')
                        ->search($record->id) + 1),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->label('Bidang Usaha')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                // Tables\Columns\TextColumn::make('alamat')
                //     ->sortable()
                //     ->searchable()
                //     ->wrap(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pembimbing')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ViewColumn::make('action')
                    ->label('Aksi')
                    ->view('filament.widgets.columns.industri-action'),
            ]);
    }

}
