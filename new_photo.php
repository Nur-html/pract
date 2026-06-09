<?php
session_start();

if (isset($_POST["image"], $_POST["text"])) {
    $image = trim($_POST["image"]);
    $text = trim($_POST["text"]);

    if ($image === "" || $text === "") {
        header("Location: 12.php");
        exit;
    }

    require "vendor/autoload.php";
    $db = new \Photos\DB();
    $user_id = $_SESSION["user_id"];
    
    $db->new_photo($user_id, $image, $text);
    
    // Перенаправление на страницу постов
    header("Location: 12.php");
    exit;
}