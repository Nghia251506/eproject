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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!isset($_SESSION['productList'])) {
            $_SESSION['productList'] = array();
            $_SESSION['quantityList'] = array();
        }
        $_SESSION['productList'][] = $data["product"];
        $_SESSION['quantityList'][] = $_POST['quantityProduct'];
        
    }
    ?>
    <?php if ($product): ?>
        <div class="container-fluid">
            <div class="product-details-wrapper">
                <div class="slider-box">
                    <div class="image_product">
                        <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
                    </div>
                </div>
                <div class="pro-detail">
                    <h2 style="margin-top: 30px"><?php echo htmlspecialchars($product->name); ?></h2>
                    <p>Code: <?php echo htmlspecialchars($product->code); ?></p>
                    <p>Type: <?php echo htmlspecialchars($product->type_name); ?></p>
                    <p>Watt: <?php echo htmlspecialchars($product->watt); ?></p>
                    <p>Socket: <?php echo htmlspecialchars($product->socket); ?></p>
                    <p>Color: <?php echo htmlspecialchars($product->color); ?></p>
                    <p>Brand: <?php echo htmlspecialchars($product->brand_name); ?></p>

                    <div class="price">
                        <h5><b><?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</b></h5>
                    </div>
                    <form action="" method="POST">
                        <div class="product-action">
                            <div class="quantity-box">
                                <!-- <button id="decrease">-</button> -->
                                <input type="number" id="quantity" value="1" name="quantityProduct">
                                <!-- <button id="increase">+</button> -->
                            </div>
                            <div class="add-cart-button">
                                
                                    <button type="submit" >Add to Cart</button>
                            
                            </div>
                        </div>
                    </form>

                    <div class="btshop">
                        <p>Hotline: 0523652003</p>
                    </div>
                </div>
            </div>
            <div class="product-description">
                <h3>Mô tả sản phẩm</h3>
                <p id="short-description"><?php echo htmlspecialchars(substr($product->description, 0, 100)); ?>...</p>
                <p id="full-description" style="display: none;"><?php echo htmlspecialchars($product->description); ?></p>
                <div style="display: flex; justify-content: center;"> <button id="toggle-description" onclick="toggleDescription()">See more</button></div>
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