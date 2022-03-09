<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory
 */
class RequestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=> User::where('role', 'user')->get()->random()->id,
            'admin_id'=> User::where('role','super_user')->get()->random()->id,
            'name' => $this->faker->streetName,
            'description' => $this->faker->sentence,
            'qty' => rand(1,5),
            'status' => $this->faker->randomElement(['Menunggu Persetujuan','Ditolak','Diterima']),
        ];
    }
}
