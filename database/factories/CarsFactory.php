<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cars>
 */
class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company,
            'color' => fake()->colorName,
            'm_date' => fake()->date,
            'price' =>fake()->numberBetween(1000,999),
            'transmission' => fake()->randomElement(['automatic', 'manual', 'electric']),
        ];
    }
}
