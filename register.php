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
    <label>Name</label>
    <input type="text" name="name" placeholder="Enter your name">
    <label>Login</label>
    <input type="text" name="login" placeholder="Enter your login">
    <label>Почта</label>
    <input type="email" name="email" placeholder="Enter your email">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password">
    <label>Confirm password</label>
    <input type="password" name="password_confirm" placeholder="Repeat your password">
    <button type="submit" class="register-btn">sigh up</button>
    <p>
        Have an account? - <a href="/second/index.php">log in</a>!
    </p>
    <p class="msg none">Lorem ipsum.</p>
</form>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>