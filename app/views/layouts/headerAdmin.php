<div class="sidebar">
    <div class="header-sidebar">
        <div class="dashboard"><a href="http://localhost/mvcphp/admin/index" class="link-dashboard">
                <h2 class="title">Admin Dashboard</h2>
            </a></div>
        <div>
            <div class="user-info">
                <div class="dropdown">
                    <?php if (isset($_SESSION["user"])): ?>
                        <span class="username">Welcome, <?php echo $_SESSION["user"]->name; ?></span>
                    <?php endif; ?>
                    <div class="dropdown-menu">
                        <a href="">Cài đặt tài khoản</a></br>
                        <a href="">Đăng xuất</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <ul class="sidebar-list">
        <li><a href="http://localhost/eproject/product/add">Thêm sản phẩm</a></li>
        <li><a href="http://localhost/eproject/product/list">Danh sách sản phẩm</a></li>
        <li><a href=""><i class="fa-solid fa-user"></i> Danh sách Khách hàng</a></li>
        <li><a href=""><i class="fa-solid fa-users"></i> Danh sách Nhân viên</a></li>

    </ul>
</div>