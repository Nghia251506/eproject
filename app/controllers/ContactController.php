<?php

    class ContactController extends BaseController{
        private $__contactModel;
        public function __construct($conn)
        {
            $this->__contactModel = $this->initModel("ContactModel", $conn);
        }

        public function index(){
            $this->view("layouts/client", ["page"=>"contact"]);
        }
    }