<div class="space-y-6">
    @if (session()->has('created'))
        <div x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 3000)" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            id="toast-success" 
            class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-green-500 bg-green-100 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" 
            role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Success icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('created') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    @if (session()->has('deleted'))
        <div x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 3000)" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            id="toast-danger" 
            class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-red-500 bg-red-100 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" 
            role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('deleted') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

    <h2 class="text-xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>

    @if ($siswa && $siswa->status_pkl === 'aktif' && $pkl->industri)
        <div class="flex items-center p-4 mb-4 text-sm text-primary-500 rounded-lg bg-cyan-50 dark:bg-cyan-800 dark:text-white"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                Anda sudah terdaftar di industri <span class="font-medium">{{ $pkl->industri->nama }}</span>.
            </div>
        </div>
    @else
        <div class="flex mb-0">
            <div class="flex items-center w-full p-4 mb-4 text-sm text-danger-500 rounded-lg bg-red-100 dark:bg-red-700 dark:text-danger-500"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Peringatan!</span> Anda belum terdaftar di industri manapun.
                </div>
            </div>

            <button
                class="block w-40 h-13 font-medium rounded-lg text-sm ml-4 me-2 text-white bg-green-600 hover:bg-green-700 border border-gray-200 shadow-sm dark:bg-green-700 dark:hover:bg-green-800 dark:border-green-700 focus:outline-none"
                type="button">
                <a href="{{ route('daftar-industri') }}" class="block">Pilih Industri</a>
            </button>
        </div>
    @endif


    <div class="p-6 bg-white dark:bg-zinc-900 border border-gray-400 dark:border-none rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Siswa</h3>

        @if ($siswa)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nama Siswa</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $siswa->nama }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Gender Siswa</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(strtolower($siswa->gender)) }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nomor Induk Sekolah</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $siswa->nis }}</p>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Email Siswa</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $siswa->email }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Kontak Siswa</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $siswa->kontak }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Alamat Siswa</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $siswa->alamat }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-sm text-gray-600">
                Terjadi kesalahan dalam memuat data PKL.
            </div>
        @endif
    </div>

    @if ($siswa && $siswa->status_pkl === 'aktif')
        <div class="p-6 bg-white dark:bg-zinc-900 border border-gray-400 dark:border-none rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi PKL</h3>

            @if ($pkl)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        @if($pkl->industri)
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nama Industri</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pkl->industri->nama }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Bidang Usaha</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pkl->industri->bidang_usaha }}</p>
                            </div>
                        @endif
                        @if($pkl->guru)
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Guru Pembimbing</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pkl->guru->nama }}</p>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Mulai</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($pkl->tanggal_mulai)->format('d F Y') }}
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Selesai</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($pkl->tanggal_selesai)->format('d F Y') }}
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Durasi PKL</p>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                @if ($pkl && $pkl->tanggal_mulai && $pkl->tanggal_selesai)
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
        <div class="row">
            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Batalkan PKL
            </button>
        </div>

        <!-- Delete confirmation modal -->
        <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-800 dark:text-gray-400">Apakah anda yakin ingin menghapus data PKL ini?</h3>
                        <button wire:click="delete({{ $pkl->id }})" data-modal-hide="delete-modal" type="button" class="w-32 text-red-500 hover:text-white bg-white hover:bg-red-500 border border-red-500 focus:ring-0 focus:outline-none outline-none ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Ya
                        </button>
                        <button data-modal-hide="delete-modal" type="button" class="w-32 text-white bg-green-500 hover:bg-green-600 border border-green-500 hover:border-green-700 focus:ring-0 focus:outline-none rounded-lg text-sm font-medium px-5 py-2.5 focus:z-10">
                            Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
