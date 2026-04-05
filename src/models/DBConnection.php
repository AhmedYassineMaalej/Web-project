<?php

namespace App\models;

use PDO;

class DBConnection {

    private static $_host, $_dbname, $_user, $_pwd;
    private static $_connection = null; 

    private function __construct(){ 
        self::$_host = $_ENV['HOST'];
        self::$_dbname = $_ENV['DB_NAME'];
        self::$_user = $_ENV['USER'];
        self::$_pwd = $_ENV['PWD'];
        
        // First, connect without database to check/create it
        self::ensureDatabaseExists();
        
        // Then connect to the actual database
        self::$_connection = new PDO(
            "mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8",
            self::$_user,
            self::$_pwd
        );
        self::create_tables(__DIR__."/../../database/create.sql");
        self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    private static function ensureDatabaseExists(): void {
        try {
            // Connect without specifying a database
            $pdo = new PDO(
                "mysql:host=" . self::$_host . ";charset=utf8",
                self::$_user,
                self::$_pwd
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Check if database exists
            $stmt = $pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
            $stmt->execute([self::$_dbname]);
            $dbExists = $stmt->fetch();
            
            if (!$dbExists) {
                // Create the database
                $pdo->exec("CREATE DATABASE `" . self::$_dbname . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                error_log("Database '" . self::$_dbname . "' created successfully");
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance(): ?PDO
    { 
        if (!self::$_connection) {
            new self();
        }
        return self::$_connection;
    }
    private static function create_tables($sqlFilePath): void {
        try {
            if (!file_exists($sqlFilePath)) {
                error_log("SQL file not found: " . $sqlFilePath);
                return;
            }
            
            $sql = file_get_contents($sqlFilePath);
            
            if ($sql === false) {
                error_log("Failed to read SQL file: " . $sqlFilePath);
                return;
            }
            
            // Remove comments and split
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            foreach ($statements as $statement) {
                if (!empty($statement)) {
                    try {
                        self::$_connection->exec($statement);
                    } catch (PDOException $e) {
                        // Skip "already exists" errors
                        if (strpos($e->getMessage(), 'already exists') === false) {
                            error_log("SQL Error: " . $e->getMessage() . " in: " . $statement);
                        }
                    }
                }
            }
            
            error_log("Tables verified/created successfully");
            
        } catch (Exception $e) {
            error_log("Error creating tables: " . $e->getMessage());
        }
    }




}