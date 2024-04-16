<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerAttendance extends Model
{
    use HasFactory;

    protected $fillable=[
        'trainer_id',
        'check_in_time',
        'attendance_date',
        'check_out_time'

    ];

    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id','id');
    }
}
