<?php 
namespace App\models;

use PDO;

abstract class Repository implements IRepository { 
    private $connection;
    private $tableName;

    public function __construct(PDO $connection,$tableName){ 
        $this->connection=$connection;
        $this->tableName=$tableName;
    }

    public function findAll(){
        $DBreply=$this->connection->query("select * from {$this->tableName} ;");
        $elements_array=$DBreply->fetchAll(PDO::FETCH_OBJ);
        return $elements_array;


    }

    public function findById(int $id)
    {
    $DBreply=$this->connection->prepare("select * from {$this->tableName} where id= ? ;");
    $DBreply->execute([$id]);
    return $DBreply->fetch(PDO::FETCH_OBJ);

    }

    public function delete($id){ 
        $DBreply=$this->connection->prepare("delete from {$this->tableName} where id= ? ;"); 
        $DBreply->execute([$id]);
    }

    public function add($params)
    {
        $keys=array_keys($params);
        $keyString=implode(',',$keys);
        $paramsString=implode(',',array_fill(0,count($keys),'?'));
        $DBreply=$this->connection->prepare("insert into {$this->tableName} (`id`,{$keyString}) values (NULL,{$paramsString});");
        $DBreply->execute(array_values($params));
    }
}
