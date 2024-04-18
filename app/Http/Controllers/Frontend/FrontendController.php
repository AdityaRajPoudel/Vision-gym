<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ClassSchedule;
use App\Models\TimeSlot;
use App\Models\Trainer;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $timeSlots = TimeSlot::all();
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $schedules = [];
        $trainers=Trainer::where('status','1')->get();
        $banners=Banner::all();
    
        foreach ($daysOfWeek as $day) {
            foreach ($timeSlots as $timeSlot) {
                $schedules[$day][$timeSlot->id] = ClassSchedule::where('day_of_week', $day)
                    ->where('time_slot_id', $timeSlot->id)
                    ->with('category', 'trainer')
                    ->get();
            }
        }
    
        return view('frontend.welcome', compact('schedules', 'timeSlots', 'daysOfWeek','trainers','banners'));
    }
}
