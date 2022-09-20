<?php

session_start();
require_once 'model.php';

$user=new User();
$user->name = $_POST['name'];
$user->login = $_POST['login'];
$user->email = $_POST['email'];
$user->password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($user->password == $password_confirm) {
    $user->password = md5($user->password);

    //запиcь в бд нового юзера
    $json = file_get_contents('data.json');
    $json2 = json_decode($json,true);
    $_SESSION['json2']=$json2;
    $users =[];
    for ($i = 0; $i < count($json2); $i++) {
        $users[$i]=new User();
        $users[$i]=(object)$json2[$i];
    }
    $_SESSION['users']=$users;
    $_SESSION['users'][]=$user;
    file_put_contents('data.json',json_encode($_SESSION['users']));

    $_SESSION['message'] = 'Successful!';
    header('Location: /second/index.php');


} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: /second/register.php');
}

?>
