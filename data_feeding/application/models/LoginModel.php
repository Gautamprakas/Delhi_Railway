<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
        $this->load->helper('my_helper');
    }

	public function validate( $uid , $pwd , $user_agent){ 
		/*// validate user id and password for software login...
        $this->db->where("id",$uid);
        $this->db->where("pwd",$pwd);
        $this->db->where("status","active");
        $res = $this->db->get("user");

        if( $res->num_rows() > 0 && caseCompareIdPwd($uid,$pwd,$res->row()->id,$res->row()->pwd) ){
        	
            $loginDateTime = date("Y-m-d H:i:s");

            $row                     = $res->row();
        	$data["id"]              = $row->id;
        	$data["type"]            = $row->type;
        	$data["is_login"]        = true;
        	$data["mobile"]          = $row->mobile;
            $data["base_url"]        = base_url();
            
        }else{
        	
        	$data["is_login"] = false;
        }*/

        $result_resource = $this->db->get_where('users',['username'=>$uid]);
        if( $result_resource->num_rows() == 1 && password_verify($pwd,$result_resource->row()->password) ){

            $data["id"]              = $result_resource->row()->username;
            $data["type"]            = $result_resource->row()->type;
            $data["location"]        = $result_resource->row()->location;
            $data["dept"]        = $result_resource->row()->dept;
            $data["is_login"]        = true;
            $data["mobile"]          = $result_resource->row()->mobile;
            $data["base_url"]        = base_url();
            $data["train_numbers"]   = [];

            $res = $this->db->where("username",$data["id"])->get("railway_mapping");
            foreach($res->result() as $row){
                $data["train_numbers"][] = $row->train_number;
            }
            $data["train_numbers"] = implode(",",$data["train_numbers"]);

        }else{

            $data["is_login"] = false;
            
        }

       /* if( $uid == "admin" && $pwd == "admin@123" ){
            
            $data["id"]              = "admin";
            $data["type"]            = 'admin';
            $data["is_login"]        = true;
            $data["mobile"]          = '';
            $data["base_url"]        = base_url();
            
        }else{
            
            $data["is_login"] = false;
        }*/

        return $data;
	}


}