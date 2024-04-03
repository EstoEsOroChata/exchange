<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsersProductos>
 */
class UsersProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 2), 
            'producto_id' => $this->faker->numberBetween($min = 1, $max = 10), 
            'cantidad' => $this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
