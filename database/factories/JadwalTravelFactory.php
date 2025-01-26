<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalTravel>
 */
class JadwalTravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destinasi' => $this->faker->name(),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
            'harga_tiket' => $this->faker->randomNumber(),
            'kuota' => $this->faker->randomNumber(),
        ];
    }
}
