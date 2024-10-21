<?php
$products = $data["products"] ?? [];
?>

<div class="product-row">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <div style="width:100%;height:200px;">
                <img style="width: 100%; height:100%; object-fit:cover;" src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>" />
            </div>
            <h3><?php echo htmlspecialchars($product->name); ?></h3>
            <p><?php echo htmlspecialchars($product->code); ?></p>
            <p>Giá: <?php echo htmlspecialchars(number_format($product->sale_price, 2)); ?> USD</p>
            <a href='http://localhost/eproject/product/detail?id=<?= $product->id; ?>'>See all details</a>
        </div>
    <?php endforeach; ?>
</div>
