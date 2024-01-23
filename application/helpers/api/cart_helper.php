<?php


function validate_add( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('product_id', $Api->lang->line('product_id'), 'required');
		$Api->form_validation->set_rules('qty', $Api->lang->line('qty'), 'required|numeric');
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


function validate_delete( $Api, $json ){

	if( $reqData = json_decode($json,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data($reqData);
		$Api->form_validation->set_rules('product_id', $Api->lang->line('product_id'), 'required');
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