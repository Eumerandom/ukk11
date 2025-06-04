<div>
    <div id="filterHeader"
        class="flex flex-row gap-2 items-center pt-5 sticky top-5 z-50 transition-all duration-300 w-full">
        {{-- Search Bar --}}
        <flux:field class="relative flex-grow bg-white dark:bg-black rounded-xl shadow-sm">
            <flux:icon.magnifying-glass class="absolute right-2 z-50 top-2"></flux:icon.search>
                <flux:input wire:model.live="search" placeholder="Masukan nama produk " />
        </flux:field>

        {{-- Button Filter--}}
        <div class="relative flex-shrink-0">
            <button wire:click="toggle"
                class="flex items-center border gap-2 px-3 py-2 text-black dark:text-white text-sm font-medium w-full bg-white dark:bg-neutral-900 dark:border-zinc-800 rounded-md /*hover:bg-slate-100*/">
                <flux:icon.funnel class="text-black dark:text-white"></flux:icon.funnel>
                Filter
            </button>

            {{-- Dropdown Filter --}}
            @if ($open)
                <div
                    class="absolute z-10 w-64 sm:w-80 right-0 top-12 bg-white dark:bg-black border dark:border-zinc-800 rounded-lg p-4 shadow-lg">
                    <div class="space-y-4">
                        <flux:field label="Bidang Usaha">
                            <flux:select wire:model.live="filter">
                                <option value="">Bidang Usaha</option>
                                @foreach($industris as $industri)
                                    <option value="{{$industri->bidang_usaha}}">{{$industri->bidang_usaha}}</option>
                                @endforeach
                            </flux:select>

                        </flux:field>
                    </div>
                </div>
            @endif
        </div>

        @if (is_null($industris))
            <p>kosong wak</p>
        @else
            @foreach ($industris as $industri)

                <div class="mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-zinc-900 dark:border-zinc-700">
                    <!-- <a href="#">
                                            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                                        </a> -->
                    <div class="p-5 inline-flex">
                        <div class="mr-5">
                            <a href=" #">
                                <img class="rounded-t-lg w-40 h-40"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ718nztPNJfCbDJjZG8fOkejBnBAeQw5eAUA&s"
                                    alt="" />
                            </a>
                        </div>

                        <div class="flex flex-col justify-between">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $industri->nama }}
                                </h5>
                            </a>
                            <p class="mb-2 inline-flex ont-normal text-gray-700 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2 lucide lucide-pencil-ruler-icon lucide-pencil-ruler">
                                    <path d="M13 7 8.7 2.7a2.41 2.41 0 0 0-3.4 0L2.7 5.3a2.41 2.41 0 0 0 0 3.4L7 13" />
                                    <path d="m8 6 2-2" />
                                    <path d="m18 16 2-2" />
                                    <path d="m17 11 4.3 4.3c.94.94.94 2.46 0 3.4l-2.6 2.6c-.94.94-2.46.94-3.4 0L11 17" />
                                    <path
                                        d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                    <path d="m15 5 4 4" />
                                </svg>
                                {{ $industri->bidang_usaha }}
                            </p>

                            <p class="mb-2 inline-flex font-normal text-gray-700 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-2 lucide lucide-map-pin-icon lucide-map-pin">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{ $industri->alamat }}
                            </p>

                            <p class="mb-2 inline-flex font-normal text-gray-700 dark:text-gray-400">
                                {{ $industri->deskripsi }}
                            </p>

                            <a href="#"
                                class="inline-flex items-center max-w-30 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

            @endforeach
        @endif

    </div>