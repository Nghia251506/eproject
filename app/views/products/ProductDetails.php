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
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_SESSION['productList'])) {
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
                    <p style="display:none">Code: <?php echo htmlspecialchars($product->type_id); ?></p>
                    <p>Type: <?php echo htmlspecialchars($product->type_name); ?></p>
                    <p>Watt: <?php echo htmlspecialchars($product->watt); ?></p>
                    <p>Socket: <?php echo htmlspecialchars($product->socket); ?></p>
                    <p>Color: <?php echo htmlspecialchars($product->color); ?></p>
                    <p>Brand: <?php echo htmlspecialchars($product->brand_name); ?></p>
                    <p>Category: <?php echo htmlspecialchars($product->category_name); ?></p>

                    <div class="price">
                        <h5><b><?php echo htmlspecialchars(number_format($product->sale_price, 2)); ?> USD</b></h5>
                    </div>
                    <form action="" method="POST">
                        <div class="product-action">
                            <div class="quantity-box">
                                <!-- <button id="decrease">-</button> -->
                                <input type="number" id="quantity" value="1" name="quantityProduct">
                                <!-- <button id="increase">+</button> -->
                            </div>
                            <div class="add-cart-button">

                                <button type="submit">Add to Cart</button>

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
            <!-- <h2></h2>
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
            </div> -->

            <section class="bg pt-3 best-product">
                <div class="container pb-3 pt-3">
                    <div class="best-product-wrap px-3 pb-3">
                        <p class="text-center">
                            <span class="title">
                                THE SAME PRODUCTS
                            </span>
                        </p>
                        <div class="best-sell list-products mt-4 owl-carousel owl-theme owl-best-sell owl-loaded owl-drag">
                            <div class="owl-stage-outer d-flex">
                                <?php if (!empty($similarProducts)): ?>
                                    <?php foreach ($similarProducts as $similarProduct) : ?>
                                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 4504p">
                                            <div class="owl-item" style="width: 205.2px; margin-right: 20px;">
                                                <div class="item">
                                                    <div class="product-box text-center mx-auto">
                                                        <a href="http://localhost/eproject/product/detail?id=<?= $similarProduct->id ?>" class="d-flex img-box ">
                                                            <img src="<?php echo htmlspecialchars($similarProduct->image_url) ?>" alt="<?php echo htmlspecialchars($similarProduct->name); ?>">
                                                        </a>
                                                        <div class="info-box p-2">
                                                            <h4 class="product-name mb-2"><a class="d-block" href="http://localhost/eproject/product/detail?id=<?= $similarProduct->id ?>"><?= $similarProduct->name ?></a></h4>
                                                            <div class="price-more d-flex mb-0 justify-content-center align-items-center">
                                                                <span class="price mr-3"><strong>Contact</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Không có sản phẩm nào cùng loại.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php else: ?>
        <p>Sản phẩm không tồn tại.</p>
    <?php endif; ?>

    <script src="http://localhost/eproject/app/assets/js/ProductDetail.js"></script>
</body>

</html>