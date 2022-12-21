<?php

namespace Database\Seeders;

use App\Models\AccessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessType::factory(3)->create();
    }
}
