<?php
// КРИТИЧЕСКИ ВАЖНО: включаем сессию, чтобы header.php видел, что юзер авторизован
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION["user_id"] ?? false;

$data = [
    [
        "path" => "http://picsum.photos/seed/1/1920/1080",
        "title" => "Мост"
    ],
    [
        "path" => "http://picsum.photos/seed/2/1920/1080",
        "title" => "Комп"
    ],
    [
        "path" => "http://picsum.photos/seed/3/1920/1080",
        "title" => "Водопад"
    ],
    [
        "path" => "http://picsum.photos/seed/4/1920/1080",
        "title" => "Клубника"
    ],
    [
        "path" => "",
        "title" => "Тест"
    ],
    [
        "path" => "http://picsum.photos/seed/5/1920/1080",
        "title" => ""
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="121.css">
    <link rel="stylesheet" href="122.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background: #1d1d1d;
            color: #fff;
            margin: 2rem;
        }
        img {
            max-width: 500px;
            width: 100%;
            height: auto;
            display: block;
            margin: 1rem auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        p {
            text-align: center;
            font-weight: 500;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

    <?php include "header.php"; ?>

    <?php foreach ($data as $str): ?>
        <?php if (!empty($str["path"]) && !empty($str["title"])): ?>
            <img src="<?= $str["path"] ?>" alt="image" />
            <p><?= $str["title"] ?></p>
        <?php endif; ?>
    <?php endforeach; ?>

</body>
</html>