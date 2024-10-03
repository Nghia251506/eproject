<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/product.css">
</head>

<body>
    <?php
    $data = $input["data"];
    $product = $data["product"] ?? "";
    ?>
    <?php
    // Nếu $product không rỗng, tức là đang chỉnh sửa
    $isUpdate = !empty($product);
    ?>

    <?php if ($isUpdate && !empty($product->image_url)): ?>
        <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="Ảnh sản phẩm hiện tại" width="100">
    <?php endif; ?>
    <div class="form-container">
        <form action="http://localhost/eproject/product/add" method="POST" enctype="multipart/form-data">
            <h2 class="title-form"><?php echo $isUpdate ? "Cập nhật " : "Thêm "; ?>Sản phẩm</h2>

            <!-- Trường ẩn để lưu id sản phẩm nếu đang chỉnh sửa -->
            <input type="hidden" name="id" value="<?= !empty($product) ? $product->id : '' ?>">

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?= !empty($product) ? $product->name : '' ?>" required>

            <label for="brand_id">Brand:</label>
            <select id="brand_id" name="brand_id" required>
                <?php foreach ($brands as $brand) : ?>
                    <option value="<?= $brand->id ?>" <?= !empty($product) && $product->brand_id == $brand->id ? 'selected' : '' ?>>
                        <?= $brand->name ?>
                    </option>
                <?php endforeach ?>
            </select>

            <label for="type_id">Type:</label>
            <select id="type_id" name="type_id" required>
                <?php foreach ($types as $type) : ?>
                    <option value="<?= $type->id ?>" <?= !empty($product) && $product->type_id == $type->id ? 'selected' : '' ?>>
                        <?= $type->name ?>
                    </option>
                <?php endforeach ?>
            </select>

            <label for="watt">Watt:</label>
            <input type="number" id="watt" name="watt" value="<?= !empty($product) ? $product->watt : '' ?>" required>

            <label for="socket">Socket:</label>
            <input type="text" id="socket" name="socket" value="<?= !empty($product) ? $product->socket : '' ?>">

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?= !empty($product) ? $product->color : '' ?>">

            <label for="purchase_price">Purchase Price:</label>
            <input type="number" id="purchase_price" name="purchase_price" value="<?= !empty($product) ? $product->purchase_price : '' ?>" step="0.01" required>

            <label for="sale_price">Sale Price:</label>
            <input type="number" id="sale_price" name="sale_price" value="<?= !empty($product) ? $product->sale_price : '' ?>" step="0.01" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?= !empty($product) ? $product->quantity : '' ?>" required>

            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($product) && $product->image_url): ?>
                <img src="<?= $product->image_url ?>" alt="Product Image">
            <?php endif; ?>

            <button type="submit"><?= !empty($product) ? 'Update' : 'Add' ?> Product</button>
        </form>
    </div>

</body>

</html>