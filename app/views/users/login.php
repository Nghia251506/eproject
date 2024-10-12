<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/login.css">
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/base.css">
    <title>Document</title>
</head>

<body id="body-login">
    <?php
    $error;
    if (isset($_GET["error"])) {
        $error = "Email or password incorrect";
    }

    ?>
    <div class="container grid wide">
        <div class="login-form">
            <form method="POST" action="">
                <h2>Đăng nhập</h2>
                <input type="username" name="username" placeholder="Vui lòng nhập username"></br>
                <input type="password" name="password" placeholder="Vui lòng nhập password"></br>
                <div>
                    <a href="http://localhost/eproject/user/register">Đăng ký</a>
                </div>
                <span><?php echo isset($error) ? $error : "" ?></span></br>
                <input type="submit" value="submit">
            </form>
        </div>
    </div>
</body>

</html>