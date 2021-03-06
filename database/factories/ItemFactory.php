<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
            'description' => $this->faker->sentence,
            'photo' => 'https://picsum.photos/300/300?nocache='. microtime(),
            'qty' => rand(1,20),
        ];
    }
}
