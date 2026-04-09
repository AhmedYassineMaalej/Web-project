<?php 
namespace App\Repositories;
use App\Entities\User;

use Exception;
use PDO;


class UserRepository extends Repository {
    protected static string $tableName = "Users";

    private static function convertToUser(object $data): ?User {
        if (!$data) return null;
        return new User(
            $data->ID,
            $data->Username,
            $data->Pwd,
            $data->Role
        );
    }

    public static function getUserByUsername(string $username): ?User {
        $rows = self::select(["Username" => $username]);

        if (count($rows) == 0) {
            return null;
        }

        return self::convertToUser($rows[0]);
    }

    public static function getUserById(int $id) {
        $result = self::findById($id);
        return self::convertToUser($result);
    }

    public static function createUser($username, $hashed_password) {
        $result = self::insert([
            'Username' => $username,
            'Pwd' => $hashed_password
        ]);

        if ($result) {
            return self::getUserByUsername($username);
        }

        return false;
    }
}


