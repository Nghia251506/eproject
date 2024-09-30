<?php
class ProductModel{
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }
    //This function is used to retrieve all products
    public function getAllProduct($limit = 10, $offset = 0){
        try{
            if(isset($this->__conn)){
                $sql = "select * from products order by id desc LIMIT :limit OFFSET :offset";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return null; //Returns null if there is no connection to the database
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function getProductById($id){
        try{
            if($this->__conn){
                $sql = "select * from products where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function saveProduct(){
        
    }
}