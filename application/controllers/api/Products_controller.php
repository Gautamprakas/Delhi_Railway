<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_controller extends Api_Controller {

	public $category_ids_arr = [];
	public $product_ids_arr = [];
	public $media_ids_arr = [];
	public $attribute_value_id_attribute_name_id = [];
	public $attribute_values_ids= [];
	public $attributes_ids = [];
	public $attributes_set_ids = [];
	public $attributes_name_ids = [];
	public $products;
	public $page_no;
	public $sort;
	public $filter;
	public $filter_key_count = 0;

	public $product_categories_join = [];
	public $product_media_join = [];
	public $product_id;



	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
	}

	public function get_products_by_categories_get(){

		$query = $this->get("q");
		$this->load->helper('api/product');
		$query_data = validate_get_products_by_categories($this,$query);
		
		$this->category_ids_arr = $query_data["catids"];
		$this->filter           = $query_data["filter"];
		$this->sort             = $query_data["sort"];
		$this->page_no          = $query_data["pg"];
		$this->page_start       = ($this->page_no * $this->page_limit) + $this->page_start;

		foreach($this->filter as $key => $row){
			foreach($row as $value ){
				$this->attribute_value_id_attribute_name_id[$value] = $key;
				$this->attributes_ids[] = $value;
			}
			$this->filter_key_count++;
		}

		$this->load->model('api/product_categories_model','products_categories');
		$this->product_ids_arr = $this->products_categories->get_product_ids_by_category_ids($this->category_ids_arr);

		

		if(count($this->filter)>0){
			$temp = [];
			$this->load->model('api/attributes_values_product_model','attributes_values_product');
			$temp_result = $this->attributes_values_product->get_attributes_values_product($this->product_ids_arr,
																							$this->attributes_ids);
			$this->product_ids_arr = [];  //reinitalize
			foreach( $temp_result as $row){
				if( !isset($temp[$row->product_id]["count"]) ){
					$temp[$row->product_id]["count"] = 0;
				}
				if( !isset($temp[$row->product_id][$this->attribute_value_id_attribute_name_id[$row->attributes_value_id]]) ){
					$temp[$row->product_id][$this->attribute_value_id_attribute_name_id[$row->attributes_value_id]]  = true;
					$temp[$row->product_id]["count"] += 1;
					if($temp[$row->product_id]["count"] == $this->filter_key_count){
						$this->product_ids_arr[] = $row->product_id;
					} 
				}
			}
			unset($temp);
			unset($temp_result);
		}
		

		$this->load->model('api/products_model','products');
		$this->products = $this->products->get_products_by_product_ids($this->product_ids_arr,$this->sort,$this->page_start,$this->page_limit);

		$this->load->model('api/product_media_model','product_media');
		$this->product_media_join = $this->product_media->get_join_and_set_media_id_to_products(
																									$this->product_ids_arr,
																								 	$this->products
																								);/*products pass by reference*/

		$this->load->model('api/media_model','media');
		$this->media->set_media_url_in_media_id_of_product($this->product_media_join,$this->products);

		if( count($this->products) > 0 ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('get_products'),
				"error" => null,
				"data" => $this->products
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line('products_not_found'),
				"error" => null,
				"data" => []
			], REST_Controller::HTTP_NOT_FOUND);
		}
		
	}

	public function get_sorting_get(){
		$this->load->helper('api/product');
		$temp_sorting = sorting_helper(0,$this);
		$this->set_response([
			"status" => REST_Controller::HTTP_OK,
			"message" => $this->lang->line('get_sorting'),
			"error" => null,
			"data" => $temp_sorting["map"]
		], REST_Controller::HTTP_OK);
	}


	public function get_product_detail_get(){

		$query = $this->get("q");
		$this->load->helper('api/product');
		$query_data = validate_get_product_detail($this,$query);
		
		$this->product_id = $query_data["product_id"];
		$this->load->model('api/products_model','products');
		$this->products = $this->products->get_product_complete_details_by_id($this->product_id);


		if($this->products === false){
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line('products_not_found'),
				"error" => null,
				"data" => []
			], REST_Controller::HTTP_NOT_FOUND);
		}else{

			$this->load->model('api/product_media_model','product_media');
			foreach($this->product_media->get_join_by_product_id($this->product_id) as $row){
				$this->media_ids_arr[] = $row->media_id;
			}
			
			$this->products->media = [];
			$this->load->model('api/media_model','media');
			foreach($this->media->get_product_media($this->media_ids_arr) as $row){
				$this->products->media[$row->id]["url"] = base_url($row->url);
				$this->products->media[$row->id]["thumbnail"] =base_url($row->thumbnail);
			}


			$this->products->attributes = [];
			$temp_map = [];
			$this->load->model('api/attributes_values_product_model','attributes_values_product');
			foreach($this->attributes_values_product->get_join_by_product_id($this->product_id) as $row){
				$this->attribute_values_ids[] = $row->attributes_value_id;
			}

			$this->load->model('api/attributes_name_values_model','attributes_name_values');
			foreach($this->attributes_name_values->get_join_by_attribute_values_ids($this->attribute_values_ids) as $row){
				$this->attributes_name_ids[] = $row->attributes_name_id;
				$temp_map[$row->attributes_value_id][] =  $row->attributes_name_id;
				$this->products->attributes[$row->attributes_name_id]["name"] = '';
				$this->products->attributes[$row->attributes_name_id]["value"][$row->attributes_value_id] = '';
			}


			$this->load->model('api/attributes_name_model','attributes_name');
			foreach($this->attributes_name->get_attributes_name_by_attribute_name_ids($this->attributes_name_ids) as $row){
				$this->products->attributes[$row->id]["name"] = $row->name;
			}


			$this->load->model('api/attributes_values_model','attributes_values');
			foreach($this->attributes_values->get_attributes_values_by_attribute_values_ids($this->attribute_values_ids) as $row){
				foreach($temp_map[$row->id] as $temp_attribute_name_id){
					$this->products->attributes[$temp_attribute_name_id]["value"][$row->id] = $row->value;
				}
				
			}


			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line('get_products'),
				"error" => null,
				"data" => $this->products
			], REST_Controller::HTTP_OK);

		}

	}
}