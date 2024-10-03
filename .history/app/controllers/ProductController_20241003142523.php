<?php
class ProductController extends BaseController
{
    private $__productModel;
    public function __construct($conn)
    {
        $this->__productModel = $this->initModel("ProductModel", $conn);
    }
    public function index() 
    public function list($page = 1){
        $limit = 10; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $totalShows = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalShows / $limit); // Total number of pages

        $this->view("layouts/admin", [
            "page" => "products/list",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page
        ]);
    }
    public function add($id = 0)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Get product information if $id is present, meaning editing
            if ($id > 0) {
                $product = $this->__productModel->getProductById($id);
                $this->view("layouts/admin", ["page" => "products/form_product", "product" => $product]);
            } else {
                // Add new product
                $this->view("layouts/admin", ["page" => "products/form_product"]);
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from form
            $data = [
                'id' => isset($_POST['id']) ? trim($_POST['id']) : null,
                'name' => trim($_POST["name"]),
                'code' => isset($_POST["code"]) ? trim($_POST["code"]) : null,
                'type_id' => trim($_POST["type_id"]),
                'watt' => trim($_POST["watt"]),
                'socket' => trim($_POST["socket"]),
                'color' => trim($_POST["color"]),
                'purchase_price' => trim($_POST["purchase_price"]),
                'sale_price' => trim($_POST["sale_price"]),
                'quantity' => trim($_POST["quantity"]),
                'brand_id' => trim($_POST["brand_id"]),
                'image_url' => null // Initialize the variable containing the image path
            ];

            // Check if there is an image file uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'uploads/';

                // Create unique file names to avoid duplicates
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                // Move files to the destination folder
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // If the upload is successful, save the file path to the $image_url variable
                    $data['image_url'] = $uploadFile;
                } else {
                    echo "An error occurred while downloading the file.";
                }
            } else {
                // Keep old photos if you don't upload new photos
                if ($id > 0) {
                    $product = $this->__productModel->getProductById($id);
                    $data['image_url'] = $product->image_url;
                }
            }

            // Call saveProduct() method from ProductModel
            $result = $this->__productModel->saveProduct($data);

            if ($result) {
                if ($id > 0) {
                    $_SESSION['success_message'] = "The product has been updated successfully!";
                } else {
                    $_SESSION['success_message'] = "Product has been added successfully!";
                }
            } else {
                $_SESSION['error_message'] = "An error occurred while saving the product.";
            }

            // Redirect to product list page
            header("Location: http://localhost/eproject/product/list");
            exit();
        }
    }

    public function delele($id){
        $this->__productModel->deleteProductById($id);
        header("Location: http://localhost/eproject/product/list");
    }
}
