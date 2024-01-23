<?php

class Attributes_name_model extends MY_Model {
	
	public $id;
	public $name;
	public $type;
	public $visibility;
	public $inserted_at;
	public $updated_id;

	public $attributes_name_ids = [];

	public function get_attributes_name_by_attribute_name_ids( $attributes_name_ids ){
		$this->attributes_name_ids = $attributes_name_ids;
		if( count($this->attributes_name_ids) > 0 ){
			$resource = $this->db->select("id,name,type")
								->where_in("id",$this->attributes_name_ids)
								->where("visibility",1)
								->get("attributes_name");
			return $resource->result();
		}
		return [];
	}



}