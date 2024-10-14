<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <style>
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
    </style>
</head>

<body>
    <?php
    $data = $input["data"];
    $products = $data["products"] ?? [];
    $totalPages = $data["totalPages"] ?? "";
    $currentPage = $data["currentPage"] ?? "";
    ?>
    <div id="product-container">
        <aside class="sidebar">
            <h2>Tìm Kiếm Sản Phẩm</h2>
            <div class="search-bar">
                <form action="http://localhost/eproject/product/search" method="POST">
                    <input name="name" type="text" placeholder="Nhập tên...">
                    <label>One
                        <span class="checkmark"></span>
                        <input type="checkbox" value=1 name="type_id">
                    </label>
                    <label>Two
                        <span class="checkmark"></span>
                        <input type="checkbox" value=2 name="type_id">
                    </label>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <div class="featured-products">
                <div class="all-products">
                    <h2>Tất Cả Sản Phẩm</h2>
                    <div class="product-row">
                        <?php foreach ($products as $product): ?>
                            <div class="product">
                                <div style="width:100%;height:200px;">
                                    <img style="width: 100%; height:100%; object-fit:cover;" src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>" />
                                </div>
                                <h3><?php echo htmlspecialchars($product->name); ?></h3>
                                <p><?php echo htmlspecialchars($product->code); ?></p>
                                <p>Giá: <?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</p>
                                <a href='http://localhost/eproject/product/detail?id=<?= $product->id; ?>'>Xem Chi Tiết</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="http://localhost/eproject/product/index/<?= $currentPage - 1; ?>">« Trước</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="http://localhost/eproject/product/index/<?= $i; ?>" class="<?= ($i == $currentPage) ? 'active' : ''; ?>"><?= $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="http://localhost/eproject/product/index/<?= $currentPage + 1; ?>">Tiếp »</a>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
