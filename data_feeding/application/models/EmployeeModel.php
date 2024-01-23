<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model {

	function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
    }

	public function insertEmployee( $employeeData ){       // EmployeeData

		$employeeData["user_id"]     = $this->getNextEmpID();
		$employeeData["record_datetime"] = date("Y-m-d H:i:s");
		if($this->db->insert( "user_details" , $employeeData ))
		     return true;
		else
		 	return false;
	}

	public function getNextEmpID(){

		$this->db->select_max("user_id");
		$res = $this->db->get("user_details");
		$id = $res->row()->user_id;
		if($id)
			return ++$id;
		else
			return 1000;
	}


	public function getUserIdByLocationId( $locationId ){

		$this->db->select("user_id,name");
		$this->db->where("location_id",$locationId);
		$res = $this->db->get("user_details");
		if($res->num_rows()>0)
			return $res->result();
		else
			return false;
	}
    


    public function getUserIdByLIdOId( $locationId , $office_id ){

		$this->db->select("user_id,name");
		$this->db->where("location_id",$locationId);
        $this->db->where("office_id",$office_id);
		$res = $this->db->get("user_details");
		if($res->num_rows()>0)
			return $res->result();
		else
			return false;
	}

	public function getUserLocationDetail( $user_id ){

		$this->db->select("location_details.admin as admin");
		$this->db->select("location_details.district as district");
		$this->db->select("location_details.tehsil as tehsil");
		$this->db->select("location_details.block as block");
		$this->db->select("location_details.cluster as cluster");
		$this->db->select("location_details.village as village");
		$this->db->from("user_details");
		$this->db->join("location_details","user_details.location_id = location_details.location_id");
		$this->db->where("user_id",$user_id);
		$res = $this->db->get();
		if($res->num_rows()>0){
            
            $row = $res->row();
			$location["location_details.admin"] = $row->admin;
			if($row->district != null)
				$location["location_details.district"] = $row->district;
			if($row->tehsil != null)
				$location["location_details.tehsil"] = $row->tehsil;
			if($row->block != null)
				$location["location_details.block"] = $row->block;
			if($row->cluster != null)
				$location["location_details.cluster"] = $row->cluster;
			if($row->village != null)
				$location["location_details.village"] = $row->village;

			return $location;
		}else{

			return false;
		}
	}


	public function deregister( $user_id ){

		$this->db->where("user_id",$user_id);
		$this->db->update("user_details",["registered"=>"no"]);
	}



	public function getEmployeesDetails( $locationArr ){

		$this->db->select("user_details.user_id as Emp ID");
		$this->db->select("user_details.name as Emp Name");
		$this->db->select("user_details.mobile as Mobile");
		$this->db->select("user_details.email as Email");
		$this->db->select("user_details.status as Status");
		$this->db->select("user_details.registered as App Reg");
		//$this->db->select("office_details.office_type as Office_Type");
		$this->db->select("office_details.office_name as Office Name");
        /*$this->db->select("location_details.location_type as Location_type");
        $this->db->select("location_details.district as District");
        $this->db->select("location_details.tehsil as Tehsil");
        $this->db->select("location_details.block as Block");
        $this->db->select("location_details.cluster as Cluster");
        $this->db->select("location_details.village as Village");*/
		$this->db->from("user_details");
		$this->db->join("location_details","user_details.location_id = location_details.location_id");
		$this->db->join("office_details","user_details.office_id = office_details.office_id");
		if( $locationArr )
		$this->db->where( $locationArr );
		$res = $this->db->get();
        if($res->num_rows()>0)
        	return $res->result();
        else
        	return false;
	}


	public function changePassword( $user_id , $oldPwd , $newPwd ){

		$this->db->where("id",$user_id);
		$this->db->where("pwd",$oldPwd);
		$res = $this->db->get("user");
		if( $res->num_rows() >0 ){
			$this->db->where("id",$user_id);
		    $this->db->where("pwd",$oldPwd);
		    $this->db->update("user",["pwd"=>$newPwd]);
		    return true;
		}else{
			return false;
		}
		
	}
}