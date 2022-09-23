<?php

session_start();
setcookie("name", "cookie", time() + 500);
require_once 'model.php';

if(
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
){
    $user = new User();
    $user->login = $_POST['login'];
    $user->password = $_POST['password'];
}else{die();}

$checked = false;


$error_fields = [];

if ($user->login === '') {
    $error_fields[] = 'login';
}

if ($user->password === '') {
    $error_fields[] = 'password';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Incorrect fields",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}

$user->password = md5($user->password);

$db = new Json();
$_SESSION['users'] = $db->GetUsers();

for ($i = 0; $i < count($_SESSION['users']); $i++) {
    if ($user->login == $_SESSION['users'][$i]->login && $user->password == $_SESSION['users'][$i]->password) {
        $user->email = $_SESSION['users'][$i]->email;
        $user->name = $_SESSION['users'][$i]->name;
        global $checked;
        $checked = true;

    }
}
if ($checked) {
    $_SESSION['user'] = [
        "login" => $user->login,
        "password" => $user->password,
        "email" => $user->email,
        "name" => $user->name
    ];
    $response = [
        "status" => true
    ];

    echo json_encode($response);
} else {
    $_SESSION['message'] = 'Incorrect login or password';
    $response = [
        "status" => false,
        "message" => 'Incorrect login or password'
    ];

    echo json_encode($response);
}
?>


