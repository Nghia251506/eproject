<?php
class HomeController extends BaseController
{
    private $__homeModel, $__productModel, $__categoryModel;
    public function __construct($conn)
    {
        $this->__homeModel = $this->initModel("HomeModel", $conn);
        $this->__productModel = $this->initModel("ProductModel", $conn);
        $this->__categoryModel = $this->initModel("CategoryModel", $conn);
    }
    public function index($page = 1)
    {
        $limit = 10; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $categorys = $this->__categoryModel->getAllCategory();
        $totalProducts = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalProducts / $limit); // Total number of page
        $this->view("layouts/client", [
            "page" => "home",
            "products" => $products,
            "categorys"=>$categorys,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ]);
    }
}
