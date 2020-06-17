<?php

class Ticket {
    public $countPerPage = 3;
    private $model;
    
    public function getModel(){
        if(empty($this->model)){
            $this->model = new TicketModel();
        }
        
        return $this->model;
    }
    
    
    public function index() {

        include_once './views/ticket.php';
    }

    public function list(){
        $orders = array(
            'order' => !empty($_POST['órder']) ? $_POST['órder'] : 'id',
            'order_by' => !empty($_POST['order_by']) ? $_POST['order_by'] : 'ASC',
            'page' => !empty($_POST['page']) ? $_POST['page'] : 1,
            'per_page' => $this->countPerPage
        );
        
        $data = $this->getModel()->tickets($orders);
        
        $count = $data['count'];
        $defaultCount = $this->countPerPage;
        $tickets = $data['tickets'];
        
        include_once './views/list.php';
    }
    
    public function edit() {
        echo json_encode($this->getModel()->editTicket($_POST));
    }
    
    public function done() {
        echo json_encode($this->getModel()->doneTicket($_POST));
    }

    public function create() {
        echo json_encode($this->getModel()->createTicket($_POST));
    }
}
