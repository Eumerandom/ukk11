<?php

namespace App\Filament\Resources;

use App\Models\PKL;
use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use Filament\Forms\Set;
use App\Models\Industri;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\PKLResource\Pages;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PKLResource\RelationManagers;

class PKLResource extends Resource
{
    protected static ?string $model = PKL::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Informasi PKL';
    protected static ?string $slug = 'pkl';
    protected static ?string $label = 'Informasi PKL';

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    public static function form(Form $form): Form
    {
        // dd(Siswa::find(56));
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(2)->schema([

                        Hidden::make('siswa_id')
                            ->default(function () {
                                // return Siswa::where('user_id', Auth::id())->value('id');
                                $user = auth()->user();
                                $siswa = Siswa::where('email', $user->email)->first();
                                $usedId = PKL::pluck('siswa_id')->toArray();

                                if ($siswa && !in_array($siswa->id, $usedId)) {
                                    return $siswa->id;
                                }

                                return null;
                            })
                            ->required(),

                        TextInput::make('siswa_nama')
                            ->label('Nama Siswa')
                            ->default(function () {
                                // return Siswa::where('user_id', Auth::id())->value('nama') ?? 'Tidak ditemukan';
                                $user = auth()->user();
                                $siswa = Siswa::where('email', $user->email)->first();
                                return $siswa?->nama ?? '-';
                            })
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('nis')
                            ->label('NIS')
                            ->default(function () {
                                // return Siswa::where('user_id', Auth::id())->value('nis') ?? '-';
                                $user = auth()->user();
                                $siswa = Siswa::where('email', $user->email)->first();
                                return $siswa?->nis ?? '-';
                            })
                            ->disabled()
                            ->dehydrated(false),

                        Select::make('industri_id')
                            ->label('Industri')
                            ->relationship('industri', 'nama')
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                $guruId = Industri::find($state)->guru_id;
                                $set('guru_id', $guruId);
                                $set('guru_nama', Industri::find($state)->guru->nama);
                            })
                            ->afterStateHydrated(function ($state, Set $set) {
                                $industri = Industri::find($state);
                                if ($industri && $industri->guru) {
                                    $set('guru_id', $industri->guru_id);
                                    $set('guru_nama', $industri->guru->nama);
                                }
                            })
                            ->required(),
                        Hidden::make('guru_id'),
                        TextInput::make('guru_nama')
                            ->label('Guru Pembimbing')
                            ->disabled(true)
                            ->dehydrated(false),

                        DatePicker::make('tanggal_mulai')
                            ->required()
                            ->live(),
                        DatePicker::make('tanggal_selesai')
                            ->required()
                            ->minDate(fn(Forms\Get $get) => $get('tanggal_mulai'))
                            ->dehydrated(),
                    ]),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->hasRole('siswa')) {
            $siswaId = auth()->user()?->siswa?->id;
            return $query->where('siswa_id', $siswaId);
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No')
                    ->getStateUsing(fn($record) => PKL::orderBy('id')
                        ->pluck('id')->search($record->id) + 1)
                    ->hidden(auth()->user()->hasRole('siswa')),
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
                    ->date()
                    ->label('Tanggal Mulai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->label('Tanggal Selesai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('durasi_pkl')
                    ->label('Durasi PKL')
                    ->default('-')
                    ->formatStateUsing(function ($record) {
                        if (!$record->tanggal_mulai || !$record->tanggal_selesai) {
                            return '-';
                        }

                        $start = \Carbon\Carbon::parse($record->tanggal_mulai);
                        $end = \Carbon\Carbon::parse($record->tanggal_selesai);

                        $months = floor($start->diffInMonths($end));
                        // Menambahkan bulan ke tanggal awal untuk mendapatkan sisa hari
                        $remainingDays = $start->copy()->addMonths($months)->diffInDays($end);

                        if ($months > 0 && $remainingDays > 0) {
                            return $months . ' bulan ' . $remainingDays . ' hari';
                        } elseif ($months > 0) {
                            return $months . ' bulan';
                        } elseif ($remainingDays > 0) {
                            return $remainingDays . ' hari';
                        }
                        return '0 hari';
                    }),

            ])->filters([
                    //
                ])->headerActions([
                    //
                ])->actions([
                    //
                ])->bulkActions([
                    //
                ])
            ->filters([
                SelectFilter::make('industri_id')
                    ->relationship('industri', 'nama')
                    ->label('Industri'),
                SelectFilter::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->label('Guru Pembimbing'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPKLS::route('/'),
            'create' => Pages\CreatePKL::route('/create'),
            'edit' => Pages\EditPKL::route('/{record}/edit'),
            'view' => Pages\ViewPKL::route('/{record}/view'),
        ];
    }
}
