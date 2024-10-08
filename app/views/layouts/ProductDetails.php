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
    <div class="container-fluid">
        <div class="slider-box">
            <div class="swiper-slide">
                <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg" alt="Yellow Summer Travel Bag">
            </div>
        </div>
        <div class="pro-detail">
            <h2>Amadeus</h2>
            <p>ABS LUGGAGE</p>
            <div class="price">
                <h5>$ 199.00</h5>
                <span>30% off</span>
            </div>

            <!-- Nút tăng giảm số lượng -->
            <div class="quantity-box">
                <button id="decrease">-</button>
                <input type="text" id="quantity" value="1">
                <button id="increase">+</button>
            </div>

            <!-- Nút Thêm vào giỏ hàng -->
            <div class="btshop">
                <button>ADD TO CART</button>     
            </div>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const increaseBtn = document.getElementById('increase');
        const decreaseBtn = document.getElementById('decrease');

        // Khi bấm nút +
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });

       
        });
    </script>





</body>
</html>
