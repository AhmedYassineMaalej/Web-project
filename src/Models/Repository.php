<?php 
namespace App\Models;

use PDO;
use Exception;

abstract class Repository {
    protected static string $tableName = "";

    public static function findAll(): array {
        $DBreply = self::getConnection()->query("SELECT * FROM " . static::$tableName);
        $elements_array = $DBreply->fetchAll(PDO::FETCH_OBJ);
        return $elements_array;
    }

    public static function findById(int $id): ?object {
        try {
            $DBreply = self::getConnection()->prepare("SELECT * FROM " . static::$tableName . " WHERE id = ?");
            $DBreply->execute([$id]);
            return $DBreply->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function delete(int $id): bool { 
        try {
            $DBreply = self::getConnection()->prepare("DELETE FROM " . static::$tableName . " WHERE id = ?"); 
            return $DBreply->execute([$id]);
        } catch(Exception $e) {
            return false;
        }
    }

    public static function select(?array $where = array()): array {
        $table = static::$tableName;
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $conditions = array_map(function (string $key) {
                return "$key = ?";
            }, array_keys($where));
            $where_sql = "WHERE " . implode(" AND ", $conditions);
            $sql = $sql . " " . $where_sql;
        }

        $params = array_values($where);
        $connection = self::getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert(array $params): void {
        $keys = array_keys($params);
        $keyString = implode(',', $keys);
        $paramString = implode(',', array_fill(0, count($keys), '?'));
        $table = self::$tableName;
        $sql = "INSERT INTO " . $table . " ({$keyString}) VALUES ({$paramString})";
        $connection = self::getConnection();
        $response = $connection->prepare($sql);
        $response->execute(array_values($params));
    }

    public static function getConnection(): PDO {
        return DBConnection::getInstance();
    }
}