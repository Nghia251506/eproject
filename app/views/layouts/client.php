<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doccument</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Donegal+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/base.css">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/product.css">
    <script src="http://localhost/eproject/app/assets/js/eventClient.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="grid wide">
        <?php
        $this->view("layouts/header");
        $this->view($input["page"], ["data" => $input]);
        $this->view("layouts/footer");
        ?>
    </div>
    <script src="https://localhost/eproject/app/assets/js/eventClient.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>