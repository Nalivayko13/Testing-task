<?php

class User{
    public $login, $password, $email, $name;

    public function set($data) {
        foreach ($data AS $key => $value) $this->{$key} = $value;
    }

}
/*
$json = file_get_contents('data.json');
$json2 = json_decode($json,true);
$_SESSION['json2']=$json2;
$users =[];
for ($i = 0; $i < count($json2); $i++) {
    $users[$i]=new User();
    $users[$i]=(object)$json2[$i];
}
$_SESSION['users']=$users;
echo '<hr>';
foreach ($_SESSION['users'] as $user) {
    echo 'login: ' . $user->login . '<br>';
    echo 'password: ' . md5($user->password). '<br>';
    echo 'email: ' . $user->email . '<br>';
    echo 'name: ' . $user->name . '<br>';
}
$user1=new User();
$user1->name = "[[[";
$user1->login = "]]]]]";
$user1->email = "]]]]]";
$user1->password = 1345;
$_SESSION['users'][]=$user1;
echo '<hr>';
foreach ($_SESSION['users'] as $user) {
    echo 'login: ' . $user->login . '<br>';
    echo 'password: ' . md5($user->password). '<br>';
    echo 'email: ' . $user->email . '<br>';
    echo 'name: ' . $user->name . '<br>';
}*/
