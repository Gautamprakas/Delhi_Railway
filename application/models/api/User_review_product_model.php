<?php

class User_review_product_model extends MY_Model {

	public $id;
	public $user_id;
	public $product_id;
	public $rating;
	public $feedback;
	public $inserted_at;
	public $updated_at;

	public function add($user_review_product){
		$this->user_id    = $user_review_product->user_id;
		$this->product_id = $user_review_product->product_id;
		$this->rating     = $user_review_product->rating;
		$this->feedback   = $user_review_product->feedback;
		$this->inserted_at = mtime();
		$this->updated_at  = mtime();
		$resource=$this->db->get_where('user_review_product',["user_id"=>$this->user_id,"product_id"=>$this->product_id]);
		if( $resource->num_rows() > 0 ){
			$temp_old_rating = $resource->row()->rating;
			$this->db->where(["user_id"=>$this->user_id,
							  "product_id"=>$this->product_id])
					 ->update('user_review_product',["rating"=>$this->rating,
					 								 "feedback"=>$this->feedback,
					 								 "updated_at"=>$this->updated_at]);
			return ["status"=>200,"old_rating"=>$temp_old_rating];
		}else{
			unset($this->id);
			unset($this->updated_at);
			$this->db->insert("user_review_product",$this);
			return ["status"=>201];
		}
	}


	public function get_review( $product_id, $start=0, $limit=10 ){
		$this->product_id = $product_id;
		$resource = $this->db->select("product_id,rating,feedback")
							 ->order_by("inserted_at DESC,updated_at DESC")
							 ->where("product_id",$product_id)
							 ->limit($limit,$start)
							 ->get("user_review_product");
		return $resource->result();
	}


}