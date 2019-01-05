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
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 2',
            'price' => 15.5,
            'description' => 'Lacinia at quis risus sed. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Lorem ipsum dolor sit amet consectetur adipiscing elit. Odio eu feugiat pretium nibh ipsum. Feugiat nibh sed pulvinar proin gravida hendrerit. Quisque id diam vel quam elementum pulvinar. Neque ornare aenean euismod elementum nisi quis eleifend quam. Turpis egestas maecenas pharetra convallis posuere morbi leo urna. Facilisis sed odio morbi quis commodo. Habitant morbi tristique senectus et netus et malesuada fames. Diam maecenas sed enim ut sem. Turpis massa sed elementum tempus egestas sed sed risus. Eleifend quam adipiscing vitae proin sagittis. Sem et tortor consequat id porta nibh venenatis cras sed. Mattis ullamcorper velit sed ullamcorper morbi. Eget arcu dictum varius duis. Enim sit amet venenatis urna. Maecenas volutpat blandit aliquam etiam erat velit scelerisque in dictum. Volutpat blandit aliquam etiam erat velit scelerisque in dictum. Varius quam quisque id diam vel quam elementum.'
        ]);

        DB::table('products')->insert([
            'retailer_id' => 1,
            'name' => 'Product 3',
            'price' => 36.11,
            'description' => 'Fermentum et sollicitudin ac orci. Volutpat est velit egestas dui id ornare. Duis tristique sollicitudin nibh sit amet. Aliquam sem et tortor consequat id porta. In ante metus dictum at tempor commodo ullamcorper. Et sollicitudin ac orci phasellus egestas. Pellentesque habitant morbi tristique senectus. Enim blandit volutpat maecenas volutpat blandit aliquam. Suscipit adipiscing bibendum est ultricies integer. Eleifend mi in nulla posuere. Vel pharetra vel turpis nunc.'
        ]);
    }
}
