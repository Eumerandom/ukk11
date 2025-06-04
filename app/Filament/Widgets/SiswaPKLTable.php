<?php

namespace App\Filament\Widgets;

use App\Models\PKL;
use App\Models\Guru;
use Filament\Tables;
use App\Models\Industri;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\PKLResource;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;

class SiswaPKLTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = '';


    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return PKLResource::getEloquentQuery()
                    // ->whereHas('industri', function ($query) {
                    //     $query->where('guru_id', auth()->id());
                    // })
                ;
            })
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
                    ->wrap(),
                Tables\Columns\TextColumn::make('siswa.nis')
                    ->label('NIS')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Industri')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->label('Tanggal Selesai'),
            ])
            ->filters([
                SelectFilter::make('industri_id')
                    ->relationship('industri', 'nama')
                    ->label('Industri'),
                QueryBuilder::make()
                    ->constraints([
                        DateConstraint::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                    ]),
            ])

            ->actions([
                Action::make('view')
                    ->url(fn(PKL $record): string => PKLResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ])

            ->filters([
                SelectFilter::make('guru_id')
                    ->label('Guru Pembimbing')
                    ->relationship('guru', 'nama')
                    ->default(function () {
                        $user = auth()->user();
                        $guru = Guru::where('email', $user->email)->first();
                        return $guru?->id ?? '-';
                    }),
                SelectFilter::make('industri_id')
                    ->label('Industri')
                    ->options(function () {
                        $user = auth()->user();
                        $guru = Guru::where('email', $user->email)->first();
                        if (!$guru) {
                            return [];
                        }
                        return Industri::where('guru_id', $guru->id)
                            ->pluck('nama', 'id')
                            ->toArray();
                    })
                ,
            ]);

    }
}
