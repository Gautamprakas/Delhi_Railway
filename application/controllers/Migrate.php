<?php

class Migrate extends CI_Controller {

    public function create_db(){
        try{
            $this->myforge = $this->load->dbforge($this->load->database("install",TRUE), TRUE);
            if($this->myforge->create_database(DB_NAME)){
                echo sprintf("%s created",DB_NAME);
            }else{
                echo sprintf("%s exist",DB_NAME);
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function index(){
        
        $this->load->library('migration');
        if ( ! $this->migration->current()){
            echo 'Error' . $this->migration->error_string();
        } else {
            echo 'Migrations ran successfully!';
        } 
        
    }    

}