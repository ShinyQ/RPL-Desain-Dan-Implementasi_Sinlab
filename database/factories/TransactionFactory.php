<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\User;

/**
 * @extends Factory
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::where('role', '!=', 'super_user')->get()->random()->id,
            'admin_id' => User::where('role', 'super_user')->get()->random()->id,
            'status' => $this->faker->randomElement(['Menunggu Persetujuan', 'Ditolak', 'Diterima']),
            'start_date' => Carbon::now(),
            'deadline' => Carbon::now()->addDays(rand(2, 5)),
            'reason' => $this->faker->sentence,
            'feedback' => $this->faker->sentence,
        ];
    }
}
