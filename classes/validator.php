<?php

namespace System;

class Validator {

    private $data = array();
    private $requireFields = array();
    private $exeptionMessages = array(
        'empty_field' => 'Empty %s',
        'invalid_email' => 'Email not valid',
        'not_equal' => 'Data not equal',
        'undefMethof' => 'Undefined Method'
    );

    public function __construct($data = array(), $requireFields = array()) {
        $this->data = $data;
        $this->requireFields = $requireFields;
    }

    public function checkOnEmpty() {
        foreach ($this->requireFields as $field) {
            if (empty($this->data[$field])) {
                return $this->exeption(str_replace('%s', $field, $this->exeptionMessages['empty_field']));
            }
        }
    }

    public function validateEmail() {
        if (!filter_var($this->data['userEmail'], FILTER_VALIDATE_EMAIL)) {
            return $this->exeption($this->exeptionMessages['invalid_email']);
        }
    }
    
    public function checkOnEqual($sended = array(), $default = array()){
        $isEqual = array_diff($sended, $default);
        return empty($isEqual) ? null : $this->exeption($this->exeptionMessages['not_equal']);
    } 

    protected function exeption($message = '') {
        return array('error' => 1, 'message' => $message);
    }

}
