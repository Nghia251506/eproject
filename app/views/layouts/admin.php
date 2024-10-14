<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doccument</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/base.css">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dropdown {
            position: relative;
            /* Để chứa các phần tử con ở vị trí tuyệt đối */
            cursor: default;
        }

        .dropdown-menu {
            display: none;
            /* Ẩn menu mặc định */
            position: absolute;
            left: 0;
            /* Đặt menu bên trái */
            top: 100%;
            /* Xuống dưới nút toggle */
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1000;
            padding: 10px;
            /* Thêm padding cho menu */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Thêm bóng cho menu */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            /* Hiển thị menu khi hover vào dropdown */
        }

        .dropdown-menu li {
            list-style: none;
            /* Ẩn dấu đầu dòng */
        }

        .dropdown-menu li a {
            text-decoration: none;
            /* Ẩn gạch chân */
            padding: 8px 12px;
            /* Thêm padding cho các mục menu */
            display: block;
            /* Hiển thị mục menu như một khối */
        }

        .dropdown-menu li a:hover {
            background-color: #f0f0f0;
            /* Thay đổi màu nền khi hover vào mục menu */
        }
    </style>
</head>

<body>
    <div class="grid wide">
        <?php
        $this->view("layouts/headerAdmin");
        $this->view($input["page"], ["data" => $input]);
        ?>
    </div>
</body>

</html>