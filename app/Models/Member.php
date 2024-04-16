<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable=['member_code','trainer_id','gender','contact','address','user_id','dor','doe','age','initial_weight','gym_tym','plan','package_id','discount','sub_total','grand_total','tender','return','due','status','description','remarks'];

    public function user()  {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function service()  {
        return $this->belongsTo(FitnessCategories::class,'package_id','id');
    }
    public function Attendance()  {
        return $this->hasOne(MemberAttendance::class,'member_id','id');
    }
}
