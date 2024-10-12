<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"];
    ?>
    <h2>List Products</h2>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên Sản Phẩm</th>
            <th>Mã Sản Phẩm</th>
            <th>Loại</th>
            <th>Công Suất</th>
            <th>Socket</th>
            <th>Màu Sắc</th>
            <th>Giá Mua</th>
            <th>Giá Bán</th>
            <th>Số Lượng</th>
            <th>Thương Hiệu</th>
            <th>Hình Ảnh</th>
            <th>Hành Động</th>
        </tr>
        <?php
        $index = 1;
        foreach ($products as $product) : ?>
            <tr>
                <td><?= $index++ ?></td>
                <td style="display: none;"><?= $product->id?></td>
                <td><?= htmlspecialchars($product->name) ?></td>
                <td><?= htmlspecialchars($product->code) ?></td>
                <td><?= htmlspecialchars($product->type_name) ?></td>
                <td><?= htmlspecialchars($product->watt) ?></td>
                <td><?= htmlspecialchars($product->socket) ?></td>
                <td><?= htmlspecialchars($product->color) ?></td>
                <td><?= number_format($product->purchase_price, 2) ?> VNĐ</td>
                <td><?= number_format($product->sale_price, 2) ?> VNĐ</td>
                <td><?= htmlspecialchars($product->quantity) ?></td>
                <td><?= htmlspecialchars($product->brand_name) ?></td>
                <td>
                    <?php if (!empty($product->image_url)): ?>
                        <img src="<?= htmlspecialchars($product->image_url) ?>" alt="Hình Ảnh Sản Phẩm" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="http://localhost/eproject/product/add?id=<?=$product->id?>" class="fa-solid fa-pen-to-square"></a> || 
                    <a href="http://localhost/eproject/product/delete/<?= $product->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" class="fa-solid fa-trash"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- <?php
    
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?> -->

    <!-- <script src="http://localhost/eproject/app/assets/js/alert.js"></script> -->
</body>

</html>
