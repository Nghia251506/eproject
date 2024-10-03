<?php
class HomeController extends BaseController{
    private $__homeModel;
    public function __construct($conn)
    {
        $this->__homeModel = $this->initModel("HomeModel", $conn);
    }
    public function index(){
        $this->view("layouts/client", ["page"=>"home"]);
    }
}