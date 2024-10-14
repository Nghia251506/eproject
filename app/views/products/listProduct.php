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

        th,
        td {
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            /* height:20px */
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            /* border: 1px solid #007BFF; */
            color: #007BFF;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #007BFF;
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }

        .form-search {
            display: flex;
            gap: 10px;
            /* Khoảng cách giữa các input */
        }

        .input-search {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-search {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-search:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"];
    $totalPages = $data["totalPages"];
    $currentPage = $data["currentPage"];
    ?>
    <h2 style="text-align: center;">Search Product</h2>
    <form method="POST" action="http://localhost/eproject/product/searchList" class="form-search">
        <input type="text" name="code" placeholder="Input product code" class="input-search">
        <input type="text" name="name" placeholder="Input product name" class="input-search">
        <input type="submit" value="Tìm kiếm" class="submit-search">
    </form>
    <h2>List Products</h2>
    <table>
        <tr>
            <th>STT</th>
            <th>Product Name</th>
            <th>Code</th>
            <th>Type</th>
            <th>Watt</th>
            <th>Socket</th>
            <th>Color</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Quantity</th>
            <th>Brand</th>
            <th>Desciption</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        $index = 1;
        foreach ($products as $product) : ?>
            <tr>
                <td><?= $index++ ?></td>
                <td style="display: none;"><?= $product->id ?></td>
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
                <td><?= htmlspecialchars($product->description) ?></td>
                <td>
                    <?php if (!empty($product->image_url)): ?>
                        <img src="<?= htmlspecialchars($product->image_url) ?>" alt="Hình Ảnh Sản Phẩm" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="http://localhost/eproject/product/add?id=<?= $product->id ?>" class="fa-solid fa-pen-to-square"></a> ||
                    <a href="http://localhost/eproject/product/delete/<?= $product->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" class="fa-solid fa-trash"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="http://localhost/eproject/product/list/<?= $currentPage - 1; ?>">« Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="http://localhost/eproject/product/list/<?= $i; ?>" class="<?= ($i == $currentPage) ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="http://localhost/eproject/product/list/<?= $currentPage + 1; ?>">Next »</a>
        <?php endif; ?>
    </div>

    <?php

            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>

    <!-- <script src="http://localhost/eproject/app/assets/js/alert.js"></script> -->
</body>

</html>