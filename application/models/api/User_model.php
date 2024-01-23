<?php

class User_model extends MY_Model {

	public $id;
	public $username;
	public $password;
	public $mobile;
	public $email;
	public $name;
	public $active;
	public $inserted_at;
	public $updated_at;

	public function login($username,$password){
		$this->username = $username;
		$this->password = $password;
		$result_resource = $this->db->get_where('users',['username'=>$this->username]);
		if( $result_resource->num_rows() == 1 && password_verify($this->password,$result_resource->row()->password) ){
			$this->id          = $result_resource->row()->id;
			$this->username    = $result_resource->row()->username;
			$this->mobile      = $result_resource->row()->mobile;
			$this->email       = $result_resource->row()->email;
			$this->name        = $result_resource->row()->name;
			$this->active      = $result_resource->row()->active;
			$this->inserted_at = $result_resource->row()->inserted_at;
			$this->updated_at  = $result_resource->row()->updated_at;
			$this->location  = explode(",",$result_resource->row()->location);
			$this->type  = $result_resource->row()->type;
			$this->dept  = $result_resource->row()->dept;
			$this->coach_vivran  = $result_resource->row()->coach_vivran;
			unset($this->password);
			return $this;
		}
		return false;
	}


	public function user_detail_by_id($id){
		$this->id = $id;
		$result_resource = $this->db->get_where('users',['id'=>$this->id]);
		if( $result_resource->num_rows() == 1 ){
			$this->id          = $result_resource->row()->id;
			$this->mobile      = $result_resource->row()->mobile;
			$this->email       = $result_resource->row()->email;
			$this->name        = $result_resource->row()->name;
			$this->active      = $result_resource->row()->active;
			$this->inserted_at = $result_resource->row()->inserted_at;
			$this->updated_at  = $result_resource->row()->updated_at;
			unset($this->password);
			return $this;
		}
		return false;
	}


	public function signup( $reqData ){
		$this->username = $reqData["mobile"];
		$this->password = password_hash($reqData["password"], PASSWORD_DEFAULT);
		$this->mobile   = $reqData["mobile"];
		$this->email    = isset($reqData["email"])?$reqData["email"]:sprintf("%s@gmail.com",$reqData["mobile"]);
		$this->address    = isset($reqData["address"])?$reqData["address"]:"";
		$this->name     = $reqData["name"];
		$this->active 	= 1;
		$this->inserted_at = mtime();
 		unset($this->id);
 		unset($this->updated_at);
 		if( $this->db->insert("users",$this) ){
 			$this->id = $this->db->insert_id();
 			unset($this->password);
 			return $this;
 		}
		return false;
	}


}