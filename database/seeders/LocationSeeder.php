<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('locations')->insert([
            ['name' => 'Location 1', 'latitude' => 51.505, 'longitude' => -0.09],
            ['name' => 'Location 2', 'latitude' => 51.515, 'longitude' => -0.1],
            // Add more locations as needed
        ]);
    }
}
