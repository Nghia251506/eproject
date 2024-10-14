<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/home.css">
    <title>Document</title>
</head>
<body>
    <?php
    $data = $input["data"];
    $products = $data["products"] ?? "";
    ?>
    <div class="home-page">
        <div class="home-container">
            <div class="background-container">
                <img src="http://localhost/eproject/app/assets/data/background.jpg" alt="img">
            </div>
            <div class="featured">
                <h3>NEW PRODUCTS</h3>
            </div>
            <div class="slider-wrapper">
                <button class="prev-btn" onclick="moveLeft('slider1')">❮</button>
                <div class="featured-container" id="slider1">
                    <?php foreach ($products as $product) : ?>
                        <img src="<?php echo htmlspecialchars($product->image_url); ?>" class="slider-img">
                    <?php endforeach; ?>
                </div>
                <button class="next-btn" onclick="moveRight('slider1')">❯</button>
            </div>
            <div class="featured">
                <h3>FEATURED PRODUCTS</h3>
            </div>
            <div class="slider-wrapper">
                <button class="prev-btn" onclick="moveLeft('slider2')">❮</button>
                <div class="featured-container" id="slider2">
                    <?php foreach ($products as $product) : ?>
                        <img src="<?php echo htmlspecialchars($product->image_url); ?>" class="slider-img">
                    <?php endforeach; ?>
                </div>
                <button class="next-btn" onclick="moveRight('slider2')">❯</button>
            </div>
        </div>
    </div>

</body>
</html>