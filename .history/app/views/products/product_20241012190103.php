<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"] ?? "";
    // var_dum($products);
    // die();
    // $product = $data["product"] ?? "";
    ?>
    <div id="product-container">
        <aside class="sidebar">
            <h2>Tìm Kiếm Sản Phẩm</h2>
            <div class="search-bar">
                <form action="http://localhost/eproject/product/search" method="POST">
                    <input name="name" type="text" placeholder="Input name...">
                    <label >One
                    <span class="checkmark"></span>
                        <input type="checkbox" checked="checked" value="1" name="type_id">
                        
                    </label>
                    <!-- <input name="name" type="checkbox" values="">
                    <input name="name" type="checkbox" values=""> -->
                </form>
            </div>
        </aside>

        <main class="main-content">
            <div class="featured-products">
                <div class="all-products">
                    <h2>Tất Cả Sản Phẩm</h2>
                    <div class="product-row">
                        <?php foreach ($products as $product) : ?>
                            <div class="product">
                                <div style="width:100%;height:200px;"><img style="width: 100%; height:100%;object-fit:cover;" src="<?php echo htmlspecialchars($product->image_url); ?>" alt="Sản phẩm A" /></div>
                                <h3><?php echo htmlspecialchars($product->name); ?></h3>
                                <p><?php echo htmlspecialchars($product->code); ?></p>
                                <p>Giá: <?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</p>
                                <a href='http://localhost/eproject/product/detail?id=<?= $product->id; ?>'>See All Details</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>