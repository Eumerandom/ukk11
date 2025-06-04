<?php

namespace App\Livewire\siswa;

use App\Models\PKL;
use Filament\Forms;
use App\Models\Siswa;
use Filament\Forms\Set;
use Livewire\Component;
use App\Models\Industri;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class FormPkl extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                        ->dehydrated(false)
                        ->columnSpan(1)
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),

                    TextInput::make('nis')
                        ->label('NIS')
                        ->default(function () {
                            // return Siswa::where('user_id', Auth::id())->value('nis') ?? '-';
                            $user = auth()->user();
                            $siswa = Siswa::where('email', $user->email)->first();
                            return $siswa?->nis ?? '-';
                        })
                        ->disabled()
                        ->dehydrated(false)
                        ->columnSpan(1)
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),

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
                        ->required()
                        ->columnSpan(1)
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),

                    Hidden::make('guru_id'),
                    TextInput::make('guru_nama')
                        ->label('Guru Pembimbing')
                        ->disabled(true)
                        ->dehydrated(false)
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),

                    DatePicker::make('tanggal_mulai')
                        ->required()
                        ->live()
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),
                    DatePicker::make('tanggal_selesai')
                        ->required()
                        ->minDate(fn(Forms\Get $get) => $get('tanggal_mulai'))
                        ->dehydrated()
                        ->extraInputAttributes([
                            'class' => '
                                bg-white
                                border border-zinc-300 
                                text-zinc-900 text-sm 
                                rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 

                                block 
                                w-full 
                                p-2.5 

                                dark:bg-zinc-700 
                                dark:border-zinc-600 
                                dark:placeholder-zinc-400 
                                dark:text-white 
                                dark:focus:ring-blue-500 
                                dark:focus:border-blue-500
                            '
                        ]),
                ]),
            ])
            ->statePath('data')
            ->model(PKL::class);
    }

    public function create()
    {
        // $data = $this->form->getState();
        // $record = PKL::create($data);

        // $this->form->model($record)->saveRelationships();

        // session()->flash('created', 'Data PKL berhasil ditambahkan.');
        // return redirect()->route('dashboard');
        $data = $this->form->validate();

        $rules = [
            'data.siswa_id' => 'required',
            'data.industri_id' => 'required',
            'data.guru_id' => 'required',
            'data.tanggal_mulai' => 'required|date',
            'data.tanggal_selesai' => 'required|date|after:data.tanggal_mulai'
        ];

        $messages = [
            'data.siswa_id.required' => 'Data siswa belum terisi',
            'data.industri_id.required' => 'Silakan pilih industri',
            'data.guru_id.required' => 'Data guru pembimbing belum terisi',
            'data.tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'data.tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'data.tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai'
        ];

        $this->validate($rules, $messages);

        DB::beginTransaction();
        try {
            $data = $this->form->getState();
            $record = PKL::create($data);
            $this->form->model($record)->saveRelationships();

            DB::commit();

            $this->dispatch('close-modal', id: 'form-modal');
            session()->flash('created', 'Data PKL berhasil ditambahkan.');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menambahkan data PKL: ' . $e->getMessage());
        }
    }

    public function render(): View
    {
        return view('livewire.siswa.form-pkl');
    }
}
