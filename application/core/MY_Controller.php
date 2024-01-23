<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Api_Controller extends REST_Controller{

	public $language = 'english';
	public $page_start = 0;
	public $page_limit = 20;
	public $token = '123';
	public $user_id = 1;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(['jwt', 'authorization']);
		$data = $this->verify_request();
		$this->user_id = $data->user_id;
	}

	protected function verify_request(){
		
	    $headers = $this->input->request_headers();
	    $this->token = isset($headers['Authorization'])?$headers['Authorization']:'';
	    // JWT library throws exception if the token is not valid
	    try {
	        // Validate the token
	        // Successfull validation will return the decoded user data else returns false
	        $data = AUTHORIZATION::validateTimestamp($this->token);
	        if ($data === false) {
	            $this->response([
					"status" => REST_Controller::HTTP_UNAUTHORIZED,
					"message" => 'failed',
					"error" => 'invalid token',
					"data" => null,
				], REST_Controller::HTTP_UNAUTHORIZED);
	            exit();
	        } else {
	            return $data;
	        }
	    } catch (Exception $e) {
	        // Token is invalid
	        // Send the unathorized access message
	        $this->response([
				"status" => REST_Controller::HTTP_UNAUTHORIZED,
				"message" => 'failed',
				"error" => 'invalid token',
				"data" => null,
			], REST_Controller::HTTP_UNAUTHORIZED);
            exit();
	    }
	}
}