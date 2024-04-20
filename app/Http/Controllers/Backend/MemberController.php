<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\MakeMemberMail;
use App\Mail\MembershipMail;
use App\Mail\RegistrationMail;
use App\Models\FitnessCategories;
use App\Models\Income;
use App\Models\Member;
use App\Models\Payment;
use App\Models\TimeSlot;
use App\Models\Trainer;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

require '../vendor/autoload.php';

use RemoteMerge\Esewa\Client;
use RemoteMerge\Esewa\Config;


class MemberController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $members = Member::where('status', '1')->orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.member.index", compact('members'));
    }

    public function create()
    {
        $fitness_categories = FitnessCategories::all();
        $time_slots = TimeSlot::all();
        $trainers = Trainer::where('status', '1')->get();
        do {
            $memberCode = 'mem-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $memberCode)->exists());
        return view("backend.member.create", compact('fitness_categories', 'memberCode', 'time_slots', 'trainers'));
    }

    public function getUser($id)
    {
        $member = Member::FindOrFail($id);
        $fitness_categories = FitnessCategories::get();
        $time_slots = TimeSlot::all();
        $trainers = Trainer::where('status', '1')->get();
        do {
            $memberCode = 'mem-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $memberCode)->exists());

        return view("backend.registration.make_member", compact('fitness_categories', 'memberCode', 'member', 'time_slots', 'trainers'));
    }


    public function memberStore(Request $request)
    {
        // dd($request->all());
        $regCode = $request->reg_code;
        $member = Member::where('reg_code', $regCode)->first();

        $user = User::where('id', $member->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->user_type_id = 0;
        $user->save();

        if ($user) {
            $member->member_code = $request->member_code;
            $member->gender = $request->gender;
            $member->contact = $request->contact;
            $member->address = $request->address;
            $member->user_id = $user->id;
            $member->dor = $request->date_of_register;
            $member->doe = $request->expire_date;
            $member->age = $request->age;
            $member->initial_weight = $request->current_weight;
            $member->time_slot_id = $request->gym_time;
            $member->plan = $request->plan_id;
            $member->trainer_id = $request->trainer_id;
            $member->package_id = $request->selected_category;
            $member->discount = $request->discount;
            // $member->sub_total = $reques;
            $member->grand_total = $request->total;
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
        if ($user && $member) {
            $income = new Income();
            // $income->fitness_cat_id = $request->selected_category;
            // $income->plan = $request->plan_id;
            $income->total_amount = $request->total;
            $income->sales_date = now()->toDateString();
            $income->save();
        }

        $userData = [
            'member_code' => $member->member_code,
            'username' => $user->name,
            'plan' => $request->plan_id,
            'service' => $member->service->name,
            'issue_date' => $request->date_of_register,
            'expire_date' => $request->expire_date,
            'discount' => $request->discount,
            'total' => $request->total
        ];

        Mail::to($user->email)->queue(new MakeMemberMail($userData));

        return redirect()->route('member.index')->with('message', 'Member Created Successfully');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type_id = 0;
        
        if (User::where('email', $user->email)->exists()) {
            return redirect()->back()->with('error', 'Email already exists.');
        }

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
            $member->time_slot_id = $request->gym_time;
            $member->plan = $request->plan_id;
            $member->trainer_id = $request->trainer_id;
            $member->package_id = $request->selected_category;
            $member->discount = $request->discount;
            $member->sub_total = $request->discount;
            $member->grand_total = $request->total;
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
        if ($user && $member) {
            $income = new Income();
            // $income->fitness_cat_id = $request->selected_category;
            // $income->plan = $request->plan_id;
            $income->total_amount = $request->total;
            $income->sales_date = now()->toDateString();
            $income->save();
        }

        $userData = [
            'member_code' => $member->member_code,
            'username' => $user->name,
            'email' => $user->email,
            'password' => $request->password,
            'plan' => $request->plan_id,
            'service' => $member->service->name,
            'issue_date' => $request->date_of_register,
            'expire_date' => $request->expire_date,
            'discount' => $request->discount,
            'total' => $request->total
        ];

        Mail::to($user->email)->queue(new MembershipMail($userData));

        return redirect()->route('member.index')->with('message', 'Member Created Successfully');
    }


    public function register(Request $request)
    {
        $members = Member::where('status', '0')->orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.registration.index", compact('members'));
    }

    public function registerCreate()
    {
        do {
            $regCode = 'reg-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Member::where('reg_code', $regCode)->exists());

        return view("backend.registration.create", compact('regCode'));
    }

    public function registerStore(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type_id = 0;
        $user->save();

        if ($user) {
            $member = new Member();
            $member->reg_code = $request->reg_code;
            $member->reg_date = $request->reg_date;
            $member->gender = $request->gender;
            $member->contact = $request->contact;
            $member->address = $request->address;
            $member->user_id = $user->id;
            $member->age = $request->age;
            $member->initial_weight = $request->current_weight;
            $member->description = $request->description;
            $member->save();
        }

        $userData = [
            'username' => $user->name,
            'email' => $user->email,
            'password' => $request->password
        ];

        Mail::to($user->email)->queue(new RegistrationMail($userData));


        return redirect()->route('user.register')->with('message', 'User Created Successfully');
    }


    public function getMembership()
    {
        $member = Member::where('user_id', auth()->user()->id)->first();
        // dd($member);
        $fitness_categories = FitnessCategories::get();
        $time_slots = TimeSlot::all();
        $trainers = Trainer::where('status', '1')->get();
        do {
            $memberCode = 'mem-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Member::where('member_code', $memberCode)->exists());

        return view("backend.member.getmembership", compact('fitness_categories', 'memberCode', 'member', 'time_slots', 'trainers'));
    }

    public function esewaMembership(Request $request)
    {
        $regCode = $request->reg_code;
        $member = Member::where('reg_code', $regCode)->first();

        $user = User::where('id', $member->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->user_type_id = 0;
        $user->save();

        if ($user) {
            $member->member_code = $request->member_code;
            $member->gender = $request->gender;
            $member->contact = $request->contact;
            $member->address = $request->address;
            $member->user_id = $user->id;
            $member->dor = $request->date_of_register;
            $member->doe = $request->expire_date;
            $member->age = $request->age;
            $member->initial_weight = $request->current_weight;
            $member->time_slot_id = $request->gym_time;
            $member->plan = $request->plan_id;
            $member->trainer_id = $request->trainer_id;
            $member->package_id = $request->selected_category;
            $member->discount = 10;
            // $member->sub_total = $reques;
            $member->grand_total = $request->total;
            $member->status = 1;
            $member->description = $request->description;
            $member->tender = $request->tender;
            $member->return = $request->return;
            $member->due = $request->due;
            $member->remarks = $request->remarks;
            $member->save();
        }

        $payment = new Payment();
        $payment->amount = $request->total;
        $payment->paymode = 'esewa';
        $payment->save();
        
        if ($user && $member) {
            $income = new Income();;
            $income->sales_date = now()->toDateString();
            $income->save();
        }

        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // config for development
        $config = new Config($successUrl, $failureUrl);
        // initialize eSewa client
        $esewa = new Client($config);

        $esewa->process($member->id, $request->total, 0, 0, 0);

    }

    public function esewaPaySuccess()
    {
        $member_id = $_GET['oid'] ?? null;
        $referenceId = $_GET['refId'] ?? null;
        $amount = $_GET['amt'] ?? null;

        $member=Member::FindorFail($member_id);
        $member->esewa_status=1;
        $member->save();

        return redirect()->route('dashboard')->with('message', 'Membership Added Successfully');
    }

    public function esewaPayFailed()
    {
        $member_id = $_GET['pid'];

        return redirect()->route('dashboard')->with('error', 'Payment Unsuccesful !');

    }
}
