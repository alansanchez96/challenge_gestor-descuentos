<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccessType>
 */
class AccessTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => Str::upper($this->faker->unique()->randomLetter()),
            'name' => $this->faker->unique()->randomElement(['Cliente Final', 'Corporativo', 'Agencia']),
            'display_order' => $this->faker->unique()->biasedNumberBetween(0, 40)    
        ];
    }
}
