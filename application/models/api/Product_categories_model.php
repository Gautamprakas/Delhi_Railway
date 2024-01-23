<?php

class Product_categories_model extends MY_Model {

	public $category_id;
	public $product_id;
	public $inserted_at;
	public $updated_at;

	public $category_ids_arr = [];
	public $product_ids_arr = [];
	public $product_categories = [];
	public $categories_product = []; 


	public function get_join_by_category_ids( $category_ids_arr = [], $start = 0, $limit = 10){
		$this->category_ids_arr = $category_ids_arr;
		if( count($this->category_ids_arr) > 0 ){
			$product_categories_resource = $this->db->select("product_id,category_id")
													->where_in("category_id",$this->category_ids_arr)
													->limit($limit,$start)
													->get("product_categories");
			foreach($product_categories_resource->result() as $row){
				$this->product_categories[$row->product_id][] = $row->category_id;
				$this->categories_product[$row->category_id][] = $row->product_id; 
			}
		}
		return [
			"product_categories" => $this->product_categories,
			"categories_product" => $this->categories_product
		];
	}
 	
	
 	public function get_product_ids_by_category_ids( $category_ids_arr = [] ){
		$this->category_ids_arr = $category_ids_arr;
		if( count($this->category_ids_arr) > 0 ){
			$product_categories_resource = $this->db->select("product_id,category_id")
													->where_in("category_id",$this->category_ids_arr)
													->get("product_categories");
			foreach($product_categories_resource->result() as $row){
				$this->product_ids_arr[] = $row->product_id;
			}
		}
		return $this->product_ids_arr;
	}


}