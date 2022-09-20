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
    <title>Testing</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>


<form action="signup.php" method="post" enctype="multipart/form-data">
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
    <button type="submit">Submit</button>
    <p>
        Have an account? - <a href="/second/index.php">log in</a>!
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