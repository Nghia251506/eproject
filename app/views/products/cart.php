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
    </style>
</head>

<body class="cart-page">
    <?php
    unset($_SESSION['payment_message']); // Clear the message after displaying
    if (isset($_GET['added']) && $_GET['added'] == 'true') {
        echo "<p style='color: green;'>Sản phẩm đã được thêm vào giỏ hàng!</p>";
    }
    $cartItems = $_SESSION["productList"];
    // print_r($cartItems);
    //die();
    // foreach( $_SESSION["productList"] as $index => $item) {
    //     var_dump($item);
    //     var_dump($_SESSION["quantityList"][$index]);
    //     echo "</br>";
    // }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Here, you would typically process the payment and check if it's successful
        $paymentSuccess = true; // Simulate payment success
        // print_r($_SESSION['payment_message']);
        // die();
        if ($paymentSuccess) {
            $_SESSION['payment_message'] = "Payment was successful! Thank you for your purchase.";
            header("Location: http://localhost/eproject/cart" . $_SERVER['PHP_SELF']);
            // exit();
        } else {
            $_SESSION['payment_message'] = "Payment failed. Please try again.";
        }
    }

    // Check for payment message and display it
    if (isset($_SESSION['payment_message'])) {
        echo "<script type='text/javascript'>alert('" . addslashes($_SESSION['payment_message']) . "');</script>";
        unset($_SESSION['payment_message']); // Clear the message after displaying
    }
    // die();
    // unset($_SESSION['quantityList']);
    // unset($_SESSION['productList']);
    ?>

    <div class="content shoping py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pr-md-3 pr-lg-4">
                    <div class="shoping-order">
                        <p class="title">Delivery information</p>
                        <form id="order-form" action="">
                            <div class="row">
                                <div class="form-group col-12 mb-0 field-orderform-fullname required">
                                    <input type="text" id="orderform-fullname" class="form-control" name="OrderForm[fullname]" autofocus placeholder="FullName" aria-required="true">
                                    <p class="help-block help-block-error"></p>
                                </div>
                                <div class="form-group col-6 mb-0 pr-1 field-orderform-email required">
                                    <input type="text" id="orderform-email" class="form-control" name="OrderForm[email]" autofocus placeholder="Email" aria-required="true">
                                </div>
                                <div class="form-group col-6 mb-0 pl-1 field-orderform-phone required">
                                    <input type="text" id="orderform-phone" class="form-control" name="OrderForm[phone]" autofocus placeholder="Phone" aria-required="true">
                                </div>
                                <div class="form-group col-12 mb-0 pl-1 field-orderform-phone required">
                                    <input type="text" id="orderform-address" class="form-control" name="OrderForm[address]" autofocus placeholder="Address" aria-required="true">
                                </div>
                                <!-- <div class="form-group col-12 mb-0 pl-1 field-orderform-phone required">
                                    <input type="text" id="orderform-phone" class="form-control" name="OrderForm[phone]" autofocus placeholder="Phone" aria-required="true">
                                </div>
                                <div class="form-group col-12 mb-0 pl-1 field-orderform-phone required">
                                    <input type="text" id="orderform-phone" class="form-control" name="OrderForm[phone]" autofocus placeholder="Phone" aria-required="true">
                                </div> -->
                                <div class="form-group col-12 mb-0 pl-1 field-orderform-phone required">
                                    <textarea type="text" id="orderform-messenger" class="form-control" name="OrderForm[messenger]" autofocus placeholder="Messenger" aria-required="true"></textarea>
                                </div>
                                <p class="col-12 title">Payment method</p>
                                <div class="col-12 mb-3"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pr-md-3 pr-lg-4"></div>
            </div>
        </div>
    </div>
</body>

</html>