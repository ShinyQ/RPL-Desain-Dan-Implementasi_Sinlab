<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Item;

/**
 * @extends Factory
 */
class TransactionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_id' => Transaction::all()->random()->id,
            'item_id' => Item::all()->random()->id,
            'qty' => rand(1, 5)
        ];
    }
}
