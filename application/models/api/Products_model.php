<?php

class Products_model extends MY_Model {

	public $id;
	public $sku;
	public $name;
	public $product_status_id;
	public $regular_price;
	public $discount_price;
	public $quantity;
	public $taxable;
	public $total_rating;
	public $rating_user_count;
	public $rating;
	public $inserted_at;
	public $updated_at;

	public $products = [];
	public $product_ids_arr = [];
	public $product_categories_join = [];


	public function get_products_by_product_categories_join( $product_categories_join = [] ){
		$this->product_categories_join = $product_categories_join;
		$this->product_ids_arr = array_keys($this->product_categories_join["product_categories"]);
		if( count($this->product_ids_arr) > 0 ){
			$products_resource = $this->db->select("id,sku,name,short_description,product_status_id")
										  ->select("regular_price,discount_price,quantity")
										  ->where_in("id",$this->product_ids_arr)
								 		  ->get("products");
			foreach($products_resource->result() as $row){
				$this->products[$row->id] = $row;
				$this->products[$row->id]->media = [];
			}
		}
		return $this->products;
	}


	public function get_products_by_product_ids( $product_ids, $sort, $start, $limit ){
		$temp_sort = sorting_helper($sort,$this);
		$this->product_ids_arr = $product_ids;
		if( count($this->product_ids_arr) > 0 ){
			$products_resource = $this->db->select("id,sku,name,short_description,product_status_id")
										  ->select("regular_price,discount_price,quantity")
										  ->where_in("id",$this->product_ids_arr)
										  ->order_by($temp_sort["ordering"])
										  ->limit($limit,$start)
								 		  ->get("products");
			foreach($products_resource->result() as $row){
				$this->products[$row->id] = $row;
				$this->products[$row->id]->media = [];
			}
		}
		return $this->products;
	}


	public function get_product_by_id( $product_id ){
		$this->id = $product_id;
		$products_resource = $this->db->select("id,sku,name,quantity,description,regular_price,discount_price")
									  ->get_where("products",["id"=>$this->id]);
		if($products_resource->num_rows()>0){
			return $products_resource->row();
		}
		return false;
	}

	
	public function get_product_complete_details_by_id( $product_id ){
		$this->id = $product_id;
		$products_resource = $this->db->select("id,sku,name,rating,rating_user_count,description,regular_price,discount_price")
									  ->get_where("products",["id"=>$this->id]);
		if($products_resource->num_rows()>0){
			return $products_resource->row();
		}
		return false;
	}


	public function get_products_by_ids( $product_ids_arr, $sort = 0 ){
		$this->product_ids_arr = $product_ids_arr;
		$products_resource = $this->db->select("id,sku,name,quantity,description,regular_price,discount_price")
									  ->where_in('id',$this->product_ids_arr)
									  ->get("products");
		foreach($products_resource->result() as $row){
			$this->products[$row->id] = $row;
		}
		return $this->products;
	}


	public function update_product_details( $product_id , $data ){
		$this->db->where('id',$product_id);
		$this->db->update("products",$data);
		return true;
	}



	public function update_product_rating($product_id,$rating,$old_rating=null){
		$this->id = $product_id;
		$this->updated_at = mtime();
		$resource = $this->db->select("total_rating,rating_user_count")->get_where('products',["id"=>$this->id]);
		if($resource->num_rows()>0){
			$this->total_rating = $resource->row()->total_rating;
			$this->rating_user_count = $resource->row()->rating_user_count;
			if($old_rating == null){ //inserted as new
				$this->total_rating += $rating;
				$this->rating_user_count += 1;
				$this->rating = $this->total_rating/$this->rating_user_count;
			}else{ //updated
				$this->total_rating -= $old_rating;
				$this->total_rating += $rating;
				$this->rating = $this->total_rating/$this->rating_user_count;
			}
			$this->db->where('id',$this->id)->update("products",[
				"total_rating"=>$this->total_rating,
				"rating_user_count"=>$this->rating_user_count,
				"rating"=>$this->rating,
				"updated_at" => $this->updated_at
			]);
			return true;
		}else{
			return false;
		}
	}

}