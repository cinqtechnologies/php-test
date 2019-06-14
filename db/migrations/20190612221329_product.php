<?php

use Phinx\Migration\AbstractMigration;

class Product extends AbstractMigration
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
        if (!$this->hasTable('product')) {
            $this->table('product')
                ->addColumn('retailer_id', 'integer', ['null' => true, 'default' => 0])
                ->addColumn('name', 'string', ['limit' => 80])
                ->addColumn('price', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => true, 'default' => 0])
                ->addColumn('logo', 'string', ['limit' => 255])
                ->addColumn('description', 'string', ['limit' => 255])
                ->create();
        }
    }
}
