<?php


function validate_get_products_by_categories( $Api, $query ){

	if( $query_data = json_decode($query,true) ){
		$Api->load->library('form_validation');
		$Api->form_validation->set_data((array)$query_data);
		$Api->form_validation->set_rules('catids[]', $Api->lang->line('categories-ids'), 'required|integer');
		$Api->form_validation->set_rules('filter[][]', $Api->lang->line('filter-ids'), 'required');
		$Api->form_validation->set_rules('sort', $Api->lang->line('sort-ids'), 'required|integer');
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


function validate_get_product_detail( $Api, $query ){

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

function sorting_helper($sort = 0,$ci){

	$sorting_map = (object)[
		"0" => $ci->lang->line('sort-by-rating'),
		"1" => $ci->lang->line('sort-by-date'),
		"2" => $ci->lang->line('price-high-to-low'),
		"3" => $ci->lang->line('price-low-to-high')
	];
	$ordering = '';

	switch ($sort) {
		case '0':
			$ordering = 'rating DESC,discount_price ASC,inserted_at DESC,updated_at DESC';
			break;

		case '1':
			$ordering = 'inserted_at DESC,rating DESC,discount_price ASC,updated_at DESC';
			break;

		case '2':
			$ordering = 'discount_price DESC,rating DESC,inserted_at DESC,updated_at DESC';
			break;

		case '3':
			$ordering = 'discount_price ASC,rating DESC,inserted_at DESC,updated_at DESC';
			break;
		
		default:
			$ordering = 'rating DESC,discount_price ASC,inserted_at DESC,updated_at DESC';
			break;
	}

	return [
		"ordering"     => $ordering,
		"map"		=> $sorting_map
	];
}