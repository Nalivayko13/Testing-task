<?php

    session_start();
    require_once 'model.php';

    $user = new User();
    $user->login = $_POST['login'];
    $user->password =md5( $_POST['password']);
    $checked=false;


$json = file_get_contents('data.json');
$json2 = json_decode($json,true);
$_SESSION['json2']=$json2;
$users =[];
for ($i = 0; $i < count($json2); $i++) {
    $users[$i]=new User();
    $users[$i]=(object)$json2[$i];
}
$_SESSION['users']=$users;


    for ($i = 0; $i < count($_SESSION['users']); $i++) {
        if ($user->login == $_SESSION['users'][$i]->login && $user->password == $_SESSION['users'][$i]->password){
            $user->email=$_SESSION['users'][$i]->email;
            $user->name=$_SESSION['users'][$i]->name;
            global $checked;
            $checked=true;

        }
    }
    if ($checked){
        $_SESSION['user'] = [
            "login" => $user->login,
            "password" => $user->password,
            "email" => $user->email,
            "name" => $user->name
        ];
        header("Location: /second/profile.php");
    }else {
        $_SESSION['message'] = 'Incorrect login or password';
        header('Location: /second/index.php');
    }
    ?>

<pre>
    <?php

    ?>
</pre>

