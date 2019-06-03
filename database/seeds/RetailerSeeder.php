<?php

use Illuminate\Database\Seeder;

class RetailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('retailers')->insert(['name' => "JB", 'description' => 'JB Products', 'website' => 'www.jb.com']);
        DB::table('retailers')->insert(['name' => "Best foods", 'description' => 'Best foods for your life', 'website' => 'www.bestfoods.com']);
        DB::table('retailers')->insert(['name' => "GComputer", 'description' => 'Gaming computers', 'website' => 'www.gcomputer.com']);
        DB::table('retailers')->insert(['name' => "Amazing clothes", 'description' => 'Amazing clothes', 'website' => 'www.amazingclothes.com']);
    }
}
