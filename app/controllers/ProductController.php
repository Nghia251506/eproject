<?php
class ProductController extends BaseController
{
    private $__productModel, $__brandModel, $__typeModel, $__cartModel;
    public function __construct($conn)
    {
        $this->__productModel = $this->initModel("ProductModel", $conn);
        $this->__brandModel = $this->initModel("BrandModel", $conn);
        $this->__typeModel = $this->initModel("TypeModel", $conn);
        $this->__cartModel = $this->initModel('CartModel', $conn);
    }
    public function index($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalProducts / $limit); // Total number of page
        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function detail()
    {
        $limit = 10;
        $offset = 0;
        $id = $_REQUEST["id"];
        $product = $this->__productModel->getProductById($id);
        if (!empty($product)) {
            $similarProducts = $this->__productModel->getProductByType($product->type_id, $limit, $offset);
            $this->view("layouts/client", [
                "page" => "products/ProductDetails",
                "product" => $product,
                "similarProducts" => $similarProducts
            ]);
        } else {
            // Nếu sản phẩm không tồn tại
            echo "Sản phẩm không tồn tại.";
        }
    }


    public function list($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $totalProducts = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalProducts / $limit); // Total number of pages

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
                    $this->view("layouts/admin", ["page" => "products/form_product", "product" => $product, "brands" => $brands, "types" => $types]);
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
            $description = trim($_POST["description"]);
            // Lấy tên thương hiệu và loại mới
            $brand_name = trim($_POST["brand_name"]) ?? null;
            $type_name = trim($_POST["type_name"]) ?? null;

            // Kiểm tra đầu vào (Ví dụ: kiểm tra rỗng, hợp lệ, ...)
            if (empty($name) || empty($type_id) || empty($watt) || empty($purchase_price) || empty($sale_price) || empty($quantity) || empty($brand_id) || empty($image_url)) {
                // Quản lý lỗi: thông báo cho người dùng
                echo "Please fill in complete product information.";
                return;
            }
            // Kiểm tra và thêm thương hiệu mới
            if (!empty($new_brand_name)) {
                $brand_id = $this->__brandModel->saveBrand($brand_name); // Hàm thêm thương hiệu mới
            }

            // Kiểm tra và thêm loại mới
            if (!empty($new_type_name)) {
                $type_id = $this->__typeModel->saveType($type_name); // Hàm thêm loại mới
            }

            // Gọi hàm saveProduct từ model
            if ($id > 0) {
                $result = $this->__productModel->editProduct($id, $name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url, $description);
            } else {
                $result = $this->__productModel->saveProduct($name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url, $description);
            }

            if ($result) {
                header("Location: http://localhost/eproject/product/list");
                exit();
            } else {
                // Thông báo lỗi nếu lưu không thành công
                echo "An error occurred while adding a product. Please try again.";
            }
        }
    }

    public function delete($id)
    {
        $this->__productModel->deleteProductById($id);
        header("Location: http://localhost/eproject/product/list");
    }

    public function cart()
    {
        // Giả sử bạn đã khởi tạo CartModel trong BaseController (hoặc ProductController)
        $userId = $_SESSION['user_id'] ?? null; // Lấy user_id từ session

        // Kiểm tra xem người dùng đã đăng nhập chưa
        // if (!$userId) {
        //     echo "Bạn cần đăng nhập để xem giỏ hàng.";
        //     return;
        // }

        // Lấy đơn hàng của người dùng
        $order = $this->__cartModel->getOrderByUser($userId);

        if ($order) {
            // Lấy các sản phẩm trong giỏ hàng nếu có order
            $orderItems = $this->__cartModel->getOrderItems($order['id']);
            $this->view("layouts/client", ["page" => "products/cart", "orderItems" => $orderItems, "order" => $order]);
        } else {
            // Nếu không có đơn hàng, giỏ hàng trống
            $this->view("layouts/client", ["page" => "products/cart", "orderItems" => [], "order" => null]);
        }
    }

    public function addCart() {}

    public function removeFromCart($productId)
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo "You need to be logged in to perform this action.";
            return;
        }

        // Lấy đơn hàng hiện tại của người dùng
        $order = $this->__cartModel->getOrderByUser($userId);

        if ($order) {
            // Xóa sản phẩm khỏi giỏ hàng
            $this->__cartModel->removeFromCart($order['id'], $productId);
            header("Location: http://localhost/eproject/product/cart"); // Điều hướng lại trang giỏ hàng sau khi xóa
            exit();
        } else {
            echo "Không tìm thấy đơn hàng.";
        }
    }

    public function search($page = 1)
    {
        $name = trim($_POST["name"] ?? '');
        $code = trim($_POST["code"] ?? '');
        $brand_ids = $_POST["brand_id"] ?? 0; // Sử dụng mảng để chứa nhiều ID thương hiệu
        $limit = 8;
        $offset = ($page - 1) * $limit;

        // Tìm sản phẩm
        $products = $this->__productModel->searchProduct($name, $brand_ids, $limit, $offset, $code);
        $brands = $this->__brandModel->getAllBrand();

        // Kiểm tra nếu yêu cầu là AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // Nếu là AJAX, chỉ trả về phần sản phẩm
            $this->view("products/productResults", [
                "products" => $products
            ]);
            return; // Ngừng thực thi nếu đã xử lý AJAX
        }

        // Lấy tổng số record để phân trang
        $totalProducts = $this->__productModel->countProducts($name);
        $totalPages = ceil($totalProducts / $limit);

        // Nếu không phải AJAX, hiển thị toàn bộ trang
        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }


    public function searchList($page = 1)
    {
        $name = trim($_POST["name"]) ?? '';
        $code = trim($_POST["code"]) ?? '';
        $type_id = $_POST["type_id"] ?? 0;
        $limit = 8;
        $offset = ($page - 1) * $limit;
        $products = $this->__productModel->searchProduct($name, $type_id, $limit, $offset, $code);

        // Lấy tổng số record để phân trang
        $totalShows = $this->__productModel->countProducts($name);
        $totalPages = ceil($totalShows / $limit);

        $this->view("layouts/admin", [
            "page" => "products/listProduct",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
        ]);
    }


    public function ceiling($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('1', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('1');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function table($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('2', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('2');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function wall($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('3', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('3');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }


    public function pendant($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('4', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('4');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function led($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('5', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('5');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function outdoor($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('6', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('6');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }

    public function spotlight($page = 1)
    {
        $limit = 8; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset

        // Lấy sản phẩm thuộc category 'ceiling'
        $products = $this->__productModel->getProductsByCategory('7', $limit, $offset);

        $brands = $this->__brandModel->getAllBrand();
        $totalProducts = $this->__productModel->countProductsByCategory('7');
        $totalPages = ceil($totalProducts / $limit); // Total number of page

        $this->view("layouts/client", [
            "page" => "products/product",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brands" => $brands
        ]);
    }
}
