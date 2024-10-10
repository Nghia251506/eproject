<?php
session_start();
require_once "app/App.php";
require_once "app/config/database.php";
require_once "app/controllers/BaseController.php";
require_once "app/midleware/AuthMidleware.php";
$midleware = new AuthMidleware([""]);
$app = new App($conn, $midleware);
?>