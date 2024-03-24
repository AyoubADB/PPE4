<?php
include ("config.php");
session_start();

if (isset ($_SESSION["user_id"])) {
    header("Location: " . BASE_URL . LOGIN_PAGE);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <H1>Home</H1>
    <a href="">Commande Passé</a>
    <br>
    <a href="stock.php">Stock</a>
    <br>
    <a href=""></a>
    <a href=""></a>
    <a href=""></a>
</body>

</html>