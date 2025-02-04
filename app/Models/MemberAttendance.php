<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAttendance extends Model
{
    use HasFactory;
    protected $fillable=[
        'member_id',
        'check_in_time',
        'attendance_date',
        'check_out_time'

    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
