<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_COOKIE['name'])) {
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Task</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<form>
    <label></label>
    <h2 style="margin: 8px 0;"> Hello, <?= $_SESSION['user']['name'] ?> !</h2><br>
    <a href="#"><?= $_SESSION['user']['email'] ?></a>
    <a href="logout.php" class="logout">log out</a>
</form>

</body>
</html>