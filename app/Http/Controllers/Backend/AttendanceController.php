<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberAttendance;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class AttendanceController extends Controller
{
    private $default_pagination;
    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $members = Member::where('status', '1')->get();

        foreach ($members as $member) {
            $existingAttendance = MemberAttendance::where('member_id', $member->id)
                ->where('attendance_date', now()->toDateString())
                ->first();
            if (!$existingAttendance) {
                $attendance = new MemberAttendance();
                $attendance->member_id = $member->id;
                $attendance->attendance_date = now()->toDateString();
                $attendance->save();
            }
        }
        $attendances = MemberAttendance::where('attendance_date', now()->toDateString())->get();

        return view("backend.attendance.index", compact('attendances'));
    }

    public function CheckIn(Request $request)
    {
        $att_id = $request->memberId;
        $attendance = MemberAttendance::find($att_id);
        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Data not found.'], 404);
        }

        $existingAttendance = MemberAttendance::where('id', $att_id)
        ->whereNotNull('check_in_time')
        ->whereDate('attendance_date', now()->toDateString())
        ->first();
    
        if ($existingAttendance) {
            return response()->json(['success' => false, 'message' => 'Attendance already exists for today.'], 400);
        }

        $attendance->check_in_time = now();
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Check-in successful']);
    }

    public function checkOut(Request $request)
    {
        $att_id = $request->memberId;
        $attendance = MemberAttendance::find($att_id);

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Data not found.'], 404);
        }

        $attendance->check_out_time = now();
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Check-out successful']);
    }
}
