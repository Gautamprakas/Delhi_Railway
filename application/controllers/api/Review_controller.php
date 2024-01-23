<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_controller extends Api_Controller {

	public $product_id;
	public $rating;
	public $feedback;

	public $reviews = [];

	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
		//$this->user_id = $this->user_id;
	}


	public function add_post(){

		$query = file_get_contents('php://input');
		$this->load->helper('api/review');
		$query_data = validate_add($this,$query);
		
		$this->product_id = $query_data["product_id"];
		$this->rating = $query_data["rating"];
		$this->feedback = $query_data["feedback"];  //user id added by my controller

		
		$this->load->model("api/user_review_product_model","user_review_product");
		$this->db->trans_start();
		$temp = $this->user_review_product->add($this);
		$temp_bool = false;
		$this->load->model("api/products_model","products");
		if($temp["status"] == 201){
			$temp_bool = $this->products->update_product_rating($this->product_id,$this->rating);
		}elseif($temp["status"] == 200){
			$temp_bool = $this->products->update_product_rating($this->product_id,$this->rating,$temp["old_rating"]);
		}
		$this->db->trans_complete();

		if( $temp_bool ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line("review-success"),
				"error" => null,
				"data" => null
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line("product_not_found"),
				"error" => null,
				"data" => null
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}



	public function get_review_get(){

		$query = $this->get('q');
		$this->load->helper('api/review');
		$query_data = validate_get_review($this,$query);
		
		$this->product_id = $query_data["product_id"];
		$this->page_no          = $query_data["pg"];
		$this->page_start       = ($this->page_no * $this->page_limit) + $this->page_start;
		
		$this->load->model("api/user_review_product_model","user_review_product");
		$this->reviews = $this->user_review_product->get_review($this->product_id,$this->page_start,$this->page_limit);

		if( count($this->reviews) > 0 ){
			$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line("review-fetched-success"),
				"error" => null,
				"data" => $this->reviews
			], REST_Controller::HTTP_OK);
		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line("review-not-found"),
				"error" => null,
				"data" => null
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}

}