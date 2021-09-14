<?php

namespace Database\Seeders;

use App\Models\Call;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Call::factory()->count(50)->create();
    }
}
