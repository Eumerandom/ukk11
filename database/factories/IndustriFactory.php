<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Industri>
 */
class IndustriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Industri::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->company,
            'bidang_usaha' => $this->faker->word,
            'alamat' => $this->faker->address,
            'kontak' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,

            'guru_id' => Guru::inRandomOrder()->first()?->id,
        ];
    }
}
