<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Brand;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\RegionSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\AccessTypeSeeder;

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
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $this->call(BrandSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(AccessTypeSeeder::class);
    }
}
