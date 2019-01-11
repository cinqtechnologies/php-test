<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tables extends CI_Migration {
	 public function up() {
	 	$this->dbforge->add_field('id');
	 	//$this->dbforge->add_field("id INT NOT NULL auto_increment");
		$this->dbforge->add_field("name VARCHAR(150) NOT NULL");
		$this->dbforge->add_field("logo TEXT");
		$this->dbforge->add_field("website VARCHAR(200) NOT NULL");
		$this->dbforge->add_field("description TEXT NOT NULL");
		$this->dbforge->add_field("creation_date DATETIME DEFAULT CURRENT_TIMESTAMP");
		//$this->dbforge->add_key('id', TRUE);
        if($this->dbforge->create_table('retailer')) {
        	echo 'created table retailer <br />';
        }

        $this->dbforge->add_field('id');
        //$this->dbforge->add_field("id INT NOT NULL auto_increment");
        $this->dbforge->add_field("retailer_id INT NOT NULL");
		$this->dbforge->add_field("name VARCHAR(150) NOT NULL");
		$this->dbforge->add_field("image TEXT");
		$this->dbforge->add_field("price DECIMAL(12, 2) NOT NULL");
		$this->dbforge->add_field("description TEXT NOT NULL");
		$this->dbforge->add_field("creation_date DATETIME DEFAULT CURRENT_TIMESTAMP");
		//$this->dbforge->add_key('id', TRUE);

        if($this->dbforge->create_table('products')) {
        	echo 'created table products <br />';
        }
	}
}