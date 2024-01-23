<?php

function validate_now( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('online', $Api->lang->line('online'), 'required');
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


function validate_history( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('pg', $Api->lang->line('page-number'), 'required|integer');
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


function validate_trans_verify( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('order_id', $Api->lang->line('order_id'), 'required');
		$Api->form_validation->set_rules('payment_id', $Api->lang->line('payment_id'), 'required');
		$Api->form_validation->set_rules('signature', $Api->lang->line('signature'), 'required');
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