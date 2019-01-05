<?php

use Illuminate\Database\Seeder;

class RetailersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('retailers')->insert([
            'name' => 'Retailer 1',
            'logo' => 'retailer-logo1.jpg',
            'description' => 'Tempus urna et pharetra pharetra massa massa ultricies. Non nisi est sit amet facilisis magna. Sit amet massa vitae tortor condimentum lacinia quis. Viverra aliquet eget sit amet tellus cras. Facilisis magna etiam tempor orci eu lobortis elementum nibh tellus. Amet venenatis urna cursus eget nunc scelerisque viverra mauris in. Donec massa sapien faucibus et molestie ac feugiat sed. A lacus vestibulum sed arcu non. Enim facilisis gravida neque convallis a cras semper auctor. Diam vulputate ut pharetra sit amet. Scelerisque fermentum dui faucibus in ornare. Nibh mauris cursus mattis molestie a iaculis. Arcu dictum varius duis at. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Amet nisl purus in mollis nunc sed id semper risus.',
            'website' => 'www.reddit.com'
        ]);

        DB::table('retailers')->insert([
            'name' => 'Retailer 2',
            'logo' => 'retailer-logo2.jpg',
            'description' => 'Non nisi est sit amet facilisis magna. Sit amet massa vitae tortor condimentum lacinia quis. Viverra aliquet eget sit amet tellus cras. Facilisis magna etiam tempor orci eu lobortis elementum nibh tellus. Amet venenatis urna cursus eget nunc scelerisque viverra mauris in. Donec massa sapien faucibus et molestie ac feugiat sed. A lacus vestibulum sed arcu non. Enim facilisis gravida neque convallis a cras semper auctor. Diam vulputate ut pharetra sit amet. Scelerisque fermentum dui faucibus in ornare. Nibh mauris cursus mattis molestie a iaculis. Arcu dictum varius duis at. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Amet nisl purus in mollis nunc sed id semper risus.',
            'website' => 'www.boredpanda.com'
        ]);
    }
}
