<?php

class User
{
    public $login, $password, $email, $name;

    public function set($data)
    {
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

}

