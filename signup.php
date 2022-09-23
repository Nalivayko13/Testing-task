<?php

session_start();
require_once 'model.php';
require_once 'validation.php';

if(
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
){
    $user = new User();
    $user->name = $_POST['name'];
    $user->login = $_POST['login'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
}else {die();}



//TODO: validation !!!

$error_fields = [];
$db=new Json();

if (strlen($user->password) <= 5 || $user->password == '' || preg_match("|\s|", $user->password)
    || !preg_match("#[0-9]+#",$user->password) || !preg_match("#[A-z]+#",$user->password)
    || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user->password) ) {
    $error_fields[] = 'password';
}

if (strlen($user->name) <= 1 || $user->name == '' || preg_match("|\s|", $user->name)
    || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user->name) || preg_match("#[0-9]+#",$user->name)) {
    $error_fields[] = 'name';
}

if (strlen($user->login) <= 5 || $user->login == '' || preg_match("|\s|", $user->login)
    || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user->login)) {
    $error_fields[] = 'login';
}

if ($user->email == '' || !filter_var($user->email, FILTER_VALIDATE_EMAIL) || preg_match("|\s|", $user->email
    || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user->email))) {
  $error_fields[] = 'email';
}

if (strlen($password_confirm)<=5 || $password_confirm == '' || preg_match("|\s|", $password_confirm)) {
    $error_fields[] = 'password_confirm';
}


if ($db->CheckUnique($user)=='login'){
    $error_fields[] = 'login';
}

if ($db->CheckUnique($user)=='email'){
    $error_fields[] = 'email';
}

if (!empty($error_fields) || isExists($user)!='') {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Incorrect fields! Password and Login contains at least 6 characters, Name at least 2",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}


if ($user->password == $password_confirm) {
    $user->password = md5($user->password . "MyUniqueSalt");

    $db->InsertUser($user);

    $_SESSION['message'] = 'Successful';
    $response = [
        "status" => true,
        "message" => "Successful",
    ];
    echo json_encode($response);


} else {
    $_SESSION['message'] = 'Passwords must match';
    $response = [
        "status" => false,
        "message" => "Passwords must match",
    ];
    echo json_encode($response);
}

?>
