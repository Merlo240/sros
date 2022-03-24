<?php

namespace Database\Factories;

use App\Models\Calles;
use App\Models\status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BacheosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            // 'calle_id' => Calles::all()->random()->id,
            // 'numeracion' => $this->faker->numerify('####'),
            // 'largo' => $this->faker->numerify('##,##'),
            // 'ancho' => $this->faker->numerify('#,##'),
            // 'mts' => $this->faker->numerify('##,##'),
            // 'status_id' => status::all()->random()->id,
            // 'user_id' => User::all()->random()->id
        ];
    }
}
