<?php
session_start();

if (isset($_SESSION['user'])) {
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
<form action="signin.php" method="POST">
    <p>Login: <input type="text" name="login" /></p>
    <p>Password: <input type="password" name="password" /></p>
    <button type="submit">log in</button>
    <p>
        Have an account? - <a href="/second/register.php">sign up</a>!
    </p>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>