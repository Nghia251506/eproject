<?php
class HomeController extends BaseController{
    private $__homeModel, $__productModel;
    public function __construct($conn)
    {
        $this->__homeModel = $this->initModel("HomeModel", $conn);
        $this->__productModel = $this->initModel("ProductModel",$conn);
    }
    public function index(){
        $products = $this->__productModel->getAllProduct();
        $this->view("layouts/client", ["page"=>"home", "products"=>$products]);
    }
}