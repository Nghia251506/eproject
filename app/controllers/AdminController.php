<?php
    class AdminController extends BaseController{
        private $__adminModel;
        public function __construct($conn)
        {
            $this->__adminModel = $this->initModel("AdminModel", $conn);
        }

        public function index(){
            $this->view("layouts/admin",["page"=>"admin"]);
        }
    }


?>