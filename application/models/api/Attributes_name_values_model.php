<?php

class Attributes_name_values_model extends MY_Model {
	
	public $attributes_name_id;
	public $attributes_value_id;
	public $inserted_at;
	public $updated_id;

	public $attributes_name_ids = [];
	public $attributes_name_values = [];
	public $attributes_values_name = [];

	public function get_join_by_attribute_name_ids( $attributes_name_ids, $start=0, $limit=10 ){
		$this->attributes_name_ids = $attributes_name_ids;
		if( count($this->attributes_name_ids) > 0 ){
			$attributes_name_values_resource = $this->db->select("attributes_name_id,attributes_value_id")
													->where_in("attributes_name_id",$this->attributes_name_ids)
													->limit($limit,$start)
													->get("attributes_name_values");
			foreach($attributes_name_values_resource->result() as $row){
				$this->attributes_name_values[$row->attributes_name_id][] = $row->attributes_value_id;
				$this->attributes_values_name[$row->attributes_value_id][] = $row->attributes_name_id; 
			}
		}
		return [
			"attributes_name_values" => $this->attributes_name_values,
			"attributes_values_name" => $this->attributes_values_name
		];
	}

	public function get_join_by_attribute_values_ids( $attributes_values_ids ){
		$this->attributes_values_ids = $attributes_values_ids;
		if( count($this->attributes_values_ids) > 0 ){
			$resource = $this->db->select("attributes_name_id,attributes_value_id")
								 ->where_in("attributes_value_id",$this->attributes_values_ids)
								 ->get("attributes_name_values");
			return $resource->result();
		}
		return [];
	}

}