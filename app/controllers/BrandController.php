<?php
class BrandController extends BaseController{
    private $__brandModel;
    public function __construct($conn)
    {
        $this->__brandModel = $this->initModel("BrandModel", $conn);
    }

    public function list(){
        try{
            
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}