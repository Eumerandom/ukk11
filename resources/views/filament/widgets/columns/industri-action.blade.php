@php
    $user = auth()->user();
    $siswa = $user->hasRole('siswa') ? $user->siswa : null;
    $status = $siswa?->status_pkl;
@endphp

@if (!$siswa || is_null($status))
    <div class="flex justify-center">
        <a 
            href="{{ \App\Filament\Resources\PKLResource::getUrl('create', ['industri_id' => $getRecord()->id]) }}"
            class="filament-button filament-button-size-md inline-flex items-center justify-center py-2 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
        >
            Daftar PKL
        </a>
    </div>
@elseif ($status == 'tidak_aktif')
    <div class="flex justify-center">
        <a 
            href="{{ \App\Filament\Resources\PKLResource::getUrl('create', ['industri_id' => $getRecord()->id]) }}"
            class="filament-button filament-button-size-md inline-flex items-center justify-center py-2 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
        >
            Daftar PKL
        </a>
    </div>
@elseif ($status == 'aktif')
    <div class="flex justify-center">
        <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-500 bg-gray-100 rounded-lg">
            Sudah Terdaftar
        </span>
    </div>
@endif
