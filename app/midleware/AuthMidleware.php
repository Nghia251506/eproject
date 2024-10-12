<?php 
class AuthMidleware {
    // những path phải qua đăng nhập
    private $__paths = [];
    public function __construct(array $paths) 
    {
        $this->__paths = $paths;
    }

    // function để kiểm tra path đầu vào có phải đăng nhập hay không?
    public function execute($info) {
        //$info : là thông tin path đầu vào, là 1 array (xem App.php dòng 37)
        $controller = $info[0];
        $action = $info[1];
        // kiem tra controller có phải là admin hay không
        if ($controller == "admin") {
            // Kiểm tra xem đã đăng nhập hay chưa, nếu đăng nhập rồi thì có thông tin trong session
            if (isset($_SESSION["user"])) {
                // đã đăg nhập
                $role = $_SESSION["user"]->role;
                // kiêm tra xem có phải role admin hay không?
                if ($role != "admin") {
                    // báo lỗi k có quyền truy cập
                    $this->handleErrorPage();
                }
            } else {
                // Nếu chưa đăng nhập -> đi tới trang login
                header("Location: http://localhost/eproject/user/login");
            }
        } else {
            // là user thường chưa đăng nhập 
            if (!isset($_SESSION["user"])) {
                // Kiểm tra xem có phải path là admin nhưng cần đăng nhập hay không
                if (in_array($controller."/".$action, $this->__paths)) {
                    // nếu đúng thì yêu cầu đăng nhập
                    header("Location: http://localhost/eproject/user/login");
                }
            }
        }
    }

    public function handleErrorPage() {
        require_once "app/views/errors/403.php";
        exit();
    }

}

?>