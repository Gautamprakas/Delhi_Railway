<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class My_error extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->lang->load("api","english");
    }

    public function route_404_get(){

        $this->set_response([
            "status" => REST_Controller::HTTP_NOT_FOUND,
            "message" => null,
            "error" => $this->lang->line("route_404"),
        ], REST_Controller::HTTP_NOT_FOUND);
    }
}