<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Пожалуйста, авторизуйтесь для добавления комментария."]);
    exit;
}

if (isset($_POST["photo_id"], $_POST["text"])) {
    $text = trim($_POST["text"]);
    if ($text === "") {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Комментарий не может быть пустым."]);
        exit;
    }

    require "vendor/autoload.php";
    $db = new \Photos\DB();
    $inserted_comment = $db->add_comment($_POST["photo_id"], $_SESSION["user_id"], $text);

    header('Content-Type: application/json');
    echo json_encode($inserted_comment);
}