<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Industri;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\IndustriResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IndustriResource\RelationManagers;

class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Industri';
    protected static ?string $navigationGroup = 'Internship Management';
    protected static ?int $navigationSort = 3;

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
                        Forms\Components\TextInput::make('bidang_usaha')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kontak')
                            ->required()
                            ->regex('/^\+62[0-9]{8,13}$/')
                            ->validationMessages([
                                'regex' => 'Nomor telepon anda tidak sesuai'
                            ])
                            ->maxLength(15)
                            ->helperText('Contoh: +628123456789'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ]),
                    Forms\Components\TextArea::make('alamat')
                        ->required()
                        ->maxLength(65535),
                ]),

                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('guru_id')
                        ->label('Guru Pembimbing')
                        ->relationship('guru', 'nama')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => Industri::orderBy('id')->pluck('id')
                        ->search($record->id) + 1),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('alamat')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                // Tables\Columns\TextColumn::make('kontak')
                //     ->sortable()
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pembimbing')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
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
                SelectFilter::make('guru_id')
                    ->label('Guru Pembimbing')
                    ->relationship('guru', 'nama')
                    ->multiple()
                    ->preload(),
                SelectFilter::make('bidang_usaha')
                    ->label('Bidang Usaha')
                    ->multiple()
                    ->options(
                        fn() => Industri::query()
                            ->pluck('bidang_usaha', 'bidang_usaha')
                            ->unique()
                            ->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->visible(fn($record) => !$record->pkls()->exists()),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            // Filter records yang tidak punya relasi PKL
                            $recordsToDelete = $records->filter(fn($record) => !$record->pkls()->exists());
                            
                            // Hapus records yang bisa dihapus
                            $recordsToDelete->each->delete();
                        }),
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
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}
