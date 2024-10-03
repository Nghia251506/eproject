<?php
session_start();
require_once "app/App.php";
require_once "app/config/database.php";
require_once "app/controllers/BaseController.php";
$app = new App($conn);
?>