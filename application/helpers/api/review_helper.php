<?php


function validate_add( $Api, $query ){

	if( $query_data = json_decode($query,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data((array)$query_data);
		$Api->form_validation->set_rules('product_id', $Api->lang->line('product-id'), 'required|integer');
		$Api->form_validation->set_rules('rating', $Api->lang->line('rating'), 'required|less_than_equal_to[5]');
		$Api->form_validation->set_rules('feedback', $Api->lang->line('feedback'), 'required');
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
			return $query_data;
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



function validate_get_review( $Api, $query ){

	if( $query_data = json_decode($query,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data((array)$query_data);
		$Api->form_validation->set_rules('product_id', $Api->lang->line('product-id'), 'required|integer');
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
			return $query_data;
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