<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'tech', 'color' => '#FF0000'],
            ['name' => 'social media', 'color' => '#00FF00'],
            ['name' => 'growth', 'color' => '#0000FF'],
            ['name' => 'management', 'color' => '#ff8633'],
            ['name' => 'call center', 'color' => '#33ff52'],
            ['name' => 'front end', 'color' => '#3383ff'],
            ['name' => 'back end', 'color' => '#ff33f9'],




        ];

        // Insert the categories into the database
        DB::table('categories')->insert($categories);
    }
}
