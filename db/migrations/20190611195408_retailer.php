<?php

use Phinx\Migration\AbstractMigration;

class Retailer extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        if (!$this->hasTable('retailer')) {
            $this->table('retailer')
                ->addColumn('name', 'string', ['limit' => 80])
                ->addColumn('logo', 'string', ['limit' => 255])
                ->addColumn('description', 'string', ['limit' => 255])
                ->addColumn('website', 'string', ['limit' => 255, 'null' => true, 'default' => ''])
                ->create();
        }
    }
}
