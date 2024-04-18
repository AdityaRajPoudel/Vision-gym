<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberProgress;
use Illuminate\Http\Request;

class MemberProgressController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $progress = MemberProgress::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.progress.index", compact('progress'));
    }

    public function create()
    {
        $members = Member::where('status', '1')->get();
        return view("backend.progress.create", compact('members'));
    }

    public function store(Request $request)
    {
        $existingProgress = MemberProgress::where('member_id', $request->input('member_id'))
            ->where('date', $request->input('date'))
            ->exists();

        if ($existingProgress) {
            return redirect()->back()->with('error', 'Progress record already exists for the selected member on the specified date.');
        }
        $progress = new MemberProgress();

        $progress->member_id = $request->input('member_id');
        $progress->date = $request->input('date');
        $progress->weight = $request->input('weight');
        $progress->height = $request->input('height');
        $progress->bmi = $request->input('bmi');
        $progress->body_fat_percentage = $request->input('body_fat_percentage');
        $progress->muscle_mass = $request->input('muscle_mass');
        $progress->target_weight = $request->input('target_weight');
        $progress->target_date = $request->input('target_date');
        $progress->workout_duration = $request->input('workout_duration');
        $progress->exercise_type = $request->input('exercise_type');
        $progress->intensity_level = $request->input('intensity_level');
        $progress->calories_burned = $request->input('calories_burned');

        $progress->save();

        return redirect()->route('progress.index')->with('message', 'Progress Created Successfully');
    }


    public function edit($id)
    {
        $announcement = MemberProgress::where('id', $id)->first();
        return view("backend.notification.edit", compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = MemberProgress::where('id', $id)->first();
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->update();

        return redirect()->route('announcement.index')->with('info', 'Announcement Updated Successfully');
    }

    public function delete(Request $request, $id)
    {
        $announcement = MemberProgress::where('id', $id)->first();
        $announcement->delete();
        return redirect()->route('announcement.index')->with('error', 'Announcement Deleted Successfully');
    }
}
