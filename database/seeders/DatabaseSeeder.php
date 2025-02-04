<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserTableSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TimeSlotSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ClassScheduleSeeder::class);
        $this->call(BannerSeeder::class);
    }
}
