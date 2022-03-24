<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     //                                      primary       Success   warning      warning       danger
        //     'name' => $this->faker->randomElement(['Relevado', 'Abierto', 'Paralizado', ' Desarrollo', 'Cerrado']),
        //     'color' => $this->faker->randomElement(['primary', 'success', 'danger', 'warning'])
        // ];
    }
}
