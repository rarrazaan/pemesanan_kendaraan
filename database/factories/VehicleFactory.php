<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        return [
            'name' => $faker->vehicle,
            'jenis_angkut' => fake()->randomElement(['Angkut Barang', 'Angkut Orang']),
            'pemilik' => fake()->randomElement(['Milik Perusahaan', 'Sewa']),
            'konsumsi_BBM' => rand(30, 500),
            'jadwal_service' => fake()->dateTimeBetween('+0 days', '+2 years'),
            'riwayat_pemakaian' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        ];
    }
}