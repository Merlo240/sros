<?php

namespace Database\Factories;

use App\Models\Barrios;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallesFactory extends Factory
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
            'name' => $this->faker->unique()->word(22),
            'barrio_id' => Barrios::all()->random()->id
        ];
    }
}
