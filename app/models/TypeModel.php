<?php

class TypeModel{
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getAllType($limit = 10, $offset = 0){
        try{
            if(isset($this->__conn)){
                $sql = "select * from type_lights LIMIT :limit OFFSET :offset";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function getTypeById($id){
        try{
            if($this->__conn){
                $sql = "select * from type_lights where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function saveType($type_name){
        try{
            if($this->__conn){
                $sql = "INSERT INTO type_lights (`type_name`) VALUES (:type_name)";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("type_name", $type_name, PDO::PARAM_STR);
                $stmt->execute();
                return $this->__conn->lastInsertId();
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}