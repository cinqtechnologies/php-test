<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
    	foreach (range(1,30) as $index) {
            $dateUsed = $faker->dateTimeBetween('-1 day', 'now');
	        DB::table('product')->insert([
	            'name' => $faker->word,
                'price' => $faker->randomFloat(2,50, 2000),
                'file_pic' => $faker->image(config('filesystems.disks.local.products'), 400, 300, '',false),
                'description' => $faker->text,
                'retailer_id' => $faker->numberBetween(1, 10),
                'created_at' => $dateUsed,
                'updated_at' => $dateUsed
            ]);
        }
    }
}
