<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeSlots = [
            ['start_time' => '06:00:00', 'end_time' => '08:00:00'],
            ['start_time' => '08:00:00', 'end_time' => '10:00:00'],
            ['start_time' => '16:00:00', 'end_time' => '18:00:00'],
            ['start_time' => '18:00:00', 'end_time' => '20:00:00'],
        ];
    
        foreach ($timeSlots as $slot) {
            TimeSlot::create($slot);
        } TimeSlot::create($slot);
        
    }
}
