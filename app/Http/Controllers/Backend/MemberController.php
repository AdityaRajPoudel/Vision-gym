<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FitnessCategories;
use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class MemberController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $members = Member::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.member.index",compact('members'));
    }

    public function create()
    {
        $fitness_categories = FitnessCategories::get();
        do {
            $memberCode = 'mem-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $memberCode)->exists());
        
        return view("backend.member.create", compact('fitness_categories', 'memberCode'));
    }

    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type_id = 0;
        $user->save();

        if ($user) {
            $member = new Member();
            $member->member_code = $request->member_code;
            $member->gender = $request->gender;
            $member->contact = $request->contact;
            $member->address = $request->address;
            $member->user_id = $user->id;
            $member->dor = $request->date_of_register;
            $member->doe = $request->expire_date;
            $member->age = $request->age;
            $member->initial_weight = $request->current_weight;
            $member->gym_time = $request->gym_time;
            $member->plan = $request->plan_id;
            $member->package_id = $request->selected_category;
            $member->discount = $request->discount;
            $member->sub_total = $request->discount;
            $member->grand_total = $request->discount;
            $member->status = 1;
            $member->description = $request->description;
            $member->tender = $request->tender;
            $member->return = $request->return;
            $member->due = $request->due;
            $member->remarks = $request->remarks;
            $member->save();
        }

        $pay_modes = $request->pay_modes;
        $amt = $request->pay_amount;

        if ($user && $member) {

            foreach ($pay_modes as $key => $val) {
                $pay_mode = $val;
                $amount = $amt[$key];

                $payment = new Payment();
                $payment->amount = $amount;
                $payment->paymode = $pay_mode;
                $payment->save();
            }
        }

        return redirect()->route('member.index')->with('message','Member Created Successfully');
    }
}