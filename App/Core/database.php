<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct(array $config)
    {
        try {
            $this->connection = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_username'], $config['db_pass']);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function getinstance(array $config): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database($config);
        }
        return self::$instance;
    }
    public function getconnection():PDO{
        return $this->connection;
    }

}
