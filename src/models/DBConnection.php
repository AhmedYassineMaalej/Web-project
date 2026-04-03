<?php

namespace App\models;

class DBConnection {
    private static $_host="localhost";
    private static $_dbname="website_db"; 
    private static $_user="root"; 
    private static $_pwd=""; 

    private static $_connection=null; 
    private function __construct(){ 
      self::$_connection=new PDO("mysql:host=" .self::$_host .";dbname=" .self::$_dbname. ";charset=utf8",
                                  self::$_user,
                                  self::$_pwd

                                  );
    }
    public static function getInstance(): ?PDO
    { 
        if(!self::$_connection){
            new DBConnection();
        }
        return (self::$_connection);
    } 

}
?>
