<?php

namespace App\Console\Commands;

use App\Models\Siswa;
use Illuminate\Console\Command;

class UpdateSiswaStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // ini commandnya
    protected $signature = 'siswa:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status PKL semua siswa berdasarkan data yang ada';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Memulai update status PKL siswa...');
        $bar = $this->output->createProgressBar(Siswa::count());

        $siswas = Siswa::all();
        foreach ($siswas as $siswa) {
            $oldStatus = $siswa->status_pkl;
            $siswa->updatePKLStatus();
            
            if ($oldStatus !== $siswa->status_pkl) {
                $this->line("\nStatus PKL {$siswa->nama} berubah dari '{$oldStatus}' menjadi '{$siswa->status_pkl}'");
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nUpdate status PKL siswa selesai!");
    }
}
