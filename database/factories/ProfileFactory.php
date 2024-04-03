<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $user_id = 1;
        return [
            'id' => $this->faker->numberBetween($min = 1, $max = 2),
            'cantidad_producto' => $this->faker->numberBetween($min = 1, $max = 100),
            'oro' => 1000,
            'user_id' => $user_id++,
            'producto_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
