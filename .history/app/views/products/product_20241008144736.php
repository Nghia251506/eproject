<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <!-- <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/product.css"> -->
     <style>
        /* Container chính */
#product-container {
    display: flex;
    height: 100%;
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


/* Sidebar */
.sidebar {
    width: 25%;
    padding: 20px;
    background-color: #f8f8f8;
    border-right: 1px solid #ddd;
}

.sidebar h2 {
    font-size: 18px;
    margin-bottom: 15px;
}

.sidebar input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Main content */
.main-content {
    width: 75%;
    padding: 20px;
}

/* Các section sản phẩm */
h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.product-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Khoảng cách giữa các sản phẩm */
}


/* Sản phẩm */
.product {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    text-align: center;
    width: calc(25% - 20px); /* 4 sản phẩm trên mỗi hàng */
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.product-frame{
    width: 100%;
    height: 300px;
}

.product img {
    max-width: 100%;
    height: 100%;
    border-radius: 5px;
    object-fit:cover;
}

.product h3 {
    font-size: 18px;
    margin: 10px 0;
}

.product p {
    font-size: 14px;
    color: #555;
}

/* Hiệu ứng hover cho sản phẩm */
.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-product {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #ddd;
    }

    .main-content {
        width: 100%;
    }

    .product {
        width: calc(50% - 20px); /* 2 sản phẩm trên mỗi hàng */
    }
}

@media (max-width: 480px) {
    .product {
        width: 100%; /* 1 sản phẩm trên mỗi hàng */
    }
}
    </style>

</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"] ?? "";
    $product = $data["product"] ?? "";
    ?>
    <div id="product-container">
        <aside class="sidebar">
            <h2>Tìm Kiếm Sản Phẩm</h2>
            <input type="text" placeholder="Tìm kiếm...">
        </aside>

        <main class="main-content">
            <div class="featured-products">
                <div class="all-products">
                    <h2>Tất Cả Sản Phẩm</h2>
                    <div class="product-row">
                        <?php foreach ($products as $product) : ?>
                            <div class="product">
                                <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="Sản phẩm A" />
                                <h3><?php echo htmlspecialchars($product->name); ?></h3>
                                <p><?php echo htmlspecialchars($product->code); ?></p>
                                <p>Giá: <?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</p>
                                <a href='http://localhost/eproject/product/detail?id=<?php echo $product->id; ?>'>See All Details</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>