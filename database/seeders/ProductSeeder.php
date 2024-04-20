<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtsData = [
           
            [
                'product_code' => 'pr-001',
                'name' => 'Home Body Work Out Fitness Pull Rope',
                'brand' => 'No Brand',
                'cost_price' => 450,
                'selling_price' => 650,
                'vendor_name' => 'S & T supplier',
                'vendor_address' => 'New Baneshower'
            ],
            [
                'product_code' => 'pr-002',
                'name' => 'Adjustable Dumbbell Set',
                'brand' => 'Gym Master',
                'cost_price' => 750,
                'selling_price' => 1100,
                'vendor_name' => 'Fitness Warehouse',
                'vendor_address' => 'Main Street'
            ],
            [
                'product_code' => 'pr-003',
                'name' => 'Protein Powder',
                'brand' => 'MuscleTech',
                'cost_price' => 400,
                'selling_price' => 650,
                'vendor_name' => 'Supplement World',
                'vendor_address' => 'Downtown Avenue'
            ],
            [
                'product_code' => 'pr-004',
                'name' => 'Gym Ball',
                'brand' => 'FitPlus',
                'cost_price' => 300,
                'selling_price' => 400,
                'vendor_name' => 'Gym Essentials',
                'vendor_address' => 'Central Plaza'
            ],
            [
                'product_code' => 'pr-005',
                'name' => 'Weight Bench',
                'brand' => 'PowerTech',
                'cost_price' => 300,
                'selling_price' => 500,
                'vendor_name' => 'Fitness World',
                'vendor_address' => 'Mall Road'
            ],
            [
                'product_code' => 'pr-006',
                'name' => 'Treadmill',
                'brand' => 'CardioPro',
                'cost_price' => 1000,
                'selling_price' => 1500,
                'vendor_name' => 'Fitness Gear Store',
                'vendor_address' => 'Park Street'
            ],
            [
                'product_code' => 'pr-007',
                'name' => 'Exercise Bike',
                'brand' => 'SpinFit',
                'cost_price' => 600,
                'selling_price' => 900,
                'vendor_name' => 'Cycling Central',
                'vendor_address' => 'Grand Avenue'
            ],
            [
                'product_code' => 'pr-008',
                'name' => 'Weight Plates Set',
                'brand' => 'BodyFlex',
                'cost_price' => 150,
                'selling_price' => 250,
                'vendor_name' => 'Body Building Emporium',
                'vendor_address' => 'Sunset Boulevard'
            ],
            [
                'product_code' => 'pr-009',
                'name' => 'Resistance Bands Set',
                'brand' => 'FlexFit',
                'cost_price' => 30,
                'selling_price' => 50,
                'vendor_name' => 'Fitness Essentials',
                'vendor_address' => 'High Street'
            ],
            [
                'product_code' => 'pr-010',
                'name' => 'Skipping Rope',
                'brand' => 'JumpFit',
                'cost_price' => 70,
                'selling_price' => 120,
                'vendor_name' => 'Jump Ropes Outlet',
                'vendor_address' => 'Broadway'
            ],
            // Add more products
            [
                'product_code' => 'pr-011',
                'name' => 'Yoga Mat',
                'brand' => 'ZenYoga',
                'cost_price' => 700,
                'selling_price' => 1100,
                'vendor_name' => 'Yoga Bliss',
                'vendor_address' => 'Zen Street'
            ],
            [
                'product_code' => 'pr-012',
                'name' => 'Foam Roller',
                'brand' => 'RollFlex',
                'cost_price' => 500,
                'selling_price' => 800,
                'vendor_name' => 'Flex Store',
                'vendor_address' => 'Flex Street'
            ],
            [
                'product_code' => 'pr-013',
                'name' => 'Push-Up Bars',
                'brand' => 'PushPro',
                'cost_price' => 1000,
                'selling_price' => 1220,
                'vendor_name' => 'Pro Gear',
                'vendor_address' => 'Push Street'
            ],
            [
                'product_code' => 'pr-014',
                'name' => 'Kettlebell Set',
                'brand' => 'BellFit',
                'cost_price' => 60,
                'selling_price' => 100,
                'vendor_name' => 'BellFit Store',
                'vendor_address' => 'Bell Street'
            ],
            [
                'product_code' => 'pr-015',
                'name' => 'Gym Gloves',
                'brand' => 'GripPro',
                'cost_price' => 600,
                'selling_price' => 900,
                'vendor_name' => 'Grip Zone',
                'vendor_address' => 'Grip Street'
            ],
            [
                'product_code' => 'pr-016',
                'name' => 'Weightlifting Belt',
                'brand' => 'LiftGear',
                'cost_price' => 200,
                'selling_price' => 350,
                'vendor_name' => 'LiftMaster',
                'vendor_address' => 'Lift Street'
            ],
            [
                'product_code' => 'pr-017',
                'name' => 'Gym Towel Set',
                'brand' => 'DryFit',
                'cost_price' => 800,
                'selling_price' => 1100,
                'vendor_name' => 'DryFit Store',
                'vendor_address' => 'Dry Street'
            ],
            [
                'product_code' => 'pr-018',
                'name' => 'Gym Bag',
                'brand' => 'SportyGear',
                'cost_price' => 679,
                'selling_price' => 990,
                'vendor_name' => 'Sporty Store',
                'vendor_address' => 'Sporty Street'
            ],
            [
                'product_code' => 'pr-019',
                'name' => 'Gym Water Bottle',
                'brand' => 'HydroFit',
                'cost_price' => 755,
                'selling_price' => 940,
                'vendor_name' => 'Hydro Store',
                'vendor_address' => 'Hydro Street'
            ],
            [
                'product_code' => 'pr-020',
                'name' => 'Gym Timer',
                'brand' => 'TimePro',
                'cost_price' => 250,
                'selling_price' => 450,
                'vendor_name' => 'TimeZone',
                'vendor_address' => 'Time Street'
            ],
            [
                'product_code' => 'pr-021',
                'name' => 'Suspension Trainer',
                'brand' => 'SuspendFit',
                'cost_price' => 3500,
                'selling_price' => 4500,
                'vendor_name' => 'Suspend Store',
                'vendor_address' => 'Suspend Street'
            ],
            [
                'product_code' => 'pr-022',
                'name' => 'Foam Plyo Box Set',
                'brand' => 'PlyoFit',
                'cost_price' => 900,
                'selling_price' => 1400,
                'vendor_name' => 'Plyo Store',
                'vendor_address' => 'Plyo Street'
            ],
            [
                'product_code' => 'pr-023',
                'name' => 'Battle Rope',
                'brand' => 'BattleFit',
                'cost_price' => 2200,
                'selling_price' => 70,
                'vendor_name' => 'Battle Store',
                'vendor_address' => 'Battle Street'
            ],
            [
                'product_code' => 'pr-024',
                'name' => 'Weighted Vest',
                'brand' => 'VestFit',
                'cost_price' => 550,
                'selling_price' => 950,
                'vendor_name' => 'Vest Store',
                'vendor_address' => 'Vest Street'
            ],
            [
                'product_code' => 'pr-025',
                'name' => 'Jump Box Set',
                'brand' => 'JumpFit',
                'cost_price' => 700,
                'selling_price' => 1200,
                'vendor_name' => 'Jump Store',
                'vendor_address' => 'Jump Street'
            ],
            [
                'product_code' => 'pr-026',
                'name' => 'Gym Flooring Tiles',
                'brand' => 'FloorFit',
                'cost_price' => 20000,
                'selling_price' => 35000,
                'vendor_name' => 'Floor Store',
                'vendor_address' => 'Floor Street'
            ],
            [
                'product_code' => 'pr-027',
                'name' => 'Balance Board',
                'brand' => 'BalFit',
                'cost_price' => 2500,
                'selling_price' => 4500,
                'vendor_name' => 'Bal Store',
                'vendor_address' => 'Bal Street'
            ],
            [
                'product_code' => 'pr-028',
                'name' => 'Gym Chalk',
                'brand' => 'ChalkFit',
                'cost_price' => 800,
                'selling_price' => 915,
                'vendor_name' => 'Chalk Store',
                'vendor_address' => 'Chalk Street'
            ],
            [
                'product_code' => 'pr-029',
                'name' => 'Gymnastic Rings',
                'brand' => 'RingFit',
                'cost_price' => 300,
                'selling_price' => 550,
                'vendor_name' => 'Ring Store',
                'vendor_address' => 'Ring Street'
            ],
        ];

        foreach ($produtsData as $product) {
            Product::create($product);
        }
    }
}
