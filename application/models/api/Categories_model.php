<?php

class Categories_model extends MY_Model {

	public $id;
	public $name;
	public $parent_id;
	public $inserted_at;
	public $updated_at;

	public function get_all_categories(){
		
		$result_resource = $this->db->order_by("order_by","ASC")->get("categories");
		$result = [];
		$i=0;
		foreach($result_resource->result() as $row){

			if( !isset( $result[$row->id] ) ){
				$result[$row->id] = [
					"parent_ids" => [],
					"name" => '',
					"child_ids" => []
				];
			}

			if( !isset( $result[$row->parent_id] ) ){
				$result[$row->parent_id] = [
					"parent_ids" => [],
					"name" => '',
					"child_ids" => []
				];
			}

			if(!empty($row->parent_id)){
				$result[$row->id]["parent_ids"][0] = $row->parent_id;
			}
			$result[$row->id]["name"] = $row->name;
			$result[$row->parent_id]["child_ids"][] = $row->id;
			$i++;
		}
		if($i>0){
			unset($result['']);
		}
		return $result;
	}

}