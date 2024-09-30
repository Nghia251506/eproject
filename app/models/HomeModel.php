<?php

class HomeModel{
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getProductLastest($limit = 4, $offset = 0){
        try{
            if(isset($this->__conn)){
                $sql = "select * from products order by id desc LIMIT :limit OFFSET :offset";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                $stmt->binParam("offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}