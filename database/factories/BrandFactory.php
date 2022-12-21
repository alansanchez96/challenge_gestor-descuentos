<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Avis', 'Budget', 'Payless']),
            'display_order' => $this->faker->unique()->randomElement(['10', '20', '30']),
            'active' => $this->faker->randomElement(['0', '1'])
        ];
    }
}
