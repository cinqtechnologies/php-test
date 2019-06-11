<?php
declare(strict_types=1);

namespace App\Core\Db;

class Connection
{
    private static $instance = null;
    private $conn;

    private $hostAddress = 'localhost';
    private $hostUser = 'root';
    private $hostPass = '';
    private $hostName = 'ecommerce';

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        $hostName = sprintf("mysql:host=%s;dbname=%s", $this->hostAddress, $this->hostname);

        $this->conn = new \PDO(
            $hostName,
            $this->hostUser,
            $this->hostPass,
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
    }

    /**
     * @return Connection
     */
    public static function getInstance(): Connection
    {
        if (!self::$instance) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->conn;
    }
}