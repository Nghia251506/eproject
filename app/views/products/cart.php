<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/cart.css">
</head>

<body class="cart-page">
    <?php
    if (isset($_GET['added']) && $_GET['added'] == 'true') {
        echo "<p style='color: green;'>Sản phẩm đã được thêm vào giỏ hàng!</p>";
    }
    $cartItems = $_SESSION["productList"];
    // print_r($cartItems);
    // die();

    ?>

    <h1>Your shopping cart</h1>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Code</th>
                <th>Type</th>
                <th>Watt</th>
                <th>Socket</th>
                <th>Color</th>
                <th>Sale_price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($_SESSION['productList']) && !empty($_SESSION['productList'])): ?>
                <?php foreach ($_SESSION['productList'] as $item): ?>
                    <tr>
                    <td><img src="<?php $item['image_url']; ?>" alt="<?php $item['name']; ?>"></td>
                        <td><?php $item['name']; ?></td>
                        <td><?php $item['code']; ?></td>
                        <td><?php $item['type_name']; ?></td>
                        <td><?php $item['watt']; ?></td>
                        <td><?php $item['socket']; ?></td>
                        <td><?php $item['color']; ?></td>
                        <td><?php number_format($item['sale_price'], 0, ',', '.'); ?> VND</td>
                        <td><?php $item['quantity']; ?></td>
                        <td><?php number_format($item['price_subtotal'], 0, ',', '.'); ?> VND</td>
                        <td>
                            <a href="/cart/remove/<?php echo $item['product_id']; ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Giỏ hàng của bạn trống.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="checkout.php" class="pay">Thanh toán</a>
</body>

</html>