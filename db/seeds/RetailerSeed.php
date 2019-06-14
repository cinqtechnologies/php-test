<?php

use Phinx\Seed\AbstractSeed;

class RetailerSeed extends AbstractSeed
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
                'name' => 'Eletro Things',
                'logo' => '',
                'description' => 'All you can get for the best price.',
                'website' => 'www.eletrothings.com',
            ],
            [
                'name' => 'Nerd Store',
                'logo' => '',
                'description' => 'All the nerd stuff you can find here',
                'website' => 'www.nerdstore.com.br',
            ],
        ];

        $onwer = $this->table('retailer');
        $onwer->insert($data)
            ->save();
    }
}
