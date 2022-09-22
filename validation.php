<?php

require_once "model.php";

function isExists(User $user){
    $json = file_get_contents('data.json');
    $json2 = json_decode($json, true);
    $users = [];
    for ($i = 0; $i < count($json2); $i++) {
        $users[$i] = new User();
        $users[$i] = (object)$json2[$i];
    }
    for ($i = 0; $i <  count($json2); $i++) {
        if ($user->login == $users[$i]->login) {
            return 'login';
        }
    }

    for ($i = 0; $i <  count($json2); $i++) {
        if ( $user->email == $users[$i]->email) {
            return 'email';
        }
    }
    return '';
}
