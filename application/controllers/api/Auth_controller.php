<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//require APPPATH . '/libraries/REST_Controller.php';

class Auth_controller extends REST_Controller{

	public $json;
	public $reqData;
	public $userData;

	function __construct(){
		parent::__construct();
		$this->lang->load('api','english');
	}


	public function login_post(){
		
		$this->json = file_get_contents('php://input');
		$this->load->helper('api/auth');
		$this->reqData = validate_login($this,$this->json);

		$this->load->model('api/user_model','user');
		if( $this->userData = $this->user->login($this->reqData["mobile"],$this->reqData["password"]) ){

			$this->load->library("api_session",["session_id"=>$this->userData->id]);
        	$this->api_session->addKeyData("user",$this->userData);
        	$this->api_session->addKeyData("cart",[]);
        	$this->api_session->addKeyData("login",mtime());
			// Create a token
        	$this->userData->id = AUTHORIZATION::generateToken([
        		"user_id"=>$this->userData->id,
        		"timestamp"=>time()
        	]);
        	

			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('login-success'),
				"error" => null,
				"data" => $this->userData,
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_UNAUTHORIZED,
				"message" => "failed",
				"error" => $this->lang->line('login-failed'),
				"data" => null
			], REST_Controller::HTTP_UNAUTHORIZED);
		}

	}



	public function signup_post(){
		
		$this->json = file_get_contents('php://input');
		$this->load->helper('api/auth');
		$this->reqData = validate_signup($this,$this->json);
		$this->load->model('api/user_model','user');
		if( $this->userData = $this->user->signup($this->reqData) ){

			$this->load->library("api_session",["session_id"=>$this->userData->id]);
        	$this->api_session->addKeyData("user",$this->userData);
        	$this->api_session->addKeyData("cart",[]);
        	$this->api_session->addKeyData("login",mtime());
			// Create a token
        	$this->userData->id = AUTHORIZATION::generateToken([
        		"user_id"=>$this->userData->id,
        		"timestamp"=>time()
        	]);
        	
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('login-success'),
				"error" => null,
				"data" => $this->userData
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_UNAUTHORIZED,
				"message" => null,
				"error" => $this->lang->line('login-failed'),
				"data" => null
			], REST_Controller::HTTP_UNAUTHORIZED);
		}

	}

}