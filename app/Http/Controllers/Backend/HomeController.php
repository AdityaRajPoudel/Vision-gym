<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	
	public function index()
	{
		$title = "Dashboard";
		return view('backend.partials.dashboard', compact("title"));
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
