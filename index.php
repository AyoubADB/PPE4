<?php
include_once ("config.php");
session_start();

if (isset ($_SESSION["user_id"])) {
    header("Location: " . BASE_URL . HOME_PAGE);
    exit();
} else {
    header("Location: " . BASE_URL . LOGIN_PAGE);
    exit();
}

?>