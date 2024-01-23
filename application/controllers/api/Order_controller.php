<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_controller extends Api_Controller {

	public $session_id;
	public $cart_arr = [];
	public $oreder_id;
	public $sales_order;
	public $order_products = [];
	public $session_data;

	public $order_ids_arr = [];
	public $order_list = [];
	public $online;
	public $payment_id;
	public $signature;
	public $code;

	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
		$this->session_id = $this->user_id;
	}

	public function now_post(){
		
		$query = file_get_contents('php://input');
		$this->load->helper('api/order');
		$query_data = validate_now($this,$query);
		$this->online = $query_data["online"];

		$this->load->model("api/cart_model","cart");
		$this->db->trans_start();
		$this->cart_arr = $this->cart->get($this);

		if( $this->cart_arr["total_qty"] == 0){

			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line("cart-empty"),
				"error" => null,
				"data" => $this->cart_arr
			], REST_Controller::HTTP_NOT_FOUND);

		}else{

			$this->load->model('api/products_model','products');
			$temp_products = $this->products->get_products_by_ids(array_keys($this->cart_arr['products']));
			$temp_out_off_stock = FALSE;
			$temp_price_changed = FALSE;
			$temp_total = 0;
			foreach($this->cart_arr["products"] as $product_id => $product_details){

				if( isset($temp_products[$product_id]) ){
					$temp_price = empty($temp_products[$product_id]->discount_price)?
									$temp_products[$product_id]->regular_price:
									$temp_products[$product_id]->discount_price;

					$temp_sub_total = $temp_price * $this->cart_arr["products"][$product_id]['qty'];

					$this->cart_arr["products"][$product_id]['sku'] = $temp_products[$product_id]->sku;
					$this->cart_arr["products"][$product_id]['name'] = $temp_products[$product_id]->name;
					$this->cart_arr["products"][$product_id]['description'] = $temp_products[$product_id]->description;
					$this->cart_arr["products"][$product_id]['sub_total'] = $temp_sub_total;

					if( $this->cart_arr["products"][$product_id]['price'] != $temp_price  ){
						$temp_price_changed = TRUE;
						$this->cart_arr["products"][$product_id]['price'] = $temp_price;
					}

					if( $temp_products[$product_id]->quantity >= $product_details["qty"] ){
						$this->cart_arr["products"][$product_id]['aval'] = 1;
					}else{
						$this->cart_arr["products"][$product_id]['aval'] = 0;
						$temp_out_off_stock=TRUE;
					}
				}else{
					$this->cart_arr["products"][$product_id]['aval'] = 0;
					$temp_out_off_stock=TRUE;
				}
				$temp_total += $this->cart_arr["products"][$product_id]['sub_total'];
			}
			$this->cart_arr["total"] = $temp_total;

			$this->load->library('api_session',["session_id"=>$this->session_id]);
			$this->api_session->addKeyData("cart",$this->cart_arr);


			if( !$temp_out_off_stock && !$temp_price_changed ){

				$this->load->model('api/session_model','session_model');
				$temp_session_id = $this->session_model->add($this->api_session->getAllSessionJson(),$this->user_id);

				$this->load->model('api/sales_orders_model','sales_orders_model');
				$this->order_id = $this->sales_orders_model->add($this->cart_arr["total"],$temp_session_id,$this->user_id);

				$this->load->model('api/order_products_model','order_products_model');
				$this->order_products_model->add($this->cart_arr["products"],$this->order_id,$this->products,$temp_products);
				
				$this->api_session->deleteKeyData('cart');




				/*Online Transaction*/
				$this->load->model("api/cc_transactions_model","cc_transactions");
				$temp_online_trans_data = [];

				if( $this->online == 1 ){

					$this->load->helper("api/razorpay");
					$temp_online_order = makeOrder($this->cart_arr["total"],$this->order_id);
					$temp_online_trans_data = [
					    "key"        => RAZORPAY_KEY,
					    "amount"     => $temp_online_order["amount"],
					    "name"       => "VDAI",
					    "description"=> "VDAI BIOSEC PVT LTD",
					    "image"      => base_url('assets/vdai.jpg'),
					    "prefill"    => [
									    	"name"    => "Daft Punk",
									    	"email"   => "customer@merchant.com",
									    	"contact" => "9999999999"
									    ],
					    "order_id"   => $temp_online_order["id"],
					];
					$this->cc_transactions->add_pre_online_transaction([
						"trans_order_id" => $temp_online_order["id"],
						"order_id"       => $this->order_id,
						"amount"         => $this->cart_arr["total"]
					]);

				}else{
					$this->cc_transactions->add_offline_transaction([
						"order_id" => $this->order_id,
						"amount"   => $this->cart_arr["total"]
 					]);
				}
				
				/*Online Transaction*/

				$this->set_response([
					"status" => REST_Controller::HTTP_OK,
					"message" => $this->lang->line("order-success"),
					"error" => null,
					"data" => ["order_id"=>$this->order_id,"online"=>$this->online,"detail"=>$temp_online_trans_data]
				], REST_Controller::HTTP_OK);

			}else{
				$this->set_response([
					"status" => REST_Controller::HTTP_CONFLICT,
					"message" => $this->lang->line("info-changed-in-cart"),
					"error" => null,
					"data" => $this->cart_arr
				], REST_Controller::HTTP_CONFLICT);
			}
	
		}

		$this->db->trans_complete();

	}


	public function history_get(){

		$query = $this->get("q");
		$this->load->helper('api/order');
		$query_data = validate_history($this,$query);

		$this->page_no          = $query_data["pg"];
		$this->page_start       = ($this->page_no * $this->page_limit) + $this->page_start;

		$this->load->model('api/sales_orders_model','sales_orders_model');
		foreach( $this->sales_orders_model->history($this->user_id,$this->page_start,$this->page_limit) as $row ){
			$this->order_ids_arr[] = $row->id;
			$this->order_list[$row->id]["datetime"] = $row->order_datetime;
			$this->order_list[$row->id]["status"] = "pending";
			$this->order_list[$row->id]["total"] = $row->total;
			$this->order_list[$row->id]["products"] = [];
		}

		$this->load->model('api/order_products_model','order_products_model');
		foreach( $this->order_products_model->products($this->order_ids_arr) as $row ){
			$this->order_list[$row->order_id]["products"][] = $row;
		}

		$this->set_response([
			"status" => REST_Controller::HTTP_OK,
			"message" => $this->lang->line("order-list"),
			"error" => null,
			"data" => $this->order_list
		], REST_Controller::HTTP_OK);

	}



	public function trans_verify_post(){

		$query = file_get_contents('php://input');
		$this->load->helper('api/order');
		$query_data = validate_trans_verify($this,$query);
		$this->order_id = $query_data["order_id"];
		$this->payment_id = $query_data["payment_id"];
		$this->signature = $query_data["signature"];

		$this->load->model('api/cc_transactions_model','cc_transactions');
		if( $this->code = $this->cc_transactions->getTransOrderIdByOrderId($this->order_id) ){
			
			$this->load->helper("api/razorpay");
			$temp = verifyOrder( $this->code, $this->payment_id, $this->signature );
			if( $temp['success'] ){
				$this->cc_transactions->update_post_online_transaction($this->code,[
					"trans_id" => $this->payment_id,
					"response" => $temp,
					"signature" => $this->signature
				]);
				$this->set_response([
					"status" => REST_Controller::HTTP_OK,
					"message" =>  $this->lang->line("trans_verify-success"),
					"error" => null,
					"data" => null
				], REST_Controller::HTTP_OK);
			}else{
				$this->set_response([
					"status" => REST_Controller::HTTP_BAD_REQUEST,
					"message" => $this->lang->line("trans_verify-failed"),
					"error" => $temp['error'],
					"data" => null
				], REST_Controller::HTTP_BAD_REQUEST);
			}

		}else{
			$this->set_response([
				"status" => REST_Controller::HTTP_NOT_FOUND,
				"message" => $this->lang->line("order-id-not-found"),
				"error" => null,
				"data" => null
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}




}