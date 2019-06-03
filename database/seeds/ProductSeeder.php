<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(['name' => "T-shirt", 'description' => 'Basic T-shirt', 'price' => 10, 'retailer_id' => 4]);
        DB::table('products')->insert(['name' => "Shirt", 'description' => 'Basic shirt', 'price' => 15.45, 'retailer_id' => 4]);
        DB::table('products')->insert(['name' => "Gloves", 'description' => 'Basic gloves', 'price' => 3.45, 'retailer_id' => 4]);

        DB::table('products')->insert(['name' => "Apple", 'price' => 1.5, 'retailer_id' => 2]);
        DB::table('products')->insert(['name' => "Banana", 'price' => 0.9, 'retailer_id' => 2]);
        DB::table('products')->insert(['name' => "Grape", 'price' => 2.46, 'retailer_id' => 2]);

        DB::table('products')->insert(['name' => "Asus GTX 2080Ti", 'price' => 1100, 'retailer_id' => 3]);
        DB::table('products')->insert(['name' => "Intel i9", 'price' => 900, 'retailer_id' => 3]);
    }
}
