<?php

class Cc_transactions_model extends MY_Model {

	public $id;
	public $code;
	public $order_id;
	public $trans_datetime;
	public $processor;
	public $processor_trans_id;
	public $amount;
	public $cc_num;
	public $cc_type;
	public $response;
	public $inserted_at;
	public $updated_at;

	public function add_pre_online_transaction( $order=[] ){
		
		$this->db->insert('cc_transactions',[
			"code"        => $order['trans_order_id'],
			"order_id"    => $order['order_id'],
			"amount"      => $order['amount'],
			"cc_type"     => 'online',
			"inserted_at" => mtime()
		]);
		return true;
	}

	public function update_post_online_transaction( $trans_order_id='', $trans_data=[]){
		
		$this->db->where("code",$trans_order_id);
		$this->db->update('cc_transactions',[
			"trans_datetime"     => mtime(),
			"processor_trans_id" => $trans_data["trans_id"],
			"processor"          => $trans_data["signature"],
			"response"           => json_encode($trans_data['response']),
			"updated_at"         => mtime()
		]);
		return true;
	}


	public function add_offline_transaction($order=[]){

		$this->db->insert('cc_transactions',[
			"code"               => $order['order_id'],
			"order_id"           => $order['order_id'],
			"amount"             => $order['amount'],
			"cc_type"            => 'offline',
			"trans_datetime"     => mtime(),
			"inserted_at"        => mtime()
		]);
		return true;
	}


	public function getTransOrderIdByOrderId( $order_id ){
		$resource = $this->db->select("code")->get_where("cc_transactions",["order_id"=>$order_id]);
		if($resource->num_rows()==1){
			return $resource->row()->code;
		}
		return false;
	}

}