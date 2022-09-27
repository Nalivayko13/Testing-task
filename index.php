<?php
session_start();
if (isset($_SESSION['user']) && isset($_COOKIE['name'])) {
    header('Location: profile.php');
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
    <p>Login: <input type="text" name="login"/></p>
    <p>Password: <input type="password" name="password" /></p>
    <button type="submit" class="login-btn">log in</button>
    <p>
        Have an account? - <a href="register.php">sign up</a>
    </p>
    <p class="msg none">Lorem ipsum dolor sit amet.</p>
</form>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>