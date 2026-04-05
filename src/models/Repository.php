<?php 
namespace App\models;

use PDO;
use Exception;

abstract class Repository implements IRepository { 
    private $connection;
    private $tableName;

    public function __construct($tableName){  //here we pass one argument to avoid complexity!
        $this->connection=DBConnection::getInstance();
        $this->tableName=$tableName;
    }

    public function findAll(){
        $DBreply=$this->connection->query("select * from {$this->tableName} ;");
        $elements_array=$DBreply->fetchAll(PDO::FETCH_OBJ);
        return $elements_array;
    }

    public function findById(int $id)
    {
        try {
            $DBreply = $this->connection->prepare("select * from {$this->tableName} where id = ?;");
            $DBreply->execute([$id]);
            return $DBreply->fetch(PDO::FETCH_OBJ);  // might return the object or false
        } catch (Exception $e) {
            return false;  
        }
    }

    public function delete($id) : bool{ 
        try{
            $DBreply=$this->connection->prepare("delete from {$this->tableName} where id= ? ;"); 
            return $DBreply->execute([$id]);
        }
        catch(Exception $e){
            return false;
        }
        
    }
    /*
    example of how the method below is called $userRepo->add([
        'username' => 'john_doe',
        'password' => 'secret123',
        'role' => 'admin'
    ]); and it returns a boolean indicating success or failure
    */
    public function add($params) : bool
    {
        try{
            $keys=array_keys($params);
            $keyString=implode(',',$keys);
            $paramsString=implode(',',array_fill(0,count($keys),'?'));
            $DBreply = $this->connection->prepare("insert into {$this->tableName} ({$keyString}) values ({$paramsString});"); //corrected, u dont insert id, its autoincrement
            return $DBreply->execute(array_values($params));
        }
        catch(Exception $e){
            return false;
        }
    }
}
