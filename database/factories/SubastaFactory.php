<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subasta>
 */
class SubastaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(),
            'cantidad' => $this->faker->numberBetween($min = 1, $max = 100), 
            'puja' => $this->faker->numberBetween($min = 1, $max = 100), 
            'precio' => $this->faker->numberBetween($min = 1, $max = 100), 
            'fecha_limite' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 month'),
        ];
    }
}
