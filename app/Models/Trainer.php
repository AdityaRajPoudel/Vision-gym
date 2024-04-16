<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable=[
        'trainer_code',
        'gender',
        'contact',
        'address',
        'user_id',
        'join_date',
        'basic_salary',
        'status'
    ];

    public function user()  {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
