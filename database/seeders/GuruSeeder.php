<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $gurus = [
            [
                'nama' => 'Sugiarto, S.T.',
                'nip' => '197203172005011012',
                'gender' => 'laki-laki',
                'alamat' => 'Klaten',
                'kontak' => '085643188811',
            ],
            [
                'nama' => 'Yunianto Hermawan, S.Kom.',
                'nip' => '197306202006041005',
                'gender' => 'laki-laki',
                'alamat' => 'Klaten',
                'kontak' => '081548734649',
            ],
            [
                'nama' => 'Margaretha Endah Titisari, S.T.',
                'nip' => '197403022006042008',
                'gender' => 'perempuan',
                'alamat' => 'Pokoh, Maguwo',
                'kontak' => '085608990027',
            ],
            [
                'nama' => 'Eka Nur Ahmad Romadhoni, S.Pd.',
                'nip' => '199303012019031011',
                'gender' => 'laki-laki',
                'alamat' => 'Klaten',
                'kontak' => '085895780078',
            ],
            [
                'nama' => 'Rr. Retna Trimantaraningsih, S.T.',
                'nip' => '197006272021212002',
                'gender' => 'perempuan',
                'alamat' => 'Denggung',
                'kontak' => '0856436402427',
            ],
            [
                'nama' => 'Ratna Yunitasari, S.T.',
                'nip' => '197107082022211003',
                'gender' => 'perempuan',
                'alamat' => 'Gendeng Kidul',
                'kontak' => '085228771506',
            ],
        ];
        foreach ($gurus as $guru) {
            $partname = explode(' ',$guru['nama']);
            $parting = implode(' ', array_slice($partname, 0, 2));
            $email = Str::slug($parting, '.') . '@gmail.com';
            // $email = Str::slug($parting, '.') . rand(1, 99) . '@gmail.com';
            
            Guru::create([
                'nama' => $guru['nama'],
                'nip' => $guru['nip'],
                'gender' => $guru['gender'],
                'alamat' => $guru['alamat'],
                'kontak' => $guru['kontak'],
                'email' => $email,
            ]);
        }
    }
}
