<?php

class Attributes_set_product_model extends MY_Model {

	public $product_id;
	public $attributes_set_id;
	public $inserted_at;
	public $updated_id;

	public $product_ids = [];
	public $product_attributes_set = [];
	public $attributes_set_product = [];

	public function get_join_by_product_ids( $product_ids, $start = 0, $limit = 10 ){
		$this->product_ids = $product_ids;
		if( count($this->product_ids) > 0 ){
			$attributes_set_product_resource = $this->db->select("product_id,attributes_set_id")
													->where_in("product_id",$this->product_ids)
													->limit($limit,$start)
													->get("attributes_set_product");
			foreach($attributes_set_product_resource->result() as $row){
				$this->product_attributes_set[$row->product_id][] = $row->attributes_set_id;
				$this->attributes_set_product[$row->attributes_set_id][] = $row->product_id; 
			}
		}
		return [
			"attributes_set_product" => $this->attributes_set_product,
			"product_attributes_set" => $this->product_attributes_set
		];
	}

	public function get_join_by_product_id($product_id = ''){
		return $this->db->get_where("attributes_set_product",["product_id"=>$product_id]);
	}

}