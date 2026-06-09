<?php
 session_start();
     $user_id=$_SESSION["user_id"]??false;
require "vendor/autoload.php";
  $db = new Photos\DB();
  $data = $db->get_all_photos();
?> 
<!doctype html>
<html lang="en">
<head>
<title>Практ 12</title>
<link rel="stylesheet" href="121.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="122.css">
</head>
<body>

<?php include "header.php" ?>

<h1>галерея</h1>
<div id="grid">
    <?php foreach($data as $photo): ?>
<?= (new Photos\Photo($photo["id"], $photo["image"] ?? $photo["Image"], $photo["text"] ?? $photo["Text"]))->get_html() ?><?php endforeach; ?>
</div>


<?php include "add_form.php" ?>

<script src="12.js"></script></body>
</html>
