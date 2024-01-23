<?php

class Attributes_set_name_model extends MY_Model {

	public $attributes_set_id;
	public $attributes_name_id;
	public $required;
	public $inserted_at;
	public $updated_id;

	public $attributes_set_ids = [];
	public $attributes_set_name = [];
	public $attributes_name_set = [];

	public function get_join_by_attribute_set_ids( $attributes_set_ids, $start=0, $limit=10 ){
		$this->attributes_set_ids = $attributes_set_ids;
		if( count($this->attributes_set_ids) > 0 ){
			$attributes_set_name_resource = $this->db->select("attributes_set_id,attributes_name_id")
													->where_in("attributes_set_id",$this->attributes_set_ids)
													->limit($limit,$start)
													->get("attributes_set_name");
			foreach($attributes_set_name_resource->result() as $row){
				$this->attributes_set_name[$row->attributes_set_id][] = $row->attributes_name_id;
				$this->attributes_name_set[$row->attributes_name_id][] = $row->attributes_set_id; 
			}
		}
		return [
			"attributes_set_name" => $this->attributes_set_name,
			"attributes_name_set" => $this->attributes_name_set
		];
	}


	public function get_join_by_attribute_set_ids2( $attributes_set_ids ){
		$this->attributes_set_ids = $attributes_set_ids;
		if( count($this->attributes_set_ids) > 0 ){
			$attributes_set_name_resource = $this->db->select("attributes_set_id,attributes_name_id")
													->where_in("attributes_set_id",$this->attributes_set_ids)
													->get("attributes_set_name");
			return $attributes_set_name_resource->result();
		}
		return [];
	}

}