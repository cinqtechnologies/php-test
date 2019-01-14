<?php

    // comment the non-used server...
    $root_url = 'http://localhost';      // nginx/apache default port...
    $root_url = 'http://localhost:8000'; // built-in server...

    // Database constants...
    define('HOST', 'localhost');
    define('PORT', '5432');
    define('DATABASE', 'cinq_st');
    define('USER', 'cinq_st');
    define('PASSWORD', '123');

    class Conn {

        private static $pdo;

        private function __construct() {
        }

        public static function get_singleton_instance() {

            // connect to the postgresql database...
            $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                              HOST, PORT, DATABASE, USER, PASSWORD);

            self::$pdo = new \PDO($conStr);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return self::$pdo;
        }
    }

    // autoloader...
    spl_autoload_register(function ($class) {
        if (strpos($class, 'DAO') !== false) {
            include 'model/pgsql/' . $class . '.php';
        } else {
            include 'model/class/' . $class . '.php';
        }
    });
?>
