<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProgress extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'date',
        'weight',
        'height',
        'bmi',
        'body_fat_percentage',
        'muscle_mass',
        'target_weight',
        'target_date',
        'workout_duration',
        'exercise_type',
        'intensity_level',
        'calories_burned',
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }
    
}
