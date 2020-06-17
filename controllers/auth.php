<?php

class Auth {
    private $model;
    
    public function getModel(){
        if(empty($this->model)){
            $this->model = new AuthModel();
        }
        
        return $this->model;
    }
    
    public function signin() {
        echo json_encode($this->getModel()->auth($_POST));
    }
    
    public function logout(){
        $this->getModel()->logout();
        
    }

}
