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
                    <p>Type: Chandelier</p>
                    <p>Watt: 30W</p>
                    <p>Socket: TA1</p>
                    <p>Color: Black</p>
                    <p>Brand: LUIS VUITON</p>
                    <p>Category: Living room lights</p>

                    <div class="price">
                        <h5><b><?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</b></h5>
                    </div>
                    <div class="product-action">
                        <div class="quantity-box">
                            <button id="decrease">-</button>
                            <input type="text" id="quantity" value="1">
                            <button id="increase">+</button>
                        </div>
                        <div class="add-cart-button">
                            <button id="add-to-cart">Add to Cart</button>   
                        </div>
                    </div>
                    
                    <div class="btshop">
                        <p>Hotline: 0523652003</p>
                    </div>
                </div>
            </div>
            <h2>The same product</h2>
            <div class="details">
                <div class="content-details">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg" >
                </div>
                <div class="content-details">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg" >
                </div>
                <div class="content-details">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg" >
                </div>
                <div class="content-details">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg" >
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Sản phẩm không tồn tại.</p>
    <?php endif; ?>

    <script src="http://localhost/eproject/app/assets/js/ProductDetail.js"></script>
</body>
</html>
