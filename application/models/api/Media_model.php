<?php

class Media_model extends MY_Model {

	public $id;
	public $url;
	public $thumbnail;
	public $inserted_at;
	public $updated_at;

	public $media_ids_arr = [];
	public $product_media_join = [];


	public function set_media_url_in_media_id_of_product( $product_media_join = [] , $products ){
		$this->product_media_join = $product_media_join;
		$this->media_ids_arr = array_keys($this->product_media_join["media_product"]);
		if( count($this->media_ids_arr) > 0 ){
			$media_resouce = $this->db->select("id,url,thumbnail")
									  ->where_in("id",$this->media_ids_arr)
									  ->get("media");
			foreach($media_resouce->result() as $row){
				foreach( $this->product_media_join["media_product"][$row->id] as $product_id){
					$products[$product_id]->media[$row->id] = [
						"id" => $row->id,
						"url" => base_url($row->url),
						"thumbnail" => base_url($row->thumbnail)
					];
				} 
			}
			return $media_resouce->result();
		}
		return [];
	}


	public function get_product_media($media_ids_arr = ''){
		$this->media_ids_arr = $media_ids_arr;
		return $this->db->select("id,url,thumbnail")->where_in("id",$this->media_ids_arr)->get('media')->result();
	}

}
