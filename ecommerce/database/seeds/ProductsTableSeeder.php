<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 1',
            'price' => 9.99,
            'image' => 'product1.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 2',
            'price' => 15.5,
            'image' => 'product2.jpg',
            'description' => 'Lacinia at quis risus sed. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Lorem ipsum dolor sit amet consectetur adipiscing elit. '
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 3',
            'price' => 36.11,
            'image' => 'product3.jpg',
            'description' => 'Fermentum et sollicitudin ac orci. Volutpat est velit egestas dui id ornare. Duis tristique sollicitudin nibh sit amet. Aliquam sem et tortor consequat id porta. '
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 4',
            'price' => 8.55,
            'image' => 'product4.jpg',
            'description' => 'Duis tristique sollicitudin nibh sit amet. Aliquam sem et tortor consequat id porta. '
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 5',
            'price' => 20.60,
            'image' => 'product5.jpg',
            'description' => 'Aliquam sem et tortor consequat id porta. In ante metus dictum at tempor commodo ullamcorper. Et sollicitudin ac orci phasellus egestas. '
        ]);
    }
}
