<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doccument</title>
    <link rel="preconnect" href="http://fonts.googleapis.com">
    <link rel="preconnect" href="http://fonts.gstatic.com" crossorigin>
    <link href="http://fonts.googleapis.com/css2?family=Donegal+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/base.css">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/home.css">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/product.css">
    <link href="http://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="grid wide">
        <?php
        $this->view("layouts/header");
        $this->view($input["page"], ["data" => $input]);
        $this->view("layouts/footer");
        ?>
    </div>
    <script src="http://localhost/eproject/app/assets/js/eventClient.js"></script>
</body>

</html>