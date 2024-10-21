<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/home.css">
    <title>Document</title>
</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"] ?? "";
    $categorys = $data["categorys"] ?? "";
    // var_dump($products);
    // die();
    ?>

    <section class="slider slider-adv d-lg-block d-none my-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-2">
                    <div class="img-adv">
                        <div class="img-adv_item">
                            <img src="https://denhoamy.vn/upload/partner/3470benner-the-gioi-den-nghe-thuat-va-noi-that-trang-tri-den-hoa-my-vn-1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 right pl-2">
                    <div class="owl-stages mb-2">
                        <img src="https://denhoamy.vn/upload/partner/7850den-hoa-my-dia-chi-mua-den-uy-tin-tai-hai-phong.jpg" alt="">
                    </div>
                    <div class="policy row no-gutters pl-2">
                        <div class="col-6 d-flex items">
                            <img class="my-auto" src="https://denhoamy.vn/upload/partner/287317-512.png">
                            <div class="info pl-1">
                                <p class="d-block mb-0 text-uppercase">MẪU MỚI ĐA DẠNG </p>
                                <div class="category mb-0">Luôn đi đầu xu hướng sản phẩm
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex items">
                            <img class="my-auto" src="https://denhoamy.vn/upload/partner/4940giao-hang-toan-quoc.png">
                            <div class="info pl-1">
                                <p class="d-block mb-0 text-uppercase">SHIP COD TOÀN QUỐC</p>
                                <div class="category mb-0">Vận chuyển giá rẻ, nhanh chóng, tiết kiệm
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex items">
                            <img class="my-auto" src="https://denhoamy.vn/upload/partner/7925bao-hanh.png">
                            <div class="info pl-1">
                                <p class="d-block mb-0 text-uppercase">NGUYỄN TRỌNG NGHĨA</p>
                                <div class="category mb-0">TK:&nbsp;10915062002 tại&nbsp;Ngân Hàng Tiên Phong Bank&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex items">
                            <img class="my-auto" src="https://denhoamy.vn/upload/partner/3766ho-tro-24-7.png">
                            <div class="info pl-1">
                                <p class="d-block mb-0 text-uppercase">TƯ VẤN MUA HÀNG VÀ LẮP ĐẶT 24/7</p>
                                <div class="category mb-0">Nhận đặt làm các mẫu theo thiết kế
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg pt-3 best-product">
        <div class="container pb-3 pt-3">
            <div class="best-product-wrap px-3 pb-3">
                <p class="text-center">
                    <span class="title">
                        The Best Product
                    </span>
                </p>
                <div class="best-sell list-products mt-4 owl-carousel owl-theme owl-best-sell owl-loaded owl-drag">
                    <div class="owl-stage-outer d-flex">
                        <?php foreach ($products as $product) : ?>
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 4504p">
                                <div class="owl-item" style="width: 205.2px; margin-right: 20px;">
                                    <div class="item">
                                        <div class="product-box text-center mx-auto">
                                            <a href="http://localhost/eproject/product/detail?id=<?= $product->id; ?>" class="d-flex img-box ">
                                                <img src="<?php echo htmlspecialchars($product->image_url) ?>" class="" alt="Đèn chùm tiffany trang trí nội thất DC03596">
                                            </a>
                                            <div class="info-box p-2">
                                                <h4 class="product-name mb-2"><a class="d-block" href="http://localhost/eproject/product/detail?id=<?= $product->id; ?>"><?= $product->name ?></a></h4>
                                                <div class="price-more d-flex mb-0 justify-content-center align-items-center">
                                                    <span class="price mr-3"><strong>Liên hệ</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php foreach ($categorys as $category): ?>
        <section class="home-product pt-3 bg pb-3">
            <div class="container">
                <div class="wrap bg_white best-product-wrap px-3 pb-3">
                    <div class="d-lg-flex justify-content-between align-items-center  pr-3 pr-md-0  header-wrap">
                        <div class="pl-0 col-lg-3 col-xl-2 text-center title-link">

                            <a href="http://localhost/eproject/product/<?= $category->category_name ?>" class="d-block  mb-0 text-uppercase">
                                <p class="text-center">
                                    <span class="title-product"><?= $category->category_name ?></span>
                                </p>
                            </a>

                        </div>
                    </div>
                    <div class="list-products row no-gutters pad20">
                        <?php foreach ($products as $product):?>
                            <?php if ($category->id == $product->category_id):?>
                                <div class="item col-6 col-md-4 ">
                                    <div class="product-box text-center p-3">
                                        <a href="http://localhost/eproject/product/detail?id=<?= $product->id ?>" class="d-flex img-box">
                                            <img class="my-auto mx-auto ls-is-cached lazyloaded" alt="ảnh sản phẩm" src="<?php echo htmlspecialchars($product->image_url) ?>">
                                        </a>
                                        <div class="info-box p-2">
                                            <h4 class="product-name mb-2 fs-6">
                                                <a class="d-block" href="http://localhost/eproject/product/detail?id=<?= $product->id ?>"> <?= $product->name ?>
                                            </a>
                                        </h4>
                                            <h6><?= $product->code?></h6>
                                            <div class="price-more d-flex mb-0 justify-content-center align-items-center fs-6">
                                                <span class="price mr-3"><strong>Liên hệ</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

</body>

</html>