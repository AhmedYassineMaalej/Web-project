<?php 
namespace App\models;
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
    
    public function __construct(){
        parent::__construct("Users");
    }
    
    private function convertToUser($data) {
        if (!$data) return false;
        return new User(
            $data->ID,
            $data->Username,
            $data->Pwd,
            $data->Role
        );
    }
    
    public function getUserByUsername($username) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM Users WHERE Username = ?");
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $this->convertToUser($result);
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function getUserById($id) {
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


