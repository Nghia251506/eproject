<?php
class CartController extends BaseController{
    public function __construct($conn)
    {
        // $this->__brandModel = $this->initModel("BrandModel", $conn);
    }

    public function remove($index){
        // echo($index);
        unset($_SESSION['quantityList'][$index]);
        unset($_SESSION['productList'][$index]);
        header("Location: http://localhost/eproject/product/cart");
    }

    public function payment() {
        // $_SESSION['message'] = "You have successfully placed your order!";
        echo "<script type='text/javascript'>alert('You have successfully placed your order!');</script>";
        // unset($_SESSION['message']); // Clear the message after displaying
        // header("Location: http://localhost/eproject/product/cart");
    }
}