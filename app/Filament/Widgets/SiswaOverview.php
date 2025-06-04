<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Siswa;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\SiswaResource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;

class SiswaOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = '';

    public function table(Table $table): Table
    {
        return $table
            ->query(SiswaResource::getEloquentQuery())
            ->defaultSort('id', 'asc')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => Siswa::orderBy('id')->pluck('id')
                        ->search($record->id) + 1),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'laki-laki' => 'L',
                        'perempuan' => 'P',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'laki-laki' => 'primary',
                        'perempuan' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'aktif' => 'success',
                        'tidak_aktif' => 'danger',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_pkl')
                    ->label('Status PKL')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                    ]),
                SelectFilter::make('gender')
                    ->label('Gender')
                    ->options([
                        'laki-laki' => 'Laki-laki',
                        'perempuan' => 'Perempuan',
                    ]),
            ])

            ->actions([
                Action::make('view')
                    ->url(fn(Siswa $record): string => SiswaResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ]);

    }
}
