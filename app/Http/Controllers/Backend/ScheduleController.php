<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use App\Models\FitnessCategories;
use App\Models\TimeSlot;
use App\Models\Trainer;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $schedules = ClassSchedule::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.schedule.index", compact('schedules'));
    }

    public function create()
    {
        $trainers = Trainer::where('status', '1')->get();
        $fitness_categories = FitnessCategories::all();
        $time_slots = TimeSlot::all();
        return view("backend.schedule.create", compact('trainers', 'fitness_categories', 'time_slots'));
    }

    public function store(Request $request)
    {

        foreach ($request->fitness_category as $key => $fitnessCategory) {
            $existingSchedule = ClassSchedule::where([
                'fitness_category_id' => $fitnessCategory,
                'trainer_id' => $request->trainer_id[$key],
                'day_of_week' => $request->day[$key],
                'time_slot_id' => $request->time_slot_id[$key],
            ])->first();

            if (!$existingSchedule) {
                ClassSchedule::create([
                    'fitness_category_id' => $fitnessCategory,
                    'trainer_id' => $request->trainer_id[$key],
                    'day_of_week' => $request->day[$key],
                    'time_slot_id' => $request->time_slot_id[$key],
                ]);
            }
        }

        return redirect()->route('schedule.index')->with('message', 'Schedule Created Successfully');
    }

    public function edit($id)
    {
        $trainers = Trainer::where('status', '1')->get();
        $fitness_categories = FitnessCategories::all();
        $time_slots = TimeSlot::all();
        $schedule = ClassSchedule::where('id', $id)->first();
        return view("backend.schedule.edit", compact('schedule', 'trainers', 'fitness_categories', 'time_slots'));
    }

    public function update(Request $request, $id)
    {
        $schedule = ClassSchedule::findOrFail($id); 
        $schedule->fitness_category_id = $request->fitness_category;
        $schedule->trainer_id = $request->trainer_id;
        $schedule->day_of_week = $request->day;
        $schedule->time_slot_id = $request->time_slot_id; 
        $schedule->save(); 
        return redirect()->route('schedule.index')->with('message', 'Schedule updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $schedule = ClassSchedule::where('id', $id)->first();
        $schedule->delete();
        return redirect()->route('schedule.index')->with('error', 'Schedule Deleted Successfully');
    }
}
