<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Page</title>
    <style>
        /* Đảm bảo container chính chiếm hết chiều cao có sẵn, tránh việc footer chồng lấn */
.container-fluid {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  padding: 20px;
  justify-content: center;
  width: 60%;
  margin: 0 auto;
}

/* Bố cục cho phần chi tiết sản phẩm */
.product-details-wrapper {
  display: flex;
  gap: 20px;
}

.image_product {
  width: 100%;
  height: 500px;
}

.image_product img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.slider-box {
  width: 50%;
}

/* .slider-box img {
  max-width: 80%;
  height: auto;
  border-radius: 5px;
} */

.pro-detail {
  width: 50%;
}

.pro-detail h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.pro-detail p {
  font-size: 18px;
  margin: 5px 0;
}

.price h5 {
  font-size: 22px;
  color: #8f6b29;
}

.quantity-box {
  display: flex;
  width: 50%;
  align-items: center;
  gap: 10px;
}

.quantity-box input {
  width: 50%;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.quantity-box button {
  width: 30px;
  height: 30px;
  border: 1px solid #ccc;
}

.btshop {
  margin-top: 20px;
  width: 100%;
  height: 50px;
  display: flex;
  text-align: center;
  background: #fde08d;
  background: -webkit-linear-gradient(right, #8f6b29, #fde08d, #df9f28);
  background: linear-gradient(right, #8f6b29, #fde08d, #df9f28);
  align-items: center;
  justify-content: center;
}

/* .btshop button {
  background-color: #f2d265;
  border: none;
  padding: 10px 20px;
  color: white;
  cursor: pointer;
  font-size: 16px;
  border-radius: 5px;
} */

.btshop p {
  margin-top: 10px;
  color: #333;
}

/* Bố cục cho phần hình ảnh chi tiết */

.details {
     background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 15px;
  text-align: center;
  width: 100%;
  height: 450px;

}
.content-details {
    width: 75%;
    padding: 20px;
}

.content-details img {
    max-width: 100%;
  height: 100%;
  border-radius: 5px;
  object-fit: cover;    
}



.fly-to-cart {
  position: absolute;
  z-index: 1000;
  transition: transform 1s ease-in-out, opacity 1s ease-in-out;
}

.product-action {
  display: flex;
  width: 100%;
  justify-content: space-between;
}
.add-cart-button {
  width: 100%;
  justify-content: center;
  margin-left: 10px;
}
.add-cart-button button {
  background-color: #dc5c00;
  /* background: #fde08d;
  background: -webkit-linear-gradient(top, #8f6b29, #fde08d, #df9f28);
  background: linear-gradient(top, #8f6b29, #fde08d, #df9f28); */
  border: none;
  padding: 10px 20px;
  color: black;
  cursor: pointer;
  font-size: 16px;
  border-radius: 5px;
  width: 80%;
}


.product-description {
  margin-top: 20px;
}

#toggle-description {
  margin-top: 10px;
  padding: 8px 12px;
  background-color: white; 
  color: rgb(255, 5, 5); /* Màu chữ của nút */
  border: none;
  border-radius: 5px; /* Bo tròn góc */
  cursor: pointer;
  transition: background-color 0.3s;
}

/* ========== Responsive cho Tablet ========== */
@media (max-width: 1024px) {
  .container-fluid {
    width: 80%;
  }
  .add-cart-button {
    margin-left: 0;
  }
  .product-details-wrapper {
    flex-direction: column;
    align-items: center;
  }

  .slider-box,
  .pro-detail {
    width: 100%;
    margin-bottom: 20px;
  }

  .quantity-box {
    width: 100%;
    justify-content: center;
  }

  .product-action {
    flex-direction: column;
    align-items: center;
  }

  .add-cart-button {
    width: 100%;
  }

  .add-cart-button form button{
    width: 100%;
  }

  .details {
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
  }

  .content-details {
    margin-bottom: 20px;
    width: 48%;
  }
}

/* ========== Responsive cho Điện thoại ========== */
@media (max-width: 768px) {
  .container-fluid {
    width: 90%;
    padding: 10px;
  }

  .product-details-wrapper {
    flex-direction: column;
    gap: 15px;
  }

  .slider-box,
  .pro-detail {
    width: 100%;
  }

  .image_product {
    height: 300px;
  }

  .pro-detail h2 {
    font-size: 20px;
  }

  .pro-detail p {
    font-size: 16px;
  }

  .price h5 {
    font-size: 20px;
  }

  .quantity-box {
    width: 100%;
    justify-content: center;
  }

  .product-action {
    flex-direction: column;
    align-items: center;
  }

  .add-cart-button {
    width: 100%;
  }

  .btshop {
    font-size: 14px;
  }

  .details {
    flex-direction: column;
    gap: 10px;
  }

  .content-details {
    width: 100%;
  }
}
    </style>
</head>

<body>
    <?php
    $data = $input["data"];
    $product = $data["product"] ?? "";
    $similarProducts = $data["similarProducts"] ?? "";
    $similarProduct = $data["similarProduct"] ?? "";
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!isset($_SESSION['productList'])) {
            $_SESSION['productList'] = array();
        }
        $_SESSION['productList'][] = $data["product"];
        // print_r($_SESSION['productList']);
        // die();
    }
    ?>
    <?php if ($product): ?>
        <div class="container-fluid">
            <div class="product-details-wrapper">
                <div class="slider-box">
                    <div class="image_product">
                        <img src="<?php echo htmlspecialchars($product->image_url); ?>" alt="<?php echo htmlspecialchars($product->name); ?>">
                    </div>
                </div>
                <div class="pro-detail">
                    <h2 style="margin-top: 30px"><?php echo htmlspecialchars($product->name); ?></h2>
                    <p>Code: <?php echo htmlspecialchars($product->code); ?></p>
                    <p>Type: <?php echo htmlspecialchars($product->type_name); ?></p>
                    <p>Watt: <?php echo htmlspecialchars($product->watt); ?></p>
                    <p>Socket: <?php echo htmlspecialchars($product->socket); ?></p>
                    <p>Color: <?php echo htmlspecialchars($product->color); ?></p>
                    <p>Brand: <?php echo htmlspecialchars($product->brand_name); ?></p>

                    <div class="price">
                        <h5><b><?php echo htmlspecialchars(number_format($product->sale_price, 0, ',', '.')); ?> VND</b></h5>
                    </div>
                    <div class="product-action">
                        <div class="quantity-box">
                            <button id="decrease">-</button>
                            <input type="text" id="quantity" value="1" name="quantityProduct">
                            <button id="increase">+</button>
                        </div>
                        <div class="add-cart-button">
                            <form action="" method="POST">
                                <button type="submit" >Add to Cart</button>
                            </form>
                        </div>
                    </div>

                    <div class="btshop">
                        <p>Hotline: 0523652003</p>
                    </div>
                </div>
            </div>
            <div class="product-description">
                <h3>Mô tả sản phẩm</h3>
                <p id="short-description"><?php echo htmlspecialchars(substr($product->description, 0, 100)); ?>...</p>
                <p id="full-description" style="display: none;"><?php echo htmlspecialchars($product->description); ?></p>
                <button id="toggle-description" onclick="toggleDescription()">Xem thêm</button>
            </div>
            <h2>The same product</h2>
            <div >
            <div class="details" >
                <?php if (!empty($similarProducts)): ?>
                    <?php foreach ($similarProducts as $similarProduct): ?>
                        <div class="content-details" style="width:100%;height:280px;">
                            <img style="width: 100%; height:100%; object-fit:cover;" src="<?php echo htmlspecialchars($similarProduct->image_url); ?>" alt="<?php echo htmlspecialchars($similarProduct->name); ?>">
                            <h4><?php echo htmlspecialchars($similarProduct->name); ?></h4>
                            <p><?php echo htmlspecialchars(number_format($similarProduct->sale_price, 0, ',', '.')); ?> VND</p>
                            <button onclick="location.href='http://localhost/eproject/product/detail?id=<?= $similarProduct->id ?>'">See all details</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có sản phẩm nào cùng loại.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
        <p>Sản phẩm không tồn tại.</p>
    <?php endif; ?>

    <script src="http://localhost/eproject/app/assets/js/ProductDetail.js"></script>
</body>

</html>