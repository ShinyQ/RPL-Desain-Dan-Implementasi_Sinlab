<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        $data = [
            [
                'name' => "KURNIADI AHMAD WIJAYA",
                'email' => "kurniadiwijaya@student.telkomuniversity.ac.id",
                'role' => "super_user",
                'photo' => "https://lh3.googleusercontent.com/a-/AOh14Gj7NvAOn0zbz9VivYCcSJ5Ok8d91ULgZOJt6baCWw=s500-c",
                'created_at' => Carbon::now()->addHour()
            ],
            [
                'name' => "PRIYOGA ADITYA",
                'email' => "priyogaaditya@student.telkomuniversity.ac.id",
                'role' => "super_user",
                'photo'=> "",
                'created_at' => Carbon::now()->addHour()
            ],
        ];

        DB::table('users')->insert($data);
    }
}
