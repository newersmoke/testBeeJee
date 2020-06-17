<?php

use System\Validator AS Validator;

class AuthModel {

    private $requireFields = array('login', 'password');
    private $adminData = array('login' => 'admin', 'password' => '123');

    public function auth($data) {
        $validation = new Validator($data, $this->requireFields);
        $isEmpty = $validation->checkOnEmpty();

        if (!empty($isEmpty)) {
            return $isEmpty;
        }

        $checkAdminData = $validation->checkOnEqual($this->adminData, $data);

        if (!empty($checkAdminData)) {
            return $checkAdminData;
        }

        \System\Auth::saveSession($this->adminData);

        return array('success' => 1);
    }

    public function logout() {
        \System\Auth::clearSession();
        header("Location: http://" . $_SERVER['HTTP_HOST']);
        exit();
    }

}
