<?php

class Attributes_values_model extends MY_Model {

	public $id;
	public $value;
	public $inserted_at;
	public $updated_id;

	public $attributes_values_ids = [];

	public function get_attributes_values_by_attribute_values_ids( $attributes_values_ids ){
		$this->attributes_values_ids = $attributes_values_ids;
		if( count($this->attributes_values_ids) > 0 ){
			$resource = $this->db->select("id,value")
								->where_in("id",$this->attributes_values_ids)
								->get("attributes_values");
			return $resource->result();
		}
		return [];
	}

}