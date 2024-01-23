<?php


function validate_get_filter( $Api, $query ){

	if( $query_data = json_decode($query,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data((array)$query_data);
		$Api->form_validation->set_rules('catids[]', $Api->lang->line('categories-ids'), 'required|integer');
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