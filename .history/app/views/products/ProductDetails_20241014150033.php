<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/ProductDetails.css">
    <title>Product Detail Page</title>
</head>

<body>
    <?php
    $data = $input["data"];
    $product = $data["product"] ?? "";
    $similarProducts = $data["similarProducts"] ?? "";
    $similarProduct = $data["similarProduct"] ?? "";
    ?>
    <?php if ($product): ?>
        <div class="container-fluid">
            <div class="slider-box">
                <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
            </div>
            <div class="pro-detail">
                <h2><?php echo htmlspecialchars($product->name); ?></h2>
                <p><?php echo htmlspecialchars($product->code); ?></p>
                <div class="price">
                    <h5><?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</h5>
                </div>
                <div class="quantity-box">
                    <button id="decrease">-</button>
                    <input type="text" id="quantity" value="1">
                    <button id="increase">+</button>
                </div>
                <div class="btshop">
                    <button>ADD TO CART</button>
                </div>
            </div>
            <div class="product-description">
                <h3>Mô tả sản phẩm</h3>
                <p id="short-description"><?php echo htmlspecialchars(substr($product->description, 0, 100)); ?>...</p>
                <p id="full-description" style="display: none;"><?php echo htmlspecialchars($product->description); ?></p>
                <button id="toggle-description" onclick="toggleDescription()">Xem thêm</button>
            </div>
            <h2>The same product</h2>
            <div class="details">
                <?php if (!empty($similarProducts)): ?>
                    <?php foreach ($similarProducts as $similarProduct): ?>
                        <div class="content-details">
                            <img src="<?php echo htmlspecialchars($similarProduct->image_url); ?>" alt="<?php echo htmlspecialchars($similarProduct->name); ?>">
                            <h4><?php echo htmlspecialchars($similarProduct->name); ?></h4>
                            <p><?php echo htmlspecialchars(number_format($similarProduct->sale_price, 0, ',', '.')); ?> VND</p>
                            <button onclick="location.href='http://localhost/eproject/product/detail?id=<?= $similarProduct->id ?>'">Xem chi tiết</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có sản phẩm nào cùng loại.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Sản phẩm không tồn tại.</p>
    <?php endif; ?>

    <script src="http://localhost/eproject/app/assets/js/ProductDetail.js"></script>
</body>

</html>