<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonnelFonctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'debut' => $this->faker->date(),
            'fin' => $this->faker->date(),
            'personnel_id' => $this->faker->numberBetween(5, 10),
            'fonction_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
