<?php 
session_start();
$user_id = $_SESSION["user_id"] ?? false;

// Безопасно получаем id из GET-запроса, если он передан для просмотра чужого профиля
$profile_id = intval($_GET["id"] ?? $user_id);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/DB.php'; 

$db = new \Photos\DB();

// Получаем фотографии пользователя для галереи
$user_photos = $db->get_user_photos($profile_id);

// Проверяем сообщения об ошибках/успехе из адресной строки
$error = isset($_GET["error"]) ? "неверный логин или пароль!" : "";
$sign_error = isset($_GET["sign_error"]) ? "логин занят!" : "";
$sign_success = isset($_GET["sign_success"]) ? "успешно вошли!" : "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="121.css">
    <link rel="stylesheet" href="122.css">
</head>
<body>
    <?php include "header.php"; ?>

    <?php if ($user_id): ?>
        <h1>Галерея пользователя</h1>
        <div id="grid">
            <?php foreach($user_photos as $photo): ?>
<?= (new Photos\Photo($photo["id"], $photo["image"] ?? $photo["Image"], $photo["text"] ?? $photo["Text"]))->get_html() ?>            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="form">
            <form action="login.php" method="post">
                <h2>Авторизация</h2>
                <input type="text" placeholder="логин" name="login" required>
                <input type="password" placeholder="пароль" name="password" required>
                <button>вход</button>
                <?php if (!empty($error)): ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>
            </form>

            <form action="signup.php" method="post">
                <h2>Регистрация</h2>
                <input type="text" placeholder="логин" name="login" required>
                <input type="password" placeholder="пароль" name="password" required>
                <button>зарегаться</button>
                <?php if (!empty($sign_error)): ?>
                    <p class="error"><?= $sign_error ?></p>
                <?php endif; ?>
                <?php if (!empty($sign_success)): ?>
                    <p class="success"><?= $sign_success ?></p>
                <?php endif; ?>
            </form>
        </div>
    <?php endif; ?>

    <?php include "add_form.php"; ?>

    <script src="12.js"></script>
</body>  
</html>