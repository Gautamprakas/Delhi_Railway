<?php

class Product_media_model extends MY_Model {

	public $media_id;
	public $product_id;
	public $inserted_at;
	public $updated_at;

	public $media_ids_arr = [];
	public $product_ids_arr = [];
	public $product_media = [];
	public $media_product = [];
	public $product_categories_join = [];


	public function get_join_and_set_media_id_to_products( $product_ids , $products ){
		$this->product_ids_arr = $product_ids;
		if( count($this->product_ids_arr) > 0 ){
			$product_media_resource = $this->db->select("media_id,product_id")->where_in("product_id",$this->product_ids_arr)->get("product_media");
			foreach($product_media_resource->result() as $row){
				$this->product_media[$row->product_id][] = $row->media_id;
				$this->media_product[$row->media_id][]   = $row->product_id;
				$products[$row->product_id]->media[$row->media_id] = [];
			}
		}
		return [
			"product_media"=>$this->product_media,
			"media_product"=>$this->media_product
		];
	}


	public function get_join_by_product_id($product_id = ''){
		$this->product_id = $product_id;
		$product_media_resource = $this->db->get_where("product_media",["product_id"=>$this->product_id]);
		return $product_media_resource->result();
	}


}