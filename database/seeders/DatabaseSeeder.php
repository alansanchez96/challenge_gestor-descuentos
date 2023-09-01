<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\{BrandSeeder, RegionSeeder, AccessTypeSeeder};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name'      => 'Test User',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password')
        ]);

        $this->call([
            BrandSeeder::class,
            RegionSeeder::class,
            AccessTypeSeeder::class,
            DiscountSeeder::class
        ]);
    }
}
