<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberAttendance;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function memberList()
    {

        $members = Member::select('members.id', 'members.member_code', 'members.gender', 'members.plan', 'users.name')
        ->selectRaw('COUNT(member_attendances.id) as attendance_count')
        ->leftJoin('member_attendances', 'members.id', '=', 'member_attendances.member_id')
        ->leftJoin('users', 'members.user_id', '=', 'users.id')
        ->groupBy('members.id', 'members.member_code', 'members.gender', 'members.plan', 'users.name')
        ->get();

        return view('backend.attendance.memberList',compact('members'));

    }

    public function trainerIndex()
    {
        $Trainers = Trainer::where('status', '1')->get();

        foreach ($Trainers as $trainer) {
            $existingAttendance = TrainerAttendance::where('trainer_id', $trainer->id)
                ->where('attendance_date', now()->toDateString())
                ->first();
            if (!$existingAttendance) {
                $attendance = new TrainerAttendance();
                $attendance->trainer_id = $trainer->id;
                $attendance->attendance_date = now()->toDateString();
                $attendance->save();
            }
        }
        $attendances = TrainerAttendance::where('attendance_date', now()->toDateString())->get();

        return view("backend.attendance.trainerIndex", compact('attendances'));
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

    public function trainerCheckIn(Request $request)
    {
        $att_id = $request->trainerId;
        $attendance = TrainerAttendance::find($att_id);
        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Data not found.'], 404);
        }

        $existingAttendance = TrainerAttendance::where('id', $att_id)
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

    public function trainercheckOut(Request $request)
    {
        $att_id = $request->memberId;
        $attendance = TrainerAttendance::find($att_id);

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Data not found.'], 404);
        }

        $attendance->check_out_time = now();
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Check-out successful']);
    }
}
