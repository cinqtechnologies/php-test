<?php

use Phinx\Seed\AbstractSeed;

class ProductSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'retailer_id' => 1,
                'name' => 'Wallet',
                'price' => '1.90',
                'logo' => '',
                'description' => 'Protect your money!',
            ],
            [
                'retailer_id' => 1,
                'name' => 'Purse',
                'price' => '19.99',
                'logo' => '',
                'description' => 'Enjoy the best products.',
            ],
            [
                'retailer_id' => 1,
                'name' => 'LCD Monitor',
                'price' => '59.99',
                'logo' => '',
                'description' => 'The best you can get.',
            ],
        ];

        $onwer = $this->table('product');
        $onwer->insert($data)
            ->save();
    }
}
