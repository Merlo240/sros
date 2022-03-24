<?php

namespace Database\Seeders;

use App\Models\Bacheos;
use App\Models\Barrios;
use App\Models\Calles;
use App\Models\status;
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
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(StatusSeeder::class);
        // Bacheos::factory(600)->create();
    }
}
