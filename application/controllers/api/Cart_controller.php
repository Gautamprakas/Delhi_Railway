<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends Api_Controller {

	public $product_id;
	public $sku;
	public $name;
	public $price;
	public $qty;
	public $sub_total;
	public $thumbnail;
	public $total;
	public $product;
	public $session_id;

	public $cart_arr = [];
	public $product_media;
	public $media;


	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
		$this->session_id = $this->user_id;
	}




	public function add_post(){
		$query = file_get_contents('php://input');
		$this->load->helper('api/cart');
		$query_data = validate_add($this,$query);
		$this->product_id = $query_data["product_id"];
		$this->qty = $query_data["qty"];
		

		$this->load->model("api/products_model","products");
		$this->product = $this->products->get_product_by_id($this->product_id);
		$this->load->model("api/cart_model","cart");
		$this->cart_arr = $this->cart->get($this);

		$temp_bool = false;
		if( $this->product ){
			if( isset($this->cart_arr["products"][$this->product_id]) ){
				$temp = $this->qty + $this->cart_arr["products"][$this->product_id]['qty'];
				if( $temp > 0 && $this->product->quantity >= $temp  ){
					$temp_bool = true;
				}else{
					$temp_bool = false;
				}
			}else if( $this->qty >0 && $this->product->quantity >= $this->qty ){
				$temp_bool = true;
			}else{
				$temp_bool = false;
			}
		}else{
			$temp_bool = false;
		}

		if( $temp_bool ){
				$this->id    = $this->product->id;
				$this->sku   = $this->product->sku;
				$this->name  = $this->product->name;
				$this->description  = $this->product->description;
				$this->price = empty($this->product->discount_price)?$this->product->regular_price:$this->product->discount_price;
				$this->load->model("api/cart_model","cart");
				$this->cart_arr = $this->cart->add($this); 
				$this->cart_arr["products"] = (object)$this->cart_arr["products"];
				$this->set_response([
					"status" => REST_Controller::HTTP_OK,
					"message" => $this->lang->line("item_added_in_cart"),
					"error" => null,
					"data" => $this->cart_arr
				], REST_Controller::HTTP_OK);
			
		}else{
			$this->cart_arr["products"] = (object)$this->cart_arr["products"];
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line("item_not_found"),
				"error" => null,
				"data" => $this->cart_arr
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}


	public function get_get(){
		$this->load->model("api/cart_model","cart");
		$this->cart_arr = $this->cart->get($this);
		$this->cart_arr["products"] = (object)$this->cart_arr["products"];
		$this->set_response([
			"status" => REST_Controller::HTTP_OK,
			"message" => $this->lang->line("cart_fetched"),
			"error" => null,
			"data" => $this->cart_arr
		], REST_Controller::HTTP_OK);
	}




	public function delete_post(){
		$query = file_get_contents('php://input');
		$this->load->helper('api/cart');
		$query_data = validate_delete($this,$query);
		
		$this->product_id = $query_data["product_id"];

		$this->load->model("api/cart_model","cart");
		$this->cart_arr = $this->cart->delete($this);
		$this->cart_arr["products"] = (object)$this->cart_arr["products"];
		$this->set_response([
				"status" => REST_Controller::HTTP_OK,
				"message" => $this->lang->line("item_deleted_from_cart"),
				"error" => null,
				"data" => $this->cart_arr
			], REST_Controller::HTTP_OK);
	}

}