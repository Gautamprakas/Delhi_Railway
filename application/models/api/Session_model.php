<?php

class Session_model extends MY_Model {

	public $id;
	public $data;
	public $inserted_at;
	public $updated_at;

	public function add( $session_data, $user_id ){
		$this->id = uniqid(sprintf("%s_",$this->user_id),TRUE);
		$this->data = $session_data;
		$this->inserted_at = mtime();
		unset($this->updated_at);
		$this->db->insert('sessions',$this);
		return $this->id;
	}
}