<?php

session_start();
require_once 'model.php';
require_once 'validation.php';

$user = new User();
$user->name = $_POST['name'];
$user->login = $_POST['login'];
$user->email = $_POST['email'];
$user->password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

//TODO: validation !!!

$error_fields = [];

if ($user->name == '') {
    $error_fields[] = 'name';
}

if ($user->login == '') {
    $error_fields[] = 'login';
}

if ($user->password == '') {
    $error_fields[] = 'password';
}

if ($user->name == '') {
    $error_fields[] = 'full_name';
}

if ($user->email == '' || !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
  $error_fields[] = 'email';
}

if ($password_confirm == '') {
    $error_fields[] = 'password_confirm';
}
/*
if (isExists($user)){
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "such user already exists",
        "fields" => "name"
    ];

    echo json_encode($response);

    die();
}*/

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


if ($user->password == $password_confirm) {
    $user->password = md5($user->password);

    $json = file_get_contents('data.json');
    $json2 = json_decode($json, true);
    $_SESSION['json2'] = $json2;
    $users = [];
    for ($i = 0; $i < count($json2); $i++) {
        $users[$i] = new User();
        $users[$i] = (object)$json2[$i];
    }
    $_SESSION['users'] = $users;
    $_SESSION['users'][] = $user;
    file_put_contents('data.json', json_encode($_SESSION['users']));

    $_SESSION['message'] = 'Successful';
    $response = [
        "status" => true,
        "message" => "Successful",
    ];
    echo json_encode($response);
    //header('Location: /second/index.php');


} else {
    $_SESSION['message'] = 'Passwords must match';
    $response = [
        "status" => false,
        "message" => "Passwords must match",
    ];
    echo json_encode($response);
    //header('Location: /second/register.php');
}

?>
