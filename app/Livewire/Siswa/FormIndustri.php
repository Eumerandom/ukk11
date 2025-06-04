<?php

namespace App\Livewire\siswa;

use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class FormIndustri extends Component implements HasForms
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
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
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
                        Forms\Components\TextInput::make('bidang_usaha')
                            ->required()
                            ->maxLength(255)
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
                        Forms\Components\TextInput::make('kontak')
                            ->required()
                            ->rules(['regex:/^\+62[0-9]{8,13}$/'])
                            ->maxLength(15)
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
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'industris')
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
                    Forms\Components\TextInput::make('alamat')
                        ->required()
                        ->maxLength(65535)
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
                    Forms\Components\Select::make('guru_id')
                        ->label('Guru Pembimbing')
                        ->relationship('guru', 'nama')
                        ->required()
                        ->exists('gurus', 'id')
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
                ])
            ->statePath('data')
            ->model(Industri::class);
    }

    public function create(): void
    {
        DB::beginTransaction();
        try {
            $data = $this->form->getState();
            $record = Industri::create($data);
            $this->form->model($record)->saveRelationships();

            DB::commit();

            $this->dispatch('close-modal', id: 'form-industri-modal');
            session()->flash('created', 'Industri berhasil ditambahkan.');
            $this->redirect('/daftar-industri');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menambahkan data industri: ' . $e->getMessage());
        }
    }

    public function render(): View
    {
        return view('livewire.siswa.form-industri');
    }
}
