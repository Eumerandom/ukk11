<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Industri::factory()->count(10)->create();

        $industris =[
            [
                'nama' => 'PT Aksa Digital Group', 
                'bidang_usaha' => 'IT Service and IT Consulting (Information Technology Company)',
                'alamat' => 'Jl. Wongso Permono No.26, Klidon, Sukoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'kontak' => '08982909000',
                'email' => 'aksa@gmail.com',
            ],
            [
                'nama' => 'PT. Gamatechno Indonesia', 
                'bidang_usaha' => 'Penyedia layanan, solusi, dan produk inovasi teknologi informasi serta holding company yang melahirkan startup di bidang teknologi informasi.',
                'alamat' => 'Jl. Purwomartani, Karangmojo, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'kontak' => '0274-5044044',
                'email' => 'info@gamatechno.com',
            ],
            [
                'nama' => 'CV. Karya Hidup Sentosa ', 
                'bidang_usaha' => 'Alat pertanian',
                'alamat' => 'Jl. Magelang KM.8,8, Jongke Tengah, Sendangadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55285',
                'kontak' => '0274-512095',
                'email' => 'quick@gmail.com',
            ],
            [
                'nama' => 'PT. Mega Andalan Kalasan',
                'bidang_usaha' => 'Manufacturing',
                'alamat' => 'Jl. Raya Kalasan, Sleman, DIY',
                'kontak' => '0274-123456',
                'email' => 'info@makalasan.com',
            ],
            [
                'nama' => 'Kotagede Silver Crafts',
                'bidang_usaha' => 'Silver Craft',
                'alamat' => 'Jl. Kemasan, Kotagede, Yogyakarta',
                'kontak' => '0274-654321',
                'email' => 'kotagede.silver@gmail.com',
            ],
            [
                'nama' => 'GMEDIA',
                'bidang_usaha' => 'IT & Digital',
                'alamat' => 'Jl. Merapi No. 10, Yogyakarta',
                'kontak' => '0274-987654',
                'email' => 'contact@gmedia.com',
            ],
            [
                'nama' => 'PT. Woonel Midas Leathers',
                'bidang_usaha' => 'Leather Industry',
                'alamat' => 'Jl. Wonosari, Bantul, DIY',
                'kontak' => '0274-998877',
                'email' => 'info@woonel.com',
            ],
            [
                'nama' => 'CV. Mitra Teknitama',
                'bidang_usaha' => 'General Trading & Manufacturing',
                'alamat' => 'Jl. Magelang, Sleman, DIY',
                'kontak' => '0274-776655',
                'email' => 'mitra@teknitama.com',
            ],
            [
                'nama' => 'Gerabah Kasongan',
                'bidang_usaha' => 'Ceramics Craft',
                'alamat' => 'Kasongan, Bantul, DIY',
                'kontak' => '0274-554433',
                'email' => 'contact@kasongan.com',
            ],
        ];

        foreach ($industris as $industri) {
            Industri::create([
                'nama' => $industri['nama'], 
                'bidang_usaha' => $industri['bidang_usaha'],
                'alamat' => $industri['alamat'],
                'kontak' => $industri['kontak'],
                'email' => $industri['email'],
                'guru_id' => Guru::inRandomOrder()->first()?->id
            ]);
        }
    }
}
