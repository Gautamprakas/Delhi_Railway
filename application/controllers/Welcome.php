<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends REST_Controller {

	public function index_get()
	{
		redirect('data_feeding');
		//$this->output->enable_profiler(TRUE);
		//$this->load->library("api_session",["session_id"=>$this->user_id]);

		//$this->api_session->addSingleKeyData("cart4",['1'=>2]);
		//$this->api_session->addSingleKeyData("cart2",['1'=>2]);
		// var_dump($this->api_session->is_exist());
		//var_dump($this->api_session->deleteKeyData("cart"));
		//var_dump($this->api_session->destory());

		#$this->api_session->
		//$this->load->model('api/categories','categories');
		//$res = $this->categories->get_all_categories();
		// echo "<pre>";
		// print_r(json_encode($res));
		//$this->set_response($res, REST_Controller::HTTP_OK);
	}


	public function import_csv_get(){
		echo "<pre>";
		set_time_limit(0);
		$tables = [
			'categories',
			'product_statuses',
			'products',
			'media',
			'product_categories',
			'product_media',
			'attributes_set',
			'attributes_name',
			'attributes_values',
			'attributes_name_values',
			'attributes_set_name',
			'attributes_set_product',
			'attributes_values_product'
		];
		$this->load->database();
		$this->load->library("csvimport");
		foreach($tables as $table){
			$file_path = sprintf('%s/dummy_data/%s.csv',APPPATH,$table);
			$arr = $this->csvimport->get_array($file_path);
			$i=0;
			foreach($arr as $row){
				$insert = [];
				foreach($row as $key=>$value){
					if($value != ''){
						$insert[$key] = $value;
					}
				}
				if(count($insert)>0){
					$this->db->insert($table,$insert);
					$i++;
					//echo sprintf("%s_",$i);
				}
			}
		}
		echo "complete";
		
	}



	// public function import_advanced_csv_get(){

	// 	$file_path = sprintf('%s/dummy_data/%s.csv',APPPATH,$table);
	// 	$this->load->library("csvimport");
	// 	$arr = $this->csvimport->get_array($file_path);
	// 	$this->load->database();
	// 	$header = [
	// 		"categories"
	// 		"sku",
	// 		"name",
	// 		"short_description",
	// 		"description",
	// 		"mrp"
	// 		"selling_price",
	// 		"quantity",
	// 		"media_url",
	// 		"media_thumbnail",
	// 	];
	// 	$this->
	// 	if(count($arr)>0){
	// 		//
	// 	}else{
	// 		//
	// 	}

	// }
}
