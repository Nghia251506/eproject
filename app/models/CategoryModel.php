<?php
class CategoryModel {
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getAllCategory(){
        try{
            if(isset($this->__conn)){
                $sql = "SELECT * from categorys";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return null;
        }catch(PDOException $ex){
            echo "ERROR". $ex->getMessage();
        }
    }
} 
?>