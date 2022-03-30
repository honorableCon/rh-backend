<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatutFactory extends Factory
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
        ];
    }
}
