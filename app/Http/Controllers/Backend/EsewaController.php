<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\MakeMemberMail;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EsewaController extends Controller
{
    public function esewaPaySuccess()
    {
        $member_id = $_GET['oid'];


        // $member=Member::FindorFail($member_id);
        // $member->esewa_status=1;
        // $member->save();
        

        //  $userData = [
        //     'member_code' => $member->member_code,
        //     'username' => $member->user->name,
        //     'plan' => $member->plan_id,
        //     'service' => $member->service->name,
        //     'issue_date' => $member->dor,
        //     'expire_date' => $member->doe,
        //     'discount' => 0,
        //     'total' =>  $amount,
        // ];

        // Mail::to($member->user->email)->queue(new MakeMemberMail($userData));

        return redirect()->route('dashboard')->with('message', 'Membership Added Successfully');
    }

    public function esewaPayFailed()
    {
        $member_id = $_GET['pid'];
        // $refId = $_GET['refId'];
        // $amount = $_GET['amt'];

        // $member=Member::FindorFail($member_id);
        // $member->esewa_status=0;
        // $member->save();
        return redirect()->route('dashboard')->with('error', 'Payment Unsuccesful !');

    }
}
