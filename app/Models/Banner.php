<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";

    protected $fillable = [
    	"banner_title",
    	"banner_description",
    	"banner_image",
    	"banner_order",
    	"banner_btn_text",
    	"banner_btn_link",
    ];
}
