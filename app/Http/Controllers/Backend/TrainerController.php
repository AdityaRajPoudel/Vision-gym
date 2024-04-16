<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrainerController extends Controller
{
    private $default_pagination;

    public function __construct()
    {
        $this->default_pagination = 25;
    }

    public function index()
    {
        $trainers = Trainer::orderBy("id", "ASC")->paginate(
            $this->default_pagination
        );
        return view("backend.trainer.index", compact('trainers'));
    }

    public function create()
    {
        do {
            $trainerCode = 'trn-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        } while (Trainer::where('trainer_code', $trainerCode)->exists());

        return view("backend.trainer.create", compact('trainerCode'));
    }

    public function store(Request $request)
    {
      

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type_id = 2;
        $user->save();

        $image = $this->uploadImage($request, $request->file("trainer_image"));
       
        if ($user) {
            $trainer = new Trainer();
            $trainer->trainer_code = $request->trainer_code;
            $trainer->gender = $request->gender;
            $trainer->contact = $request->contact;
            $trainer->address = $request->address;
            $trainer->user_id = $user->id;
            if($image){
                $trainer->trainer_image=$image;
            }
            $trainer->basic_salary = $request->basic_salary;
            $trainer->description = $request->description;
            $trainer->join_date = $request->join_date;
            $trainer->status = $request->status;
            $trainer->save();
        }

        return redirect()->route('trainer.index')->with('message', 'Trainer Created Successfully');
    }
    public function edit($id)
    {
        $trainer = Trainer::where('id', $id)->first();
        return view("backend.trainer.edit", compact('trainer'));
    }

    public function update(Request $request, $id)
    { 

            $trainer = Trainer::findOrFail($id);

            $user = User::findOrFail($trainer->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            if ($user) {
                $trainer->gender = $request->gender;
                $trainer->contact = $request->contact;
                $trainer->address = $request->address;
                $trainer->user_id = $user->id;
                $trainer->basic_salary = $request->basic_salary;
                $trainer->description = $request->description;
                $trainer->join_date = $request->join_date;
                $trainer->status = $request->status;
                $trainer->save();
            }

            return redirect()->route('trainer.index')->with('message', 'Trainer Updated Successfully');
        
    }


    protected function uploadImage(Request $request, $image)
    {
        $imgUrl = null;
    
        if ($image instanceof UploadedFile && $image->getError() == "0") {

            $original_name = $image->getClientOriginalName();
            $name_array = explode(".", $original_name);
            $file_type = $name_array[sizeof($name_array) - 1];
            $valid_types = ["jpg", "jpeg", "png", "bmp"];
    
            if (in_array(strtolower($file_type), $valid_types)) {
                $date = new DateTime();
                $file_name = sprintf("%s.%s", $date->getTimestamp(), $file_type);
                $base_path = "/uploads/trainer";
    
                $protocol = $request->secure() ? 'https://' : 'http://';
                $host = $request->getHost();
    
                $imgUrl = $protocol . $host . $base_path . $file_name;
    
                $image->move(public_path($base_path), $file_name);
            }
        }
    
        return $imgUrl;
    }
    public function delete(Request $request, $id)
    {
        $trainer = Trainer::where('id', $id)->first();
        $trainer->delete();
        return redirect()->route('trainer.index')->with('error', 'Trainer Deleted Successfully');
    }

    public function publish(Request $request)
    {
        $trainer_id = $request->trainer_id;
        $status = $request->status;
        $trainer = Trainer::findOrFail($trainer_id);
        $trainer->status = $status;
        $trainer->save();
        return response()->json(['success' => true, 'message' => 'Status Update Successfully !']);
    }
}
