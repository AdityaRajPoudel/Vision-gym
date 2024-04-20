<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $bannerData = [
            ['banner_title' => 'Banner 1', 'banner_order' => 1,'banner_image'=>null],
            ['banner_title' => 'Banner 1', 'banner_order' => 2,'banner_image'=>null],
            
        ];
        foreach ($bannerData as $banner) {
            Banner::create($banner);
        }
       
    }
}
