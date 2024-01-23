<?php


function validate_login( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('mobile', $Api->lang->line('mobile'), 'required');
		/*regex_match[/^[0-9]{10}$/]*/
		$Api->form_validation->set_rules('password', $Api->lang->line('password'), 'required|min_length[6]');
		if( $Api->form_validation->run() == FALSE ){
			$Api->set_response([
				"status" => REST_Controller::HTTP_BAD_REQUEST,
				"message" => null,
				"error" => validation_errors(),
				"data" => null,
			], REST_Controller::HTTP_BAD_REQUEST);
			$Api->output->_display();
    		exit;
		}else{
			return $reqData;
		}

	}else{
		$Api->set_response([
			"status" => REST_Controller::HTTP_BAD_REQUEST,
			"message" => null,
			"error" => $Api->lang->line('invalid-json'),
			"data" => null,
		], REST_Controller::HTTP_BAD_REQUEST);
		$Api->output->_display();
    	exit;
	}
	
}



function validate_signup( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->load->database('default');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('name', $Api->lang->line('name'), 'required');
		$Api->form_validation->set_rules('mobile', $Api->lang->line('mobile'), 'required|regex_match[/^[0-9]{10}$/]|is_unique[users.mobile]');
		$Api->form_validation->set_rules('email', $Api->lang->line('email'), 'valid_email|is_unique[users.email]');
		$Api->form_validation->set_rules('address', $Api->lang->line('address'), 'required|min_length[3]');
		$Api->form_validation->set_rules('password', $Api->lang->line('password'), 'required|min_length[6]');
		if( $Api->form_validation->run() == FALSE ){
			$Api->set_response([
				"status" => REST_Controller::HTTP_BAD_REQUEST,
				"message" => null,
				"error" => validation_errors(),
				"data" => null,
			], REST_Controller::HTTP_BAD_REQUEST);
			$Api->output->_display();
    		exit;
		}else{
			return $reqData;
		}

	}else{
		$Api->set_response([
			"status" => REST_Controller::HTTP_BAD_REQUEST,
			"message" => null,
			"error" => $Api->lang->line('invalid-json'),
			"data" => null,
		], REST_Controller::HTTP_BAD_REQUEST);
		$Api->output->_display();
    	exit;
	}
	
}