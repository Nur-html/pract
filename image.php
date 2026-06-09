<?php
session_start();
$user_id = $_SESSION["user_id"] ?? false;
$photo_id = intval($_GET["id"] ?? 0);

require_once __DIR__ . '/vendor/autoload.php';

$db = new Photos\DB();
$photo = $db->get_photo_by_id($photo_id);

if (!$photo) {
    die("Ошибка: Фотография не найдена!");
}

$comments = $db->get_photo_comments($photo_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo</title>
    <link rel="stylesheet" href="121.css">
    <link rel="stylesheet" href="122.css">
</head>
<body>
    <?php include("header.php"); ?>
    
    <div id="image">
       <img src="<?php echo $photo['image'] ?? $photo['Image'] ?? ''; ?>" alt="photo">
        
        <h1><?php echo $photo['Text'] ?? $photo['text'] ?? 'Без названия'; ?></h1>
        <p>Автор: <?php echo $photo['Name']; ?></p>

        <div class="comments">
            <?php if ($user_id): ?>
                <div class="form">
                    <textarea id="text" rows="5" placeholder="Напишите комментарий..."></textarea>
                    <button id="add_comment">Отправить</button>
                </div>
            <?php endif; ?>

            <h2>Комментарии:</h2>
            
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p class="author"><?= $comment["name"] ?></p>
                    <p class="text"><?= $comment["Text"] ?></p>
                    <p class="date"><?= $comment["Post_date"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="image.js"></script>
</body>
</html>