<?php

class BrandModel{
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getAllBrand($limit = 10, $offset = 0){
        try{
            if(isset($this->__conn)){
                $sql = "select * from brand_lights order by id desc LIMIT :limit OFFSET :offset";
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
    public function getBrandById($id){
        try {
            if (isset($this->__conn)) {
                $sql = "select * from brand_lights where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("id", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function saveBrand($brand_name){
        try{
            if($this->__conn){
                $sql = "INSERT INTO type_lights (`brand_name`) VALUES (:brand_name)";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("brand_name", $brand_name, PDO::PARAM_STR);
                $stmt->execute();
                return $this->__conn->lastInsertId();
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}