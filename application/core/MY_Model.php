<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		#$this->db->conn_id->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true);
	}
}