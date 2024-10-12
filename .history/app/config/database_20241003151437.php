<?php 
$host = "mysql:host=localhost:3306;dbname=eproject";
$username = "root";
$pass = "Anhem123";
=======
$pass = "";
>>>>>>> 9b32a483191d3a1e7343a8375d906218d3b50eee
>>>>>>> Stashed changes
try {
    $conn = new PDO($host, $username, $pass);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
} catch (PDOException $ex) {
    echo "connection failed: ".$ex->getMessage();
}
?>