<?php

class Sales_orders_model extends MY_Model {

	public $id;
	public $order_datetime;
	public $total;
	public $coupon_id;
	public $session_id;
	public $user_id;
	public $inserted_at;
	public $updated_at;

	public function add( $total, $session_id, $user_id ){
		$this->order_datetime = mtime();
		$this->total          = $total;
		$this->session_id     = $session_id;
		$this->user_id        = $user_id;
		$this->inserted_at    = mtime();
		unset($this->id);
		unset($this->coupon_id);
		unset($this->updated_at);
		if($this->db->insert("sales_orders",$this)){
			return $this->db->insert_id();
		}
		return false;

	}


	public function history($user_id='',$start=0,$limit=10){
		$this->user_id = $user_id;
		$resource = $this->db->order_by("order_datetime","DESC")
							 ->limit($limit,$start)
							 ->get_where("sales_orders",["user_id"=>$this->user_id]);
		return $resource->result();
	}

}