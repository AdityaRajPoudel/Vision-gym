<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'brand',
        'purchase_date',
        'purchase_qty',
        'description',
        'cost_per_item',
        'total',
        'vendor_name',
        'vendor_address',
        'selling_price',
        'cost_price',
    ];
    
}
