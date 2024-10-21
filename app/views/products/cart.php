<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/cart.css">
    <style>
        .title {
            font-size: 15px !important;
            font-weight: 700 !important;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .form-control {
            margin-top: 10px;
        }

        .content {
            background-color: #FAFAFA;
        }

        .img-qr {
            width: 150px;
            height: 150px;
        }

        .QR-pay {
            max-width: 100%;
            height: 100%;
            border-radius: 5px;
            object-fit: cover;
        }

        .end-form {
            display: flex;
            justify-content: space-between;
        }

        .table_ordered {
            width: 100%;
        }

        .img-wrap {
            width: 100px;
            height: 100px;
            margin-left: 10px;
        }

        .img-wrap img {
            max-width: 100%;
            height: 100%;
            border-radius: 5px;
            object-fit: cover;
        }

        .input_cart input {
            max-width: 30px;
            border: 1px solid rgb(185, 185, 185);
        }

        .btn-minus {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            border: 1px solid rgb(185, 185, 185);
            background-color: #FAFAFA;
        }

        .btn-plus {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border: 1px solid rgb(185, 185, 185);
            background-color: #FAFAFA;
        }
    </style>
</head>

<body class="cart-page">
    <?php
    // Hiển thị thông báo nếu có
    if (isset($_GET['added']) && $_GET['added'] == 'true') {
        echo "<p style='color: green;'>Sản phẩm đã được thêm vào giỏ hàng!</p>";
    }
    $cartItems = $_SESSION["productList"];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Xử lý thanh toán
        $paymentSuccess = true;
        if ($paymentSuccess) {
            $_SESSION['payment_message'] = "Payment was successful! Thank you for your purchase.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['payment_message'] = "Payment failed. Please try again.";
        }
    }

    // Hiển thị thông báo thanh toán
    if (isset($_SESSION['payment_message'])) {
        echo "<script type='text/javascript'>alert('" . addslashes($_SESSION['payment_message']) . "');</script>";
        unset($_SESSION['payment_message']);
    }
    ?>

    <div class="shoping py-4 col-12">
        <div class="container">
            <div class="row">
                <div class="content col-lg-6 pr-md-3 pr-lg-4">
                    <div class="shoping-order">
                        <p class="title">Delivery information</p>
                        <form id="order-form" action="" method="POST">
                            <div class="row">
                                <div class="form-group col-12">
                                    <input type="text" id="orderform-fullname" class="form-control" name="OrderForm[fullname]" placeholder="FullName" required>
                                </div>
                                <div class="form-group col-6 pr-1">
                                    <input type="email" id="orderform-email" class="form-control" name="OrderForm[email]" placeholder="Email" required>
                                </div>
                                <div class="form-group col-6 pl-1">
                                    <input type="tel" id="orderform-phone" class="form-control" name="OrderForm[phone]" placeholder="Phone" required>
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" id="orderform-address" class="form-control" name="OrderForm[address]" placeholder="Address" required>
                                </div>
                                <div class="form-group col-12">
                                    <textarea id="orderform-messenger" class="form-control" name="OrderForm[messenger]" placeholder="Messenger"></textarea>
                                </div>
                                <p class="col-12 title">Payment method</p>
                                <div class="col-12 mb-3">
                                    <div class="custom_radio_box border rounded">
                                        <div class="radio-wrap">
                                            <div class="radio">
                                                <input checked type="radio" name="OrderForm[type_id]" value="1" id="customRadio1">
                                                <label for="customRadio1"><span>Cash on Delivery</span></label>
                                            </div>
                                            <div class="blank-slate p-4 text-center border-bottom" id="cod-info">
                                                <p>For customers in Hanoi, we have home delivery and payment collection services.</p>
                                            </div>
                                        </div>

                                        <div class="radio-wrap">
                                            <div class="radio">
                                                <input type="radio" name="OrderForm[type_id]" value="2" id="customRadio2">
                                                <label for="customRadio2"><span>Bank transfer</span></label>
                                            </div>
                                            <div class="blank-slate p-4 text-center" id="bank-info" style="display:none;">
                                                <p>Please transfer money to our account at the QR code below.</p>
                                                <div class="img-qr">
                                                    <img class="QR-pay" src="http://localhost/eproject/app/assets/data/QR.jpg" alt="QR code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 end-form">
                                    <a href="/shopping-cart.html" class="btn"><i class="fas fa-angle-left"></i> Giỏ hàng </a>
                                    <form method="post">
                                        <button type="submit" class="btn btn-submit btn-warning">Make Payment</button>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pl-md-3 pl-lg-4">
                    <div class="shopping-order-cart">
                        <table class="table_ordered mt-4">
                            <tbody>
                                <?php foreach ($cartItems as $index => $item): ?>
                                    <tr>
                                        <td class="img-wrap">
                                            <span class="img-box border rounded">
                                                <a href="" class="img d-flex">
                                                    <img class="m-auto" src="<?php echo htmlspecialchars($item->image_url); ?>" alt="<?php echo htmlspecialchars($item->name); ?>">
                                                </a>
                                            </span>
                                        </td>
                                        <td class="info">
                                            <h4 class="product-name mb-0">
                                                <a href=""><?php echo htmlspecialchars($item->name); ?></a>
                                            </h4>
                                            <div class="row no-gutters">
                                                <div class="col-6">
                                                    <div class="input_cart d-flex">
                                                        <button onclick="minusOrder(this, '<?php echo $index; ?>')" class="btn-minus btn-cts" type="button">–</button>
                                                        <input type="text" readonly id="qty-<?php echo $index; ?>" value="1" min="1" max="10">
                                                        <button onclick="plusOrder(this, '<?php echo $index; ?>')" class="btn-plus btn-cts" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <p class="red"><span class="total-price" id="price-<?php echo $index; ?>" data-price="<?php echo $item->sale_price; ?>"><?php echo number_format($item->sale_price, 0, ',', '.'); ?> USD</span></p>
                                                    <a href="http://localhost/eproject/cart/remove"><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const codRadio = document.getElementById('customRadio1');
            const bankRadio = document.getElementById('customRadio2');
            const codInfo = document.getElementById('cod-info');
            const bankInfo = document.getElementById('bank-info');

            function togglePaymentInfo() {
                if (codRadio.checked) {
                    codInfo.style.display = 'block';
                    bankInfo.style.display = 'none';
                } else {
                    codInfo.style.display = 'none';
                    bankInfo.style.display = 'block';
                }
            }

            codRadio.addEventListener('click', togglePaymentInfo);
            bankRadio.addEventListener('click', togglePaymentInfo);

            togglePaymentInfo();
        });

        function plusOrder(button, index) {
            const qtyInput = document.getElementById('qty-' + index);
            const priceElement = document.getElementById('price-' + index);
            let qty = parseInt(qtyInput.value, 10);
            const price = parseFloat(priceElement.dataset.price);

            qty++;
            qtyInput.value = qty;
            priceElement.textContent = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(qty * price);
        }

        function minusOrder(button, index) {
            const qtyInput = document.getElementById('qty-' + index);
            const priceElement = document.getElementById('price-' + index);
            let qty = parseInt(qtyInput.value, 10);
            const price = parseFloat(priceElement.dataset.price);

            if (qty > 1) {
                qty--;
                qtyInput.value = qty;
                priceElement.textContent = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(qty * price);
            }
        }
    </script>
</body>

</html>