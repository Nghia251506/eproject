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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        a:hover {
            color: orange;
        }
    </style>

</head>

<body>
    <div class="grid wide">

        <?php
        $this->view("layouts/header");
        $this->view($input["page"], ["data" => $input]);
        $this->view("layouts/footer");
        ?>

    </div>
    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm JavaScript của Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 4, // Hiển thị 4 item
                margin: 10,
                nav: true,
                loop: false,
                responsive: {
                    0: {
                        items: 1 // Hiển thị 1 item trên màn hình nhỏ
                    },
                    600: {
                        items: 2 // Hiển thị 2 item trên màn hình trung bình
                    },
                    1000: {
                        items: 4 // Hiển thị 4 item trên màn hình lớn
                    }
                }
            });
        });
    </script>
</body>

</html>