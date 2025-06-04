<div>
    <!-- alert block -->
    @if ($siswa && $siswa->status_pkl === 'aktif')
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
        <livewire:siswa.tabel-pkl></livewire:siswa.tabel-pkl>
    @else
        <div class="row">
            <div class="flex">
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

                <!-- Modal toggle -->
                <button data-modal-target="form-industri-modal" data-modal-toggle="form-industri-modal"
                    class="block w-40 h-13 font-medium rounded-lg text-sm ml-4 me-2 mb-2 text-white bg-green-600 hover:bg-green-700 border border-gray-200 shadow-sm dark:bg-green-700 dark:hover:bg-green-800 dark:border-green-700 focus:outline-none"
                    type="button">
                    Tambah Industri
                </button>
            </div>

            <!-- form-industri modal -->
            <!-- backgroundnya benerin euy -->
            <div id="form-industri-modal" tabindex="-1" aria-hidden="true"
                class="hidden !bg-white/30 backdrop-blur-sm overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] !max-h-screen">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-zinc-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Silakan isi data industri
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                data-modal-hide="form-industri-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <livewire:siswa.form-industri></livewire:siswa.form-industri>
                        </div>
                    </div>
                </div>
            </div>

            <!-- form-pkl modal -->
            <!-- backgroundnya benerin euy -->
            <div id="form-modal" tabindex="-1" aria-hidden="true"
                class="hidden !bg-white/30 backdrop-blur-sm overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] !max-h-screen">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-zinc-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Silakan isi data anda
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                data-modal-hide="form-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <livewire:siswa.form-pkl></livewire:siswa.form-pkl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- search bar -->
        <form class="flex items-center max-w-full mx-auto mb-4">
            <div class="relative w-full">
                <input type="search" wire:model.live="search" id="search-dropdown"
                    class="block p-2.5 w-full z-20 text-sm text-zinc-900 bg-white rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 hover:border-gray-400 dark:bg-zinc-900 dark:border-zinc-700 dark:hover:border-zinc-600 dark:focus:border-zinc-600 dark:placeholder-zinc-400 dark:text-white"
                    placeholder="Search Industri ..." />
            </div>
            <div class="relative inline-block ml-4">
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" data-dropdown-placement="bottom-end"
                    class="text-sm bg-white border border-gray-300 dark:bg-zinc-900 dark:border-zinc-700 py-2.5 px-3 flex items-center rounded-lg" type="button">
                    Sort
                    <svg class="ml-3 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25" />
                    </svg>
                </button>
                <div id="dropdown" wire:key="sort-dropdown"
                    class="z-10 hidden absolute top-full right-0 mt-1 bg-white rounded-lg shadow w-44 dark:bg-zinc-900 border border-gray-300 dark:border-zinc-700">
                    <div class="p-3">
                        <div class="flex flex-col">
                            <button wire:click="setSort('asc')" type="button" data-dropdown-hide="dropdown"
                                class="flex text-sm items-center w-full gap-1 p-2 rounded-lg {{ $sort === 'asc' ? 'bg-gray-100 dark:bg-zinc-800' : '' }} hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5m0 6 4 4 4-4" />
                                </svg>
                                <span class="text-sm">A-Z</span>
                            </button>
                            <button wire:click="setSort('desc')" type="button" data-dropdown-hide="dropdown" 
                                class="flex text-sm items-center w-full gap-1 p-2 mt-1 rounded-lg {{ $sort === 'desc' ? 'bg-gray-100 dark:bg-zinc-800' : '' }} hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 5 4-4 4 4M1 11l4 4 4-4" />
                                </svg>
                                <span class="text-sm">Z-A</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- industri card -->
        <div class="grid grid-cols-2 gap-5 gap-y-1.5" wire:loading.class="opacity-50">
            <div wire:loading.flex wire:target="setSort, search"
                class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700/50 backdrop-blur-sm flex flex-col items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-white border-t-transparent"></div>
                <h2 class="text-center text-white text-xl font-semibold mt-4">Memproses...</h2>
            </div>
            @foreach ($industris as $industri)
                <div
                    class="mb-5 h-30 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-zinc-900 dark:border-zinc-700">
                    <div class="p-2.5 inline-flex">
                        <div class="mr-5 w-25 h-25 aspect-square">
                            <a href="#">
                                <img class="rounded-lg h-25 w-25 aspect-square"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ718nztPNJfCbDJjZG8fOkejBnBAeQw5eAUA&s"
                                    alt="" />
                            </a>
                        </div>

                        <div class="flex flex-col justify-between">
                            <h5 class="mb-2 !line-clamp-1 text-md font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $industri->nama }}
                            </h5>
                            <p class="inline-flex !line-clamp-1 text-sm font-normal text-gray-700 dark:text-gray-400">
                                <span class="font-medium">Bidang</span>: {{ Str::limit($industri->bidang_usaha, 40) }}
                            </p>

                            <p class="mb-1 inline-flex !line-clamp-1 text-sm font-normal text-gray-700 dark:text-gray-400">
                                <span class="font-medium">Alamat</span>: {{ Str::limit($industri->alamat, 40) }}
                            </p>

                            <button data-modal-target="industri-modal-{{ $industri->id }}"
                                data-modal-toggle="industri-modal-{{ $industri->id }}"
                                class="mb-2 inline-flex items-center text-xs font-medium text-center text-blue-600 focus:outline-none"
                                type="button">
                                Read more
                            </button>

                        </div>
                    </div>
                </div>

                <!-- industri modal -->
                <div id="industri-modal-{{ $industri->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ $industri->nama }}
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="industri-modal-{{ $industri->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4 max-h-screen">

                                <div class="flex">
                                    <div class="w-1/4 h-full aspect-square">
                                        <img class="rounded-lg w-full h-full m-0 aspect-square"
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ718nztPNJfCbDJjZG8fOkejBnBAeQw5eAUA&s"
                                            alt="" />
                                    </div>

                                    <div class="w-3/4 px-5">
                                        <div class="w-full">
                                            <p class="font-medium mb-0 pb-0 text-gray-700 dark:text-gray-300">
                                                Bidang Usaha
                                            </p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{ $industri->bidang_usaha }}
                                            </p>
                                        </div>

                                        <div class="columns-2 w-full">
                                            <p class="font-medium mb-0 pb-0 text-gray-700 dark:text-gray-300">
                                                Kontak
                                            </p>
                                            <p class="text-base leading-relaxed mb-5 text-gray-500 dark:text-gray-400">
                                                {{ $industri->kontak }}
                                            </p>
                                            <p class="font-medium mb-0 pb-0 text-gray-700 dark:text-gray-300">
                                                Email
                                            </p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                {{ $industri->email }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <div>
                                    <p class="font-medium mb-0 pb-0 text-gray-700 dark:text-gray-300">
                                        Alamat Industri
                                    </p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        {{ $industri->alamat }}
                                    </p>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-target="form-modal" data-modal-toggle="form-modal"
                                    data-modal-hide="industri-modal-{{ $industri->id }}" type="button"
                                    class="font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-auto text-white bg-green-700 hover:bg-green-800 focus:ring-none focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $industris->links() }}
        </div>
    @endif
</div>
