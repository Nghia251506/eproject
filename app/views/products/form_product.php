<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm/Sửa Sản Phẩm</title>
    <style>
        .body-form-add {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .product-form-container {
            margin: 0;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 40%;
            /* Chiều rộng của form */
        }

        h2.product-title-form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            /* Màu nền nút */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
            /* Màu nền khi hover */
        }
    </style>
</head>

<body class="addproduct_body-admin">
    <?php
    $data = $input["data"];
    $product = $data["product"] ?? "";
    $brands = $data["brands"] ?? "";
    $types = $data["types"] ?? "";
    ?>

    <?php $isUpdate = !empty($product); ?>

    <div class="body-form-add">
        <div class="product-form-container">
            <form action="http://localhost/eproject/product/add" method="POST" enctype="multipart/form-data">
                <h2 class="product-title-form"><?php echo $isUpdate ? "Cập nhật " : "Thêm "; ?>Sản phẩm</h2>

                <input type="hidden" name="id" value="<?= !empty($product) ? $product->id : '' ?>">
                <input type="text" name="code" value="<?= !empty($product) ? $product->code : '' ?>" readonly>
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="name" value="<?= !empty($product) ? htmlspecialchars($product->name) : '' ?>" required>

                <label for="product_brand_id">Brand:</label>
                <select id="product_brand_id" name="brand_id" required>
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?= $product->brand_id ?? ''?>">
                            <?= htmlspecialchars($brand->brand_name) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <label for="product_type_id">Type:</label>
                <select id="product_type_id" name="type_id" required>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $product->type_id ?? ''?>">
                            <?= htmlspecialchars($type->type_name) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <label for="product_watt">Watt:</label>
                <input type="number" id="product_watt" name="watt" value="<?= !empty($product) ? $product->watt : '' ?>" required>

                <label for="product_socket">Socket:</label>
                <input type="text" id="product_socket" name="socket" value="<?= !empty($product) ? htmlspecialchars($product->socket) : '' ?>">

                <label for="product_color">Color:</label>
                <input type="text" id="product_color" name="color" value="<?= !empty($product) ? htmlspecialchars($product->color) : '' ?>">

                <label for="product_purchase_price">Purchase Price:</label>
                <input type="number" id="product_purchase_price" name="purchase_price" value="<?= !empty($product) ? $product->purchase_price : '' ?>" step="0.01" required>

                <label for="product_sale_price">Sale Price:</label>
                <input type="number" id="product_sale_price" name="sale_price" value="<?= !empty($product) ? $product->sale_price : '' ?>" step="0.01" required>

                <label for="product_quantity">Quantity:</label>
                <input type="number" id="product_quantity" name="quantity" value="<?= !empty($product) ? $product->quantity : '' ?>" required>

                <label for="product_image">Product Image (Link):</label>
                <input type="text" id="product_image" name="image" value="<?= !empty($product) ? htmlspecialchars($product->image_url) : '' ?>">
                <?php if (!empty($product) && $product->image_url): ?>
                    <img src="<?= htmlspecialchars($product->image_url) ?>" alt="Product Image" width="100">
                <?php endif; ?>

                <button type="submit"><?= !empty($product) ? 'Cập nhật' : 'Thêm' ?> sản phẩm</button>
            </form>
        </div>
    </div>

</body>

</html>