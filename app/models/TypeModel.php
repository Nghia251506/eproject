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
                $sql = "select * from type_lights order by id desc LIMIT :limit OFFSET :offset";
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
}