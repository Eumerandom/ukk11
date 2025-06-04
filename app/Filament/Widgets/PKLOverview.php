<?php

namespace App\Filament\Widgets;

use App\Models\PKL;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\PKLResource;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;

class PKLOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = 'PKL Overview';

    public function table(Table $table): Table
    {
        return $table
            ->query(PKLResource::getEloquentQuery())
            ->defaultSort('id', 'asc')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => PKL::orderBy('id')->pluck('id')
                        ->search($record->id) + 1),
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Industri')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pembimbing')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->sortable()
                    ->date()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->sortable()
                    ->date()
                    ->label('Tanggal Selesai'),
            ])
            ->filters([
                SelectFilter::make('industri_id')
                    ->relationship('industri', 'nama')
                    ->label('Industri'),
                SelectFilter::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->label('Guru Pembimbing'),
                QueryBuilder::make()
                    ->constraints([
                        DateConstraint::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                    ]),
            ])

            // ->actions([
            //     Action::make('view')
            //         ->url(fn(PKL $record): string => PKLResource::getUrl('view', ['record' => $record]))
            //         ->icon('heroicon-o-eye'),
            // ])
            
    ;}
}
