<?php
class CategporyController extends BaseController {
    private $__categoryModel;
    public function __construct($conn)
    {
        $this->__categoryModel = $this->initModel("CategoryModel", $conn);
    }
} 
?>