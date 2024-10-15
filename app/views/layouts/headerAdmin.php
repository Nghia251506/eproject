<div class="sidebar">
    <div class="header-sidebar">
        <div class="dashboard">
            <a href="http://localhost/eproject/admin/index" class="link-dashboard">
                <h2 class="title">Admin Dashboard</h2>
            </a>
        </div>
        <div>
            <div class="user-info">
                <div class="dropdown">
                    <?php if (isset($_SESSION["user"])): ?>
                        <span class="username">Welcome, <?php echo $_SESSION["user"]->name; ?></span>
                    <?php endif; ?>
                    <div class="dropdown-menu">
                        <a href="">Cài đặt tài khoản</a></br>
                        <a href="http://localhost/eporject/user/login">Đăng xuất</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <ul class="sidebar-list">
        <li><a href="http://localhost/eproject/product/add">ADD PRODUCT</a></li>
        <li><a href="http://localhost/eproject/product/list">LIST PRODUCT</a></li>
    </ul>
</div>