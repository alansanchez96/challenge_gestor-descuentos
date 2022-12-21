<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->countryCode() . '-' . $this->faker->unique()->ean8(),
            'name' => $this->faker->unique()->country(),
            'display_order' => $this->faker->unique()->randomElement(['1', '2', '3', '4'])
        ];
    }
}
