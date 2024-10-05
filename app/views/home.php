
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://localhost/eproject/app/assets/css/home.css">
    <title>Document</title>
</head>

<body>
    <div class="home-page">
        <div class="home-container">
            <div class="background-container">
                <img src="https://localhost/eproject/app/assets/data/background.jpg" alt="img">
            </div>
            <div class="featured">
                <h3>NEW PRODUCTS</h3>
            </div>
            <div class="slider-wrapper">
                <button class="prev-btn" onclick="moveLeft('slider1')">❮</button>
                <div class="featured-container" id="slider1">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-16.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-6.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-18.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-5.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-9.jpg">
                </div>
                <button class="next-btn" onclick="moveRight('slider1')">❯</button>
            </div>
            <div class="featured">
                <h3>FEATURED PRODUCTS</h3>
            </div>
            <div class="slider-wrapper">
                <button class="prev-btn" onclick="moveLeft('slider2')">❮</button>
                <div class="featured-container" id="slider2">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-1.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-2.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-4.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-20.jpg">
                    <img src="https://localhost/eproject/app/assets/data/featured-img-13.jpg">
                </div>
                <button class="next-btn" onclick="moveRight('slider2')">❯</button>
            </div>
        </div>
    </div>

</body>

</html>