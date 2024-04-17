<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberAttendance;
use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $memberId = null;
        $monthId = null;
        $year = null;
        $type = null;
        $attendance = null;

        $daysInMonth = null;
        $members = Member::where('status', '1')->get();
        return view('backend.report.member_attendance', compact('members', 'attendance', 'monthId', 'daysInMonth', 'year','memberId'));
    }

    public function trainerIndex(Request $request)
    {
        $trainerId = null;
        $monthId = null;
        $year = null;
        $type = null;
        $attendance = null;

        $daysInMonth = null;
        $trainers = Trainer::where('status', '1')->get();
        return view('backend.report.trainer_attendance', compact('trainers','trainerId','attendance', 'monthId', 'daysInMonth', 'year'));
    }
    

    public function getMemberAttendance(Request $request)
    {
        $memberId = $request->member_id;
        $monthId = $request->month_id;
        $year = $request->year;
        $type = $request->button;

        $attendance = MemberAttendance::whereMonth('attendance_date', $monthId)
            ->whereYear('attendance_date', $year)
            ->get();
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthId, $year);
        $members = Member::where('status', '1')->get();
        $member=Member::FindOrFail($memberId);


        if($type =='download'){
            $filename = $member->user->name . '_' . \Carbon\Carbon::createFromDate($year, $monthId)->format('F_Y') . '.pdf';
            $data = [
                'attendance' => $attendance,
                'monthId' => $monthId,
                'year' => $year,
                'daysInMonth' => $daysInMonth,
                'member'=>$member,
            ];
            $pdf = PDF::loadView('backend.report.member_pdf', $data);
            // return $pdf->stream('backend.pdf'); 
            return $pdf->download($filename);

        }
        return view('backend.report.member_attendance', compact('members', 'attendance', 'monthId', 'daysInMonth', 'year', 'memberId'));
    }

    public function getTrainerAttendance(Request $request)
    {
        $trainerId = $request->trainer_id;
        $monthId = $request->month_id;
        $year = $request->year;
        $type = $request->button;

        $attendance = TrainerAttendance::whereMonth('attendance_date', $monthId)
            ->whereYear('attendance_date', $year)
            ->get();
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthId, $year);
        $trainers = Trainer::where('status', '1')->get();
        $trainer=Trainer::FindOrFail($trainerId);

        if($type =='download'){
            $filename = $trainer->user->name . '_' . \Carbon\Carbon::createFromDate($year, $monthId)->format('F_Y') . '.pdf';
            $data = [
                'attendance' => $attendance,
                'monthId' => $monthId,
                'year' => $year,
                'daysInMonth' => $daysInMonth,
                'trainer'=>$trainer,
            ];
            $pdf = PDF::loadView('backend.report.trainer_pdf', $data);
            // return $pdf->stream('backend.pdf'); 
            return $pdf->download($filename);

        }
        return view('backend.report.trainer_attendance', compact('trainers', 'attendance', 'monthId', 'daysInMonth', 'year', 'trainerId'));
    }

    
}
