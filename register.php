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
<form id="regid" style="display:none">
    <label>Name: </label>
    <input type="text" name="name" placeholder="Enter your name"><br>
    <label>Login: </label>
    <input type="text" name="login" placeholder="Enter your login"><br>
    <label>Email: </label>
    <input type="email" name="email" placeholder="Enter your email"><br>
    <label>Password: </label>
    <input type="password" name="password" placeholder="Enter your password"><br>
    <label>Confirm password: </label>
    <input type="password" name="password_confirm" placeholder="Repeat your password"><br>
    <button type="submit" class="register-btn">sigh up</button>
    <p>
        Have an account? - <a href="index.php">log in</a>!
    </p>
    <p class="msg none">Lorem ipsum.</p>
</form>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript">
    document.getElementById( "regid" ).style.display = "block";
</script>
</body>
</html>