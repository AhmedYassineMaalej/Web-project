<?php 
namespace App\Models;
use Exception;
use PDO;

/*

Flow: DBConnection → Repository → UserRepository → User object
UserRepository offers 4 functions in total

convertToUser($data):
    $dummyData = (object)['ID' => 1, 'Username' => 'john', 'Pwd' => 'hash', 'Role' => 'admin'];
    $user = $this->convertToUser($dummyData);

getUserByUsername(string as username) => returns a user object
getUserById(id) => returns user object

createUser(username,hashed password) -> returns either [user object or false] indicating success or failure (it contacts mother class to insert into db)
*/


class UserRepository extends Repository {
    static private $tableName = "Users";

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
        try {
            $table = self::$tableName;
            $stmt = $this->connection->prepare("SELECT * FROM $table WHERE Username = ?");
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $this->convertToUser($result);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getUserById(int $id) {
        $result = $this->findById($id);
        return $this->convertToUser($result);
    }

    public function createUser($username, $hashed_password) {
        $result = $this->add([
            'Username' => $username,
            'Pwd' => $hashed_password
        ]);

        if ($result) {
            return $this->getUserByUsername($username);
        }

        return false;
    }
}


