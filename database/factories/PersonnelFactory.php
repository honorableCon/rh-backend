<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cni' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'nom' => $this->faker->name(),
            'naissance' => $this->faker->date(),
            'sexe' => $this->faker->randomElement(['M', 'F']),
            'nationalite' => $this->faker->country(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'enfant' => $this->faker->randomDigit,
            'conjoint' => $this->faker->randomDigit,
            'filiere_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
