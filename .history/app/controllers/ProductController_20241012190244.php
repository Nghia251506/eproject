<?php
class ProductController extends BaseController
{
    private $__productModel, $__brandModel, $__typeModel;
    public function __construct($conn)
    {
        $this->__productModel = $this->initModel("ProductModel", $conn);
        $this->__brandModel = $this->initModel("BrandModel", $conn);
        $this->__typeModel = $this->initModel("TypeModel", $conn);
    }
    public function index()
    {
        $products = $this->__productModel->getAllProduct();
        $this->view("layouts/client", ["page" => "products/product", "products" => $products]);
    }

    public function detail()
    {
        $id = $_REQUEST["id"];
        $product = $this->__productModel->getProductById($id);
        $this->view("layouts/client", ["page" => "products/ProductDetails", "product" => $product]);
    }
    public function list($page = 1)
    {
        $limit = 10; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $totalShows = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalShows / $limit); // Total number of pages

        $this->view("layouts/admin", [
            "page" => "products/listProduct",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ]);
    }
    public function add($id = null)
    {
        $brands = $this->__brandModel->getAllBrand();
        $types = $this->__typeModel->getAllType();
        // Kiểm tra nếu là GET request
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_REQUEST["id"] ?? null;
            // Nếu có $id, nghĩa là đang chỉnh sửa sản phẩm
            if (isset($id)) {
                // Lấy thông tin sản phẩm từ database để hiển thị
                $product = $this->__productModel->getProductById($id);
                if ($product) {
                    // Hiển thị form với dữ liệu sản phẩm
                    $this->view("layouts/admin", ["page" => "products/form_product", "product" => $product, "brands"=>$brands, "types"=>$types]);
                } else {
                    echo "Sản phẩm không tồn tại.";
                }
            } else {
                // Hiển thị form trống để thêm sản phẩm mới
                $this->view("layouts/admin", ["page" => "products/form_product", "brands" => $brands, "types" => $types]);
            }
        }

        // Nếu là POST request, xử lý thêm mới hoặc cập nhật sản phẩm
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy và làm sạch dữ liệu
            $id = trim($_POST["id"]) ?? null;
            $name = trim($_POST["name"]);
            $code = isset($_POST["code"]) ? trim($_POST["code"]) : null;
            $type_id = trim($_POST["type_id"]);
            $watt = trim($_POST["watt"]);
            $socket = trim($_POST["socket"]);
            $color = trim($_POST["color"]);
            $purchase_price = trim($_POST["purchase_price"]);
            $sale_price = trim($_POST["sale_price"]);
            $quantity = trim($_POST["quantity"]);
            $brand_id = trim($_POST["brand_id"]);
            $image_url = trim($_POST["image"]);

            // Kiểm tra đầu vào (Ví dụ: kiểm tra rỗng, hợp lệ, ...)
            if (empty($name) || empty($type_id) || empty($watt) || empty($purchase_price) || empty($sale_price) || empty($quantity) || empty($brand_id) || empty($image_url)) {
                // Quản lý lỗi: thông báo cho người dùng
                echo "Vui lòng điền đầy đủ thông tin sản phẩm.";
                return;
            }

            // Gọi hàm saveProduct từ model
            if ($id > 0) {
                $result = $this->__productModel->editProduct($id, $name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url);
            } else {
                $result = $this->__productModel->saveProduct($name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url);
            }

            if ($result) {
                header("Location: http://localhost/eproject/product/list");
                exit();
            } else {
                // Thông báo lỗi nếu lưu không thành công
                echo "Có lỗi xảy ra khi thêm sản phẩm. Vui lòng thử lại.";
            }
        }
    }

    public function delete($id)
    {
        $this->__productModel->deleteProductById($id);
        header("Location: http://localhost/eproject/product/list");
    }

    public function cart(){
        $this->view("layouts/client", ["page"=>"products/cart"]);
    }

    public function search($page = 1){
        // if ($_SERVER["REQUEST_METHOD"] == "POST"){}
        //     $name = $_POST['name'] ?? '';
        // }
        $name = $_POST['name'] ?? '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        var_dump($name);
        var_dump($type_id);
    
        $products = $this->__productModel->searchProduct($name, $limit, $offset);
        // var_dump($products);
        // Lấy tổng số record để phân trang
        $totalShows = $this->__productModel->countProducts($name);
        $totalPages = ceil($totalShows / $limit);
    
        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ]);
    }
}
