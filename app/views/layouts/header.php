<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/453b49545e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/header.css">
  <title>Header Example</title>
  <style>
    #user-menu {
      position: relative;
    }

    #user-name {
      cursor: pointer;
    }

    #dropdown {
      width: 130px;
      display: none;
      position: absolute;
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    #user-menu:hover #dropdown {
      display: block;
    }

    #dropdown li {
      padding: 10px;
    }

    #dropdown li a {
      text-decoration: none;
      color: black;
    }

    #dropdown li:hover {
      background: #f0f0f0;
    }
  </style>
</head>

<body>
  <div class="header">
    <div class="header-container">
      <div class="logo">
        <div class="logo-image">
          <img src="http://localhost/eproject/app/assets/data/LG.png" alt="Logo">
        </div>
        <div class="logo-name">
          <a href="http://localhost/eproject/home/index">Luminous <br> Garden</a>
        </div>
      </div>

      <div class="search-form">
        <form action="http://localhost/eproject/product/search" method="POST">
          <input name="name" type="text" placeholder="Input name...">
        </form>
      </div>

      <div class="header-right" id="user-menu">
        <div class="login">
          <?php if (isset($_SESSION['user'])): ?>
            <a href="#" id="user-name">Welcome, <?php echo $_SESSION['user']->name; ?></a>
            <ul id="dropdown">
              <li><a href="http://localhost/eproject/user/settings">Setting</a></li>
              <li><a href="http://localhost/eproject/user/logout">Logout</a></li>
            </ul>
          <?php else: ?>
            <a href='http://localhost/mvcphp/user/login'>
              <span>Đăng Nhập</span>
            </a>
          <?php endif; ?>
        </div>
        <div class="shopping">
          <a href="http://localhost/eproject/product/cart">CART <i class="fa-solid fa-shop"></i></a>
        </div>
        <!-- <div class="mobile-navbar-icon" onclick="toggleNavbar()">
          <i class="fa-solid fa-bars"></i> 
        </div> -->
      </div>
    </div>
  </div>

  <div class="nav">
    <div class="nav-container">
      <div class="nav-item">
        <a href="http://localhost/eproject/home/index">HOME</a>
        <a href="#">CUSTOM FURNITURE</a>
        <a href='http://localhost/eproject/product/index'>SHOP</a>
        <a href="#">ART COLLECTION</a>
        <a href="#">PILLOWS</a>
        <a href="#">CANDLES</a>
        <a href="#">GOOD DEALS</a>
        <a href="http://localhost/eproject/contact/index">CONTACT US</a>
      </div>
    </div>
  </div>

  <div class="mobile-navbar">
    <div class="mobile-navbar_home">
      <a href="http://localhost/eproject/home/index">
        <i class="fa-solid fa-house"></i>
        <p>HOME</p>
      </a>
      <a href="http://localhost/eproject/product/index">
        <i class="fa-solid fa-shop"></i>
        <p>SHOP</p>
      </a>
      <a href="http://localhost/eproject/user/login">
        <!-- <i class="fa-regular fa-circle-user"></i> -->
        <?php if (isset($_SESSION['user'])): ?>
            <a href="#" id="user-name">Welcome, <?php echo $_SESSION['user']->name; ?></a>
            <ul id="dropdown">
              <li><a href="http://localhost/eproject/user/settings">Setting</a></li>
              <li><a href="http://localhost/eproject/user/logout">Logout</a></li>
            </ul>
          <?php else: ?>
            <a href='http://localhost/mvcphp/user/login'>
              <span>Đăng Nhập</span>
            </a>
          <?php endif; ?>
      </a>
      <!-- <a href="">
        <i class="fa-solid fa-house"></i>
        <p>HOME</p>
      </a> -->
    </div>
  </div>

  <script>
    function toggleNavbar() {
      const navbar = document.getElementById('mobileNavbar');
      navbar.classList.toggle('show'); // Thêm hoặc xóa lớp show
    }
  </script>
</body>

</html>