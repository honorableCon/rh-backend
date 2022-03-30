<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'cause_id' => $this->faker->numberBetween(1, 8),
            'personnel_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
