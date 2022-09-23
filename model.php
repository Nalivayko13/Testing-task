<?php

class User
{
    public $login, $password, $email, $name;

    public function Set($data)
    {
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

}

class Json
{
    private $jsonFile = 'data.json';

    public function GetUsers(){
        if(file_exists($this->jsonFile)){
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);
            $users = [];
            for ($i = 0; $i < count($data); $i++) {
                $users[$i] = new User();
                $users[$i] = (object)$data[$i];
            }
            return !empty($users)?$users:false;
        }
        return false;
    }

    public function GetUser(User $user){
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);
        $singleData = array_filter($data, function ($var) use ($user) {
            return (!empty($var['email']) && $var['email'] == $user->email);
        });
        $singleData = array_values($singleData)[0];
        return !empty($singleData)?$singleData:false;
    }

    public function CheckUnique(User $user){
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);
        $users = [];
        for ($i = 0; $i < count($data); $i++) {
            $users[$i] = new User();
            $users[$i] = (object)$data[$i];
        }
        for ($i = 0; $i <  count($data); $i++) {
            if ($user->login == $users[$i]->login) {
                return 'login';
            }
        }

        for ($i = 0; $i <  count($data); $i++) {
            if ( $user->email == $users[$i]->email) {
                return 'email';
            }
        }
        return '';
    }

    public function InsertUser(User $newUser){

            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            $users = [];
            for ($i = 0; $i < count($data); $i++) {
                $users[$i] = new User();
                $users[$i] = (object)$data[$i];
            }
            $users[]=$newUser;
            file_put_contents($this->jsonFile, json_encode($users));



    }

    public function Update($upData, $email){
        if(!empty($upData) && is_array($upData) && !empty($id)){
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            foreach ($data as $key => $value) {
                if ($value['email'] == $email) {
                    if(isset($upData['name'])){
                        $data[$key]['name'] = $upData['name'];
                    }
                    if(isset($upData['login'])){
                        $data[$key]['login'] = $upData['login'];
                    }
                    if(isset($upData['password'])){
                        $data[$key]['password'] = $upData['password'];
                    }
                }
            }
            $update = file_put_contents($this->jsonFile, json_encode($data));

            return $update?true:false;
        }else{
            return false;
        }
    }

    public function Delete(User $user){
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);

        $newData = array_filter($data, function ($var) use ($user) {
            return ($var['email'] != $user->email);
        });
        $delete = file_put_contents($this->jsonFile, json_encode($newData));
        return $delete?true:false;
    }
}

