<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes_controller extends Api_Controller {

	public $category_ids_arr = [];
	public $product_ids_arr = [];
	public $media_ids_arr = [];
	public $products;
	public $page_no;


	public $product_categories_join = [];
	public $attributes_set_product_join = [];
	public $attributes_set_name_join = [];
	public $attributes_name_values_join = [];
	public $attributes_arr = [];


	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
	}


	public function get_attributes_get(){

		//$this->output->enable_profiler(TRUE);
		
		$query = $this->get("q");
		$this->load->helper('api/attribute_helper');
		$query_data = validate_get_filter($this,$query);
		$this->category_ids_arr = $query_data["catids"];

		$this->load->model('api/product_categories_model','products_categories');
		$this->product_categories_join = $this->products_categories->get_join_by_category_ids($this->category_ids_arr,0,INFINITE);
		$temp_product_ids = array_keys($this->product_categories_join['product_categories']);

		$this->load->model('api/attributes_set_product_model','attributes_set_product');
		$this->attributes_set_product_join = $this->attributes_set_product->get_join_by_product_ids($temp_product_ids,0,INFINITE);
		$temp_attributes_set_ids = array_keys($this->attributes_set_product_join['attributes_set_product']);

		$this->load->model('api/attributes_set_name_model','attributes_set_name');
		$this->attributes_set_name_join = $this->attributes_set_name->get_join_by_attribute_set_ids($temp_attributes_set_ids,0,INFINITE);
		$temp_attributes_name_ids = array_keys($this->attributes_set_name_join['attributes_name_set']);

		$this->load->model('api/attributes_name_model','attributes_name');
		foreach($this->attributes_name->get_attributes_name_by_attribute_name_ids($temp_attributes_name_ids) as $index=>$row){
			if($index==0){
				$temp_attributes_name_ids = array(); // reinitialize
			}
			$temp_attributes_name_ids[] = $row->id;
			$this->attributes_arr[$row->id] = [
				"name" => $row->name,
				"type" => $row->type,
				"values" => new stdClass()
			];
		}

		$this->load->model('api/attributes_name_values_model','attributes_name_values');
		$this->attributes_name_values_join = $this->attributes_name_values->get_join_by_attribute_name_ids($temp_attributes_name_ids,0,INFINITE);
		//$temp_attributes_values_ids = array_keys($this->attributes_name_values_join['attributes_values_name']);
		
		$this->load->model('api/attributes_values_product_model','attributes_values_product_model');
		$temp_attributes_values_ids = $this->attributes_values_product_model->get_attributes_values_ids_by_product_ids($temp_product_ids);

		$this->load->model('api/attributes_values_model','attributes_values');
		foreach($this->attributes_values->get_attributes_values_by_attribute_values_ids($temp_attributes_values_ids) as $row){
			if(isset($this->attributes_name_values_join["attributes_values_name"][$row->id])){ //hidden attribute check
				foreach($this->attributes_name_values_join["attributes_values_name"][$row->id] as $attribute_name_id){
					if(isset($this->attributes_arr[$attribute_name_id])){//hidden attributes
						$this->attributes_arr[$attribute_name_id]["values"]->{$row->id}= $row->value;
					}
					
				}
			}
		}
		if( count($this->attributes_arr) > 0 ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('get_attributes'),
				"error" => null,
				"data" => $this->attributes_arr
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line('attributes_not_found'),
				"error" => null,
				"data" => []
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}




	public function get_location_get(){
		
		$temp_attributes_name_ids = [8];

		$this->attributes_arr[8] = [
				"name" => 'ward',
				"type" => 'string',
				"values" => new stdClass()
		];

		$this->load->model('api/attributes_name_values_model','attributes_name_values');
		$this->attributes_name_values_join = $this->attributes_name_values->get_join_by_attribute_name_ids($temp_attributes_name_ids,0,INFINITE);
		$temp_attributes_values_ids = array_keys($this->attributes_name_values_join['attributes_values_name']);

		$this->load->model('api/attributes_values_model','attributes_values');
		foreach($this->attributes_values->get_attributes_values_by_attribute_values_ids($temp_attributes_values_ids) as $row){
			foreach($this->attributes_name_values_join["attributes_values_name"][$row->id] as $attribute_name_id){
				$this->attributes_arr[$attribute_name_id]["values"]->{$row->id}= $row->value;
			}
		}
		if( count($this->attributes_arr) > 0 ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('get_attributes'),
				"error" => null,
				"data" => $this->attributes_arr
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line('attributes_not_found'),
				"error" => null,
				"data" => []
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}



	public function get_prodtype_get(){
		
		$temp_attributes_name_ids = [9];

		$this->attributes_arr[9] = [
				"name" => 'ProdType',
				"type" => 'string',
				"values" => new stdClass()
		];

		$this->load->model('api/attributes_name_values_model','attributes_name_values');
		$this->attributes_name_values_join = $this->attributes_name_values->get_join_by_attribute_name_ids($temp_attributes_name_ids,0,INFINITE);
		$temp_attributes_values_ids = array_keys($this->attributes_name_values_join['attributes_values_name']);

		$this->load->model('api/attributes_values_model','attributes_values');
		foreach($this->attributes_values->get_attributes_values_by_attribute_values_ids($temp_attributes_values_ids) as $row){
			foreach($this->attributes_name_values_join["attributes_values_name"][$row->id] as $attribute_name_id){
				$this->attributes_arr[$attribute_name_id]["values"]->{$row->id}= $row->value;
			}
		}
		if( count($this->attributes_arr) > 0 ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('get_attributes'),
				"error" => null,
				"data" => $this->attributes_arr
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line('attributes_not_found'),
				"error" => null,
				"data" => []
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}



}