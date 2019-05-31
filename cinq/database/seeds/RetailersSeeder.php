<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class RetailersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
    	foreach (range(1,10) as $index) {
            $dateUsed = $faker->dateTimeThisMonth('now');
	        DB::table('retailer')->insert([
	            'name' => $faker->company,
                'description' => $faker->text,
                'website' => $faker->url,
                'file_pic' => $faker->image(config('filesystems.disks.local.retailers'), 400, 300, '',false),
                'created_at' => $dateUsed,
                'updated_at' => $dateUsed
	        ]);
	    }
    }
}
