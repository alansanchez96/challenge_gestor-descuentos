<?php

namespace Database\Factories;

use App\Models\AccessType;
use App\Models\Brand;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(5),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'priority' => $this->faker->numberBetween(1, 1000),
            'active' => $this->faker->randomElement(['1', '0']),
            'region_id' => Region::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'access_type_code' => AccessType::all()->random()->code
        ];
    }
}
