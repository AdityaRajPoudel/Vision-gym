<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Member;
use App\Models\MemberAttendance;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	
	public function index()
	{
		$active_members = Member::where('status', '1')->count();
		$active_trainers = Trainer::where('status', '1')->count();
		$present_members = MemberAttendance::whereDate('attendance_date', Carbon::today())->count();
		$total_trainers = Trainer::count(); // Count all trainers, irrespective of status
		$total_revenue =  Income::sum('total_amount');

		$dates = [];
        $sales_array = [];
        $exp_array = [];
		$date = Carbon::now()->copy()->subMonth(); // Subtracts one month from the current date

		for ($date; $date->lte(Carbon::now()->copy()); $date->addDay()) {
			$dates[$date->format('m-d')] = "'" . $date->format('M d D') . "'";
			
            $from = $date->format('Y-m-d');
           
            $stat = $this->getSales($from);
			$exp=$this->getExpenses($from);

            $init_sales = array_key_exists($date->format('md'), $sales_array) ? $sales_array[$date->format('md')] : 0;
            $sales_array[$date->format('md')] = $init_sales+$stat;

			$init_exp = array_key_exists($date->format('md'), $exp_array) ? $exp_array[$date->format('md')] : 0;
            $exp_array[$date->format('md')] = $init_exp+$exp;
			
		}
			
		return view('backend.partials.dashboard', compact('active_members', 'active_trainers', 'present_members', 'total_trainers', 'total_revenue','sales_array','exp_array','dates'));
	}

	protected function getSales($date)
    {
        $sum = Income::whereDate('sales_date', $date)->sum('total_amount');
        return $sum;
    }
	protected function getExpenses($date)
    {
        $sum = Expense::whereDate('purchase_date', $date)->sum('total_amount');
        return $sum;
    }

	// public function user_index()
	// {
	// 	$users = User::with('roles')->get();
	// 	return view('backend.user.index', compact('users'));
	// }

	// public function user_create()
	// {
	// 	$roles = Role::all();
	// 	// dd($roles);
	// 	return view('backend.user.create', compact('roles'));
	// }

	// public function user_store(Request $request)
	// {
	// 	$this->validate($request, [
	// 		'name' => 'required',
	// 		'email' => 'required|email|unique:users,email',
	// 		'password' => 'required|min:6|confirmed',
	// 		'user_role' => 'required',
	// 		]);

	// 	// dd($request->all());

	// 	$input = $request->all();
    //     $input['password'] = Hash::make($input['password']);
    //     $user = User::create($input);

	// 	$user->assignRole($input['user_role']);
	// 	return redirect()->back()->with('msg', 'User Created Successfully.');
	// }

	// public function user_edit($id)
	// {
	// 	$user = User::findOrFail($id);
	// 	$roles = Role::all();
	// 	$user_role_array = $user->getRoleNames()->toArray();
	// 	// dd($user_role_array);
	// 	return view('backend.user.edit', compact('user', 'roles', 'user_role_array'));
	// }

	// public function user_update(Request $request, $id)
	// {
	// 	$this->validate($request, [
	// 		'name' => 'required|string',
	// 		'email' => 'required|unique:users,email,'.$id,
	// 		'user_role' => 'required',
	// 		]);

	// 	// dd($request->all());
	// 	$input = $request->all();
	// 	if(!empty($request['password'])){
	// 		$input['password'] = Hash::make($request->password);
	// 	}else{
	// 		unset($input['password']);
	// 	}
	// 	$user = User::findOrFail($id);
	// 	$user->update($input);
	// 	DB::table('model_has_roles')->where('model_id',$id)->delete();
	// 	$user->assignRole($request->user_role);
	// 	return redirect()->back()->with('msg', 'User Updated Successfully.');
	// }

	// public function user_destroy($id)
	// {
	// 	$user = User::findOrFail($id);
	// 	$user->delete();
	// 	return redirect()->back()->with('msg', 'User Updated Successfully.');
	// }
}
