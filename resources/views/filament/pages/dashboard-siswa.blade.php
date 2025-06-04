<x-filament-panels::page>
    <div class="space-y-6">
        <h2 class="text-xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>

        @if ($siswa && in_array($siswa->status_pkl, ['aktif', 'tidak_aktif']) && $siswa->status_pkl === 'aktif')
            <div class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi PKL Anda</h3>
                
                @php
                    $pkl = $siswa->pkls()->latest()->first();
                    $industri = $pkl ? $pkl->industri : null;
                @endphp

                @if ($pkl && $industri)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Nama Industri</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $industri->nama }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Bidang Usaha</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $industri->bidang_usaha }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Guru Pembimbing</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $industri->guru->nama }}</p>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Tanggal Mulai</p>
                                <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($pkl->tanggal_mulai)->format('d F Y') }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Tanggal Selesai</p>
                                <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($pkl->tanggal_selesai)->format('d F Y') }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-400">Durasi PKL</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    @php
                                        $start = \Carbon\Carbon::parse($pkl->tanggal_mulai);
                                        $end = \Carbon\Carbon::parse($pkl->tanggal_selesai);
                                        $months = floor($start->diffInMonths($end));
                                        $remainingDays = $start->copy()->addMonths($months)->diffInDays($end);
                                    @endphp
                                    @if ($months > 0 && $remainingDays > 0)
                                        {{ $months }} bulan {{ $remainingDays }} hari
                                    @elseif ($months > 0)
                                        {{ $months }} bulan
                                    @elseif ($remainingDays > 0)
                                        {{ $remainingDays }} hari
                                    @else
                                        0 hari
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-sm text-gray-600">
                        Terjadi kesalahan dalam memuat data PKL.
                    </div>
                @endif
            </div>
        @else            
            <div class="flex items-center p-4 mb-4 text-sm text-danger-500 rounded-lg bg-red-50 dark:bg-gray-900 dark:text-danger-500" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Peringatan!</span> Anda belum terdaftar di industri manapun.
                </div>
            </div>

            @livewire(\App\Filament\Widgets\IndustriTable::class)

        @endif
    </div>
</x-filament-panels::page>
