<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Page</title>
    <style>
        .container-fluid {
            display: flex;
            max-width: 1500px;
            height: 400px;
            margin-top: 110px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);  
            align-items:center;   
            padding: auto;
        }
        .slider-box {
            flex: 1;
        }
        .slider-box img {
            width: 54%;
            border-radius: 5px;
            display: block;
            margin: auto;
        }
        .pro-detail {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            gap: 0.5rem;
        }

        .pro-detail h2 {
            margin: 0;
            font-size: 1.8rem;
        }

        .pro-detail p {
            margin: 0;
        }

        .price {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .price h5 {
            font-size: 1.5rem;
            color: #333;
        }

        .price span {
            color: #888;
            text-decoration: line-through;
        }

        .quantity-box {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .quantity-box button {
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
            background-color: #f2d265;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-box input {
            width: 50px;
            text-align: center;
            font-size: 1rem;
        }

        .btshop button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f2d265;
            color: black;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
            justify-content: center;
        }

        .btshop .delete-btn {
            background-color: #ff4c4c;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        $data = $input["data"];
        $product = $data["product"] ?? "";
    ?>
    <?php if ($product): ?>
        <div class="container-fluid">
            <div class="slider-box">
                <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
            </div>
            <div class="pro-detail">
                <h2><?php echo htmlspecialchars($product->name); ?></h2>
                <p><?php echo htmlspecialchars($product->code); ?></p>
                <div class="price">
                    <h5><?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</h5>
                </div>
                <div class="quantity-box">
                    <button id="decrease">-</button>
                    <input type="text" id="quantity" value="1">
                    <button id="increase">+</button>
                </div>
                <div class="btshop">
                    <button>ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Sản phẩm không tồn tại.</p>
    <?php endif; ?>

    <script src="http://localhost/eproject/app/assets/js/ProductDetail.js"></script>
</body>
</html>
