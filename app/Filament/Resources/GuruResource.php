<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Guru;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\GuruResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuruResource\RelationManagers;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $navigationGroup = 'Internship Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'guru';

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
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
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
                            ->regex('/^\+62[0-9]{8,13}$/')
                            ->validationMessages([
                                'regex' => 'Nomor telepon anda tidak sesuai'
                            ])
                            ->maxLength(15)
                            ->helperText('Contoh: +628123456789'),
                    ]),

                    Forms\Components\Textarea::make('alamat')
                        ->required()
                        ->maxLength(65535),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => Guru::orderBy('id')->pluck('id')
                        ->search($record->id) + 1),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
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
                        // ->visible(fn($record) => !$record->pkls()->exists()),
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
