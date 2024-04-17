<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'fitness_category_id',
        'trainer_id',
        'day_of_week',
        'time_slot_id',
    ];

    public function trainer(){
        return $this->belongsTo(Trainer::class,'trainer_id','id');
    }

    public function category(){
        return $this->belongsTo(FitnessCategories::class,'fitness_category_id','id');
    }

    public function slot(){
        return $this->belongsTo(TimeSlot::class,'time_slot_id','id');
    }
}
