<?php

use System\Mysql AS DB;
use System\Auth AS Auth;
use System\Validator AS Validator;

class TicketModel {

    private $requireFields = array('userName', 'userEmail', 'ticket');

    public function tickets($data) {
        $database = new DB();
        
        $offset = ($data['page'] - 1) * $data['per_page'];
       
        $rows = $database->query('
                    select * from tickets
                    ORDER BY ' . $data['order'] . ' ' . $data['order_by'] . '  
                    LIMIT '. $offset . ' , ' . $data['per_page'] )->fetchAll();

        $counter = $database->query('SELECT count(*) as `count` FROM tickets')->fetchArray();
        
        return array('tickets' => $rows , 'count' => $counter['count']);
    }

    public function editTicket($data = array()) {
        $validation = new Validator($data, array('ticket'));
        $isEmpty = $validation->checkOnEmpty();
        
        if (!empty($isEmpty)) {
            return $isEmpty;
        }
        
        if (!Auth::isAuth() || empty($data['id'])){
            return array('error' => 1, 'message' => 'Log in please');
        }
        
        $database = new DB();

        $database->query('
                    UPDATE tickets SET ticket = "' . $data['ticket'] . '", edited = 1 WHERE id = ' . $data['id']
        );
    }
    
    public function doneTicket($data = array()) {
        if (!Auth::isAuth() || empty($data['id'])){
            return array('error' => 1, 'message' => 'Log in please');
        }
        
        $database = new DB();

        $database->query('
                    UPDATE tickets SET status = "done"  WHERE id = ' . $data['id']
        );
    }
    
    public function createTicket($data = array()){
        $validation = new Validator($data, $this->requireFields);
        $isEmpty = $validation->checkOnEmpty();
        
        if (!empty($isEmpty)) {
            return $isEmpty;
        }
        
        $checkEmail = $validation->validateEmail();
        
        if (!empty($checkEmail)){
            return $checkEmail;
        }
        
        $database = new DB();

        $database->query('
                    INSERT INTO tickets SET userName = "' . $data['userName']. '" , userEmail = "'.$data['userEmail'].'", ticket = "' . $data['ticket'] . '"'
                );
        
    }

}
