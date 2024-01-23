<?php

class Attributes_values_product_model extends MY_Model {

	public $attributes_value_id;
	public $product_id;
	public $inserted_at;
	public $updated_id;

	public $attributes_values_ids = [];
	public $product_ids_arr = [];

	public function get_attributes_values_product( $product_ids_arr = [] , $attributes_values_ids = [] ){
		$this->attributes_values_ids = $attributes_values_ids;
		$this->product_ids_arr = $product_ids_arr;
		if( count($this->product_ids_arr) > 0 ){
			$subquery = $this->db->select("attributes_value_id,product_id")
								 ->from("attributes_values_product")
								 ->where_in("product_id",$this->product_ids_arr)
								 ->get_compiled_select();
			if( count($this->attributes_values_ids) > 0 ){
				$resource = $this->db->select("*")
									 ->from("($subquery) t1")
									 ->where_in("t1.attributes_value_id",$this->attributes_values_ids)
									 ->get();
			}else{
				$resource = $this->db->select("*")
									 ->from("($subquery) t1")
									 ->get();
			}
			return $resource->result();
		}
		
		return [];
	}

	public function get_attributes_values_ids_by_product_ids( $product_ids_arr = [] ){
		$this->product_ids_arr = $product_ids_arr;
		if( count($this->product_ids_arr) > 0 ){
			$resource = $this->db->select("attributes_value_id")
								->where_in("product_id",$this->product_ids_arr)
								->get("attributes_values_product");
			foreach($resource->result() as $row){
				$this->attributes_values_ids[] = $row->attributes_value_id;
			}
		}
		return $this->attributes_values_ids;
	}


	public function get_join_by_product_id( $product_id ){
		$this->product_id = $product_id;
		$resource = $this->db->select("attributes_value_id,product_id")
												->where("product_id",$this->product_id)
												->get("attributes_values_product");
		return $resource->result();
	}

}