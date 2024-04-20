<?php

namespace Database\Seeders;

use App\Models\ClassSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $fitnessCategoryIds = [1, 2, 3, 4];
        $trainerIds = range(1, 5);
        $timeSlotIds = [1, 2, 3, 4,5];
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        for ($i = 0; $i < 20; $i++) {
            $fitnessCategoryId = $fitnessCategoryIds[array_rand($fitnessCategoryIds)];
            $trainerId = $trainerIds[array_rand($trainerIds)];
            $timeSlotId = $timeSlotIds[array_rand($timeSlotIds)];
            $dayOfWeek = $daysOfWeek[array_rand($daysOfWeek)];

            ClassSchedule::create([
                'fitness_category_id' => $fitnessCategoryId,
                'trainer_id' => $trainerId,
                'time_slot_id' => $timeSlotId,
                'day_of_week' => $dayOfWeek,
            ]);
        }
    }

}
