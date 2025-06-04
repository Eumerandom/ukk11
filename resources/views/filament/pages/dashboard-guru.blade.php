<x-filament-panels::page x-data="{ activeTab: 'pkl' }">
    <div class="mb-4">
        <h2 class="text-xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>
    </div>

    <div class="fi-tabs flex overflow-x-auto items-center gap-x-1 bg-white dark:bg-gray-900 rounded-xl">
        <button 
            type="button" 
            x-on:click="$dispatch('tab-selected', 'pkl')" 
            :class="{ 'bg-primary-100 text-primary-600': activeTab === 'pkl' }"
            class="fi-tabs-item group flex items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium outline-none transition duration-75 hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5">
            Siswa yang Dibimbing
        </button>
        <button 
            type="button" 
            x-on:click="$dispatch('tab-selected', 'siswa')" 
            :class="{ 'bg-primary-100 text-primary-600': activeTab === 'siswa' }"
            class="fi-tabs-item group flex items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium outline-none transition duration-75 hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5">
            Daftar Siswa
        </button>
    </div>
    
    <div @tab-selected.window="activeTab = $event.detail">
        <div x-show="activeTab === 'pkl'" class="mt-4">
            @livewire(\App\Filament\Widgets\SiswaPKLTable::class)
        </div>
        <div x-show="activeTab === 'siswa'" class="mt-4">
            @livewire(\App\Filament\Widgets\SiswaOverview::class)
        </div>
    </div>

</x-filament-panels::page>