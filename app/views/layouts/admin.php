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
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/admin.css">
</head>

<body>
    <div class="grid wide">
        <?php
        $this->view("layouts/headerAdmin");
        $this->view($input["page"], ["data" => $input]);
        ?>
    </div>
</body>

</html>