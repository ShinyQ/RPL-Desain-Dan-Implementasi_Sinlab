<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(RequestItemSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(TransactionItemSeeder::class);
    }
}
