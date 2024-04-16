<?php

namespace Database\Seeders;

use App\Models\FitnessCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            ['name' => 'Sauna', 'price' => '1200'],
            ['name' => 'Yoga', 'price' => '1500'],
            ['name' => 'Cardio', 'price' => '1800'],
            ['name' => 'Fitness', 'price' => '1500'],
            
        ];

        foreach ($categoriesData as $category) {
            FitnessCategories::create($category);
        }
    }
}
