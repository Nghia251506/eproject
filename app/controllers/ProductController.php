<?php
class ProductController extends BaseController
{
    private $__productModel, $__brandModel;
    public function __construct($conn)
    {
        $this->__productModel = $this->initModel("ProductModel", $conn);
        $this->__brandModel = $this->initModel("BrandModel", $conn);
    }
    public function index(){
        $this->view("layouts/client", ["page"=>"products/product"]);
    } 
    public function list($page = 1, $id_brand){
        $limit = 10; // Number of products per page
        $offset = ($page - 1) * $limit; // Calculate offset
        $products = $this->__productModel->getAllProduct($limit, $offset);
        $totalShows = $this->__productModel->countAllProducts();
        $totalPages = ceil($totalShows / $limit); // Total number of pages
        $brand = $this->__brandModel->getBrandById($id_brand);
        $this->view("layouts/admin", [
            "page" => "products/listProduct",
            "products" => $products,
            "totalPages" => $totalPages,
            "currentPage" => $page,
            "brand"=> $brand
        ]);
    }
    public function add($id = null)
    {
        // Kiểm tra nếu là GET request
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Nếu có $id, nghĩa là đang chỉnh sửa sản phẩm
            if (isset($id)) {
                // Lấy thông tin sản phẩm từ database để hiển thị
                $product = $this->__productModel->getProductById($id);
                if ($product) {
                    // Hiển thị form với dữ liệu sản phẩm
                    $this->view("layouts/admin", ["page" => "products/form_product", "product" => $product]);
                } else {
                    echo "Sản phẩm không tồn tại.";
                }
            } else {
                // Hiển thị form trống để thêm sản phẩm mới
                $this->view("layouts/admin", ["page" => "products/form_product"]);
            }
        }

        // Nếu là POST request, xử lý thêm mới hoặc cập nhật sản phẩm
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'id' => trim($_POST["id"]) ?? null,
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
                'image_url' => null
            ];

            // Kiểm tra nếu có file ảnh được upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'uploads/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $data['image_url'] = $uploadFile;
                } else {
                    echo "Có lỗi xảy ra khi tải file.";
                    return;
                }
            } else {
                // Nếu không có ảnh mới, giữ lại ảnh cũ nếu đang sửa sản phẩm
                if ($id) {
                    $product = $this->__productModel->getProductById($id);
                    $data['image_url'] = $product->image_url;
                }
            }

            // Gọi hàm saveProduct từ model
            $result = $this->__productModel->saveProduct($data);

            // Kiểm tra kết quả của saveProduct
            if ($result) {
                $_SESSION['success_message'] = "Sản phẩm đã được lưu thành công!";
            } else {
                $_SESSION['error_message'] = "Có lỗi xảy ra trong quá trình lưu sản phẩm.";
            }
        }
    }

    public function delele($id){
        $this->__productModel->deleteProductById($id);
        header("Location: http://localhost/eproject/product/list");
    }
}
