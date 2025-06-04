<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $siswas = [
            [
                'nama' => 'Abu Bakar Tsabit Ghufron',
                'nis' => '20388',
            ],
            [
                'nama' => 'Ade Rafif Daneswara',
                'nis' => '20389',
            ],
            [
                'nama' => 'Ade Zaidan Althaf',
                'nis' => '20390',
            ],
            [
                'nama' => 'Adhwa Khalila Ramadhani',
                'nis' => '20391',
            ],
            [
                'nama' => 'Adnan Faris',
                'nis' => '20392',
            ],
            [
                'nama' => 'Ahmad Hanaffi Rahmadhani',
                'nis' => '20393',
            ],
            [
                'nama' => 'Akbar Adha Kusumawardhana',
                'nis' => '20394',
            ],
            [
                'nama' => 'Andhika August Farnaz',
                'nis' => '20395',
            ],
            [
                'nama' => 'Angelina Thithis Sekar Langit',
                'nis' => '20396',
            ],
            [
                'nama' => 'Arifin Nur Ihsan',
                'nis' => '20397',
            ],
        ];

        foreach ($siswas as $siswa) {
            $partname = explode(' ',$siswa['nama']);
            $parting = implode(' ', array_slice($partname, 0, 2));
            $email = Str::slug($parting, '.') . '@gmail.com';
            // $email = Str::slug($parting, '.') . rand(1, 99) . '@gmail.com';

            Siswa::create([
                'nama' => $siswa['nama'],
                'nis' => $siswa['nis'],
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
                'email' => $email,
            ]);
        }
    }
}
