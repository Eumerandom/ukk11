<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Internship Management';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nis')
                            ->required()
                            ->label('NIS')
                            ->maxLength(255),
                    ]),

                    Forms\Components\Radio::make('gender')
                        ->options([
                            'laki-laki' => 'Laki-laki',
                            'perempuan' => 'Perempuan',
                        ])
                        ->required(),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kontak')
                            ->required()
                            ->rule('regex:/^\+62[0-9]{8,13}$/')
                            ->maxLength(15),
                    ]),

                    Forms\Components\Textarea::make('alamat')
                        ->required()
                        ->maxLength(65535),
                    Forms\Components\ToggleButtons::make('status_pkl')
                        ->label('Status PKL')
                        ->options([
                            'aktif' => 'Aktif',
                            'tidak_aktif' => 'Tidak Aktif',
                        ])
                        ->default('tidak_aktif')
                        ->required()
                        ->inline(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter::make('status_pkl')
                //     ->label('Status PKL'),
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->visible(fn($record) => $record->status_pkl === "tidak_aktif"),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        // ->visible(
                        //     fn(Collection $records) => $records
                        //         ->every(
                        //             fn($record) =>
                        //             $record->status_pkl === 'tidak_aktif' &&
                        //             !$record->pkls()->exists()
                        //         )
                        // )
                ]),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
            'view' => Pages\ViewSiswa::route('/{record}/view'),
        ];
    }
}
