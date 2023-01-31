<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountRange;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::factory(rand(15, 30))->create();

        $discounts = Discount::all();

        foreach ($discounts as $discount) {
            DiscountRange::factory(rand(1, 3))->create([
                'from_days' => fake()->numberBetween(1, 15),
                'to_days' => fake()->numberBetween(16, 30),
                'discount' => fake()->numberBetween(15, 60),
                'code' => fake()->unique()->swiftBicNumber(),
                'discount_id' => fake()->unique()->numberBetween(1, $discounts->count())
            ]);
        }
    }
}
