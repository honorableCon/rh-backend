<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->name(),
            'debut' => $this->faker->date(),
            'fin' => $this->faker->date(),
            'structure_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
