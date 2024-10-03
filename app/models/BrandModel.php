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
}