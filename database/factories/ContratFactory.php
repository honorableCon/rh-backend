<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'debut'=>$this->faker->date(),
            'fin'=>$this->faker->date(),
            'personnel_id'=>$this->faker->numberBetween(5, 20),
            'type_contrat_id'=>$this->faker->numberBetween(1, 10),
            'statut_id'=>$this->faker->numberBetween(1, 5),
        ];
    }
}