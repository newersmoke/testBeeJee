<?php

namespace System;

class Auth {
    public static function isAuth(){
        return !empty($_SESSION['login']) && !empty($_SESSION['password']);
    }
    
    public static function saveSession($data){
        $_SESSION['login'] = $data['login'];
        $_SESSION['password'] = $data['password'];
    }
    
    public static function clearSession(){
        unset($_SESSION['login']);
        unset($_SESSION['password']);
    }
}

