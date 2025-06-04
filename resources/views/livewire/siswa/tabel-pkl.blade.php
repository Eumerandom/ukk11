<div
    class="shadow-md rounded-lg">

    <div class="pb-3 bg-white dark:bg-zinc-900 rounded-lg shadow">
        @if ($pkl)
            <table class="table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 bg-gray-100 dark:bg-zinc-900 dark:text-white">
                    <tr>
                        <th scope="col" class="w-[5%] p-3 text-left">No</th>
                        <th scope="col" class="w-[22%] p-3 text-left">Nama Siswa</th>
                        <th scope="col" class="w-[22%] p-3 text-left">Industri</th>
                        <th scope="col" class="w-[22%] p-3 text-left">Bidang Usaha</th>
                        <th scope="col" class="w-[16%] p-3 text-left">Durasi PKL</th>
                        <th scope="col" class="w-[11%] p-3 text-left">Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <tr
                        class="bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-600 text-gray-900 dark:text-white">
                        <td class="p-3 text-center">1</td>
                        <td class="py-3 text-center">{{ $pkl->siswa->nama }}</td>
                        <td class="py-3 text-center">{{ $pkl->industri->nama }}</td>
                        <td class="py-3 text-center">{{ $pkl->industri->bidang_usaha }}</td>
                        <td class="py-3 text-center">
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
                        </td>
                        <td class="py-3 text-center">
                            <button wire:click="delete({{ $pkl->id }})"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="text-red-500 hover:underline">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        @else
            <div class="text-sm text-gray-600">
                Terjadi kesalahan dalam memuat data PKL.
            </div>
        @endif
    </div>
</div>`