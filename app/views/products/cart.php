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
    //die();
    // foreach( $cartItems as $index => $item) {
    //     var_dump($item);
    //     var_dump($index);
    //     echo $_SESSION['quantityList'][$index];
    //     echo "</br>";
    // }
    // foreach( $_SESSION["productList"] as $index => $item) {
    //     var_dump($item);
    //     var_dump($_SESSION["quantityList"][$index]);
    //     echo $_SESSION['quantityList'][$index];
    //     echo "</br>";
    // }
    // unset($_SESSION['quantityList']);
    // unset($_SESSION['productList']);
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
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td>
                        <div style="width: 80px; height: 80px;">
                            <img style="width: 100%; height: 100%; object-fit: cover;" src="<?php echo htmlspecialchars($item->image_url); ?>" alt="">
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($item->name); ?></td>
                    <td><?php echo htmlspecialchars($item->code); ?></td>
                    <td><?php echo htmlspecialchars($item->type_name); ?></td>
                    <td><?php echo htmlspecialchars($item->watt); ?></td>
                    <td><?php echo htmlspecialchars($item->socket); ?></td>
                    <td><?php echo htmlspecialchars($item->color); ?></td>
                    <td><?php echo number_format($item->sale_price, 0, ',', '.'); ?> VND</td>
                    <td><?php echo htmlspecialchars($_SESSION["quantityList"][$index]); ?></td>
                    <td><?php echo number_format($item->sale_price * $_SESSION["quantityList"][$index], 0, ',', '.'); ?> VND</td>
                    <td>
                        <a href="/cart/remove/<?php echo $item->product_id; ?>">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="checkout.php" class="pay">Thanh toán</a>
</body>

</html>