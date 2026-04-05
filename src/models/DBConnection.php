<?php

namespace App\models;

use PDO;

class DBConnection {

    private static $_host, $_dbname, $_user, $_pwd;
    private static $_connection = null; 

    private function __construct(){ 
        //to make them more flexible, we need to use .env (which is already loaded since index.php)
        self::$_host = $_ENV['HOST'];
        self::$_dbname = $_ENV['DB_NAME'];
        self::$_user = $_ENV['USER'];
        self::$_pwd = $_ENV['PWD'];
        
        self::$_connection = new PDO(
            "mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8",
            self::$_user,
            self::$_pwd
        );
        
        self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getInstance(): ?PDO
    { 
        if (!self::$_connection) {
            new self();
        }
        return self::$_connection;
    }
}