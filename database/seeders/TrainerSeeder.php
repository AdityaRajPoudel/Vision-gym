<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => 'Trainer ' . $i,
                'email' => 'trainer' . $i . '@gmail.com',
                'password' => bcrypt('trainer@123'),
                'user_type_id' => 2,
            ]);

            $trainerCode = 'trn-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
            while (Trainer::where('trainer_code', $trainerCode)->exists()) {
                $trainerCode = 'trn-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
            }

            if ($user) {
                $trainer = new Trainer([
                    'trainer_code' => $trainerCode,
                    'gender' => 1,
                    'contact' => '9812345678',
                    'address' => 'Dharan',
                    'basic_salary' => 3000,
                    'description' => '',
                    'join_date' => Carbon::now()->toDateString(),
                    'status' => 1,
                    'user_id' => $user->id,
                ]);
                $trainer->save();
            }
        }
    }
    
}
