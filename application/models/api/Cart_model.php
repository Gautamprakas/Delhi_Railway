<?php

class Cart_model extends MY_Model {

	public $session_id;
	public $data;
	public $inserted_at;
	public $updated_at;

	public $session_data = [];
	public $cart_arr = [
		"products" => [],
		"total_qty" => 0,
		"total" => 0.0
	];

	public function add( $cart ){
		$this->session_id = $cart->session_id;
		$this->load->library("api_session",["session_id"=>$this->session_id]);
		$temp = $cart->qty * $cart->price;
		$this->cart_arr = $this->api_session->getKeyData("cart");
		if( isset($this->cart_arr["products"][$cart->product_id]) ){
			$this->cart_arr["products"][$cart->product_id]["qty"] += $cart->qty; 
			$this->cart_arr["products"][$cart->product_id]["sub_total"] +=  $temp;
			$this->cart_arr["total"] += $temp; 
		}else{
			$this->cart_arr["products"][$cart->product_id]["id"] = $cart->id;
			$this->cart_arr["products"][$cart->product_id]["sku"] = $cart->sku;
			$this->cart_arr["products"][$cart->product_id]["name"] = $cart->name;
			$this->cart_arr["products"][$cart->product_id]["description"] = $cart->description;
			$this->cart_arr["products"][$cart->product_id]["qty"] = $cart->qty;
			$this->cart_arr["products"][$cart->product_id]["aval"] = 1;
			$this->cart_arr["products"][$cart->product_id]["price"] = $cart->price;
			$this->cart_arr["products"][$cart->product_id]["sub_total"] = $temp;
			if(isset($this->cart_arr["total_qty"])){
				$this->cart_arr["total_qty"] += 1;
				$this->cart_arr["total"] += $temp;	
			}else{
				$this->cart_arr["total_qty"] = 1;
				$this->cart_arr["total"] = $temp;
			}
		}
		$this->api_session->addKeyData("cart",$this->cart_arr);
		return $this->get($cart);
	}


	public function get( $cart ){
		$this->session_id = $cart->session_id;
		$this->load->library("api_session",["session_id"=>$this->session_id]);
		$temp_cart_arr = $this->api_session->getKeyData("cart");
		if( $temp_cart_arr ){
			$this->cart_arr = $temp_cart_arr;
		}
		return $this->cart_arr;
	}


	public function delete( $cart ){
		$this->session_id = $cart->session_id;
		$this->load->library("api_session",["session_id"=>$this->session_id]);
		$temp_cart_arr = $this->api_session->getKeyData('cart');
		if( isset($temp_cart_arr["products"][$cart->product_id]) ){
			$temp_cart_arr["total"] -= $temp_cart_arr["products"][$cart->product_id]["sub_total"];
			$temp_cart_arr["total_qty"] -= 1;
			unset($temp_cart_arr["products"][$cart->product_id]);
			$this->cart_arr = $temp_cart_arr;
			$this->api_session->addKeyData('cart',$this->cart_arr);
		}
		return $this->get($cart);
	}

}