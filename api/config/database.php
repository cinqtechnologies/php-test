<?php
class Database {
    private $host = "localhost";
    private $username = "luis_dias";
    private $password = "XPk4hWPeTVdtKwEU";
    private $db_name = "php_test";
	
    public $connection;
 
    public function getConnection () {
        $this->connection = null;
 
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->exec("set names utf8");
        } catch(PDOException $exception){
			http_response_code(503);
			echo json_encode(array("message" => "Connection error: " . $exception->getMessage()));
			exit();
        }
 
        return $this->connection;
    }
}