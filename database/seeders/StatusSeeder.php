<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        status::create([
            'name' => 'Relevado',
            'color' => 'primary',
            'Hex'=>'#1C46F0'
        ]);
        status::create([
            'name' => 'Abierto',
            'color' => 'Success',
            'Hex'=>'#0DF71F'
        ]);
        status::create([
            'name' => 'Paralizado',
            'color' => 'warning',
            'Hex'=>'#F8FC00'
        ]);
        status::create([
            'name' => 'Desarrollo',
            'color' => 'warning',
            'Hex'=>'#F8FC00'
        ]);
        status::create([
            'name' => 'Cerrado',
            'color' => 'danger',
            'Hex'=>'#FC0000'
        ]);
    }
}
