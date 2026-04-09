<?php

namespace App\Models;

use PDO;

class DBConnection {
    private static string $_host, $_dbname, $_user, $_pwd;
    private static ?PDO $connection = null; 



    private function __construct(){ 
        self::$_host = $_ENV['DB_HOST'];
        self::$_dbname = $_ENV['DB_NAME'];
        self::$_user = $_ENV['DB_USER'];
        self::$_pwd = $_ENV['DB_PWD'];

        self::$connection = new PDO(
            "mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8",
            self::$_user,
            self::$_pwd
        );
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): PDO
    {
        if (!self::$connection) {
            new self();
        }
        return self::$connection;
    }
}
