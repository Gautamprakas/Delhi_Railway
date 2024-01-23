<?php

class Order_products_model extends MY_Model {

	public $id;
	public $order_id;
	public $sku;
	public $name;
	public $description;
	public $price;
	public $quantity;
	public $subtotal;
	public $inserted_at;
	public $updated_at;

	public function add( $order_product , $order_id, $product_model, $product_hashmap ){
		
		foreach($order_product as $product_id => $product_detail){
			$this->order_id    = $order_id;
			$this->sku         = $product_detail["sku"];
			$this->name        = $product_detail["name"];
			$this->description = $product_detail["description"];
			$this->price       = $product_detail["price"];
			$this->quantity    = $product_detail["qty"];
			$this->subtotal   = $product_detail["sub_total"];
			$this->inserted_at = mtime();
			unset($this->id);
			unset($this->updated_at);
			$this->db->insert("order_products",$this);
			$product_model->update_product_details($product_id,[
				'quantity'=>($product_hashmap[$product_id]->quantity-$this->quantity)
			]);
		}
		return true;
	}

	public function products($order_ids_arr = []){
		if(count($order_ids_arr)>0){
			$resource = $this->db->select("id,order_id,sku,name,description,price,quantity,subtotal,'pending' as 'status'")
								 ->where_in("order_id",$order_ids_arr)
								 ->get("order_products");
			return $resource->result();
		}
		return [];
	}

}