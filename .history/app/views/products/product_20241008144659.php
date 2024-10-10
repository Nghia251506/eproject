<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <!-- <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/product.css"> -->

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