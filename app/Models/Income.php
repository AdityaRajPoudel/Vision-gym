<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable=[
        'fitness_cat_id',
        'plan',
        'sales_date',
        'total_amount'
    ];

}
