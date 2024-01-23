<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('session');
		if( ! $this->isLogin() )  
			redirect('view/Login');
		$this->load->model('EmployeeModel');
	}


	private function isLogin(){
        
        $is_login = $this->session->userdata("is_login");
        $base_url = $this->session->userdata("base_url");

        if( $is_login && $base_url == base_url() )
        	return true;
        else
        	return false;
	}

	public function index(){

		$intent["menuActive"]     = "employee";
		$intent["subMenuActive"]  = "addemployee";
		$intent["headerCss"]   = "admin/employee/employeeCss";
		$intent["mainContent"] = "admin/employee/employee";
		$intent["footerJs"]    = "admin/employee/employeeJs";
		$this->load->view("admin/include/template",$intent);
	}

	public function insertEmployee(){

		$post = $this->input->post();
		$this->load->model('OfficeModel');
		$this->load->model('LocationModel');
		$employeeData["login_type"]   = $this->OfficeModel->getOfficeType($post["office_id"]);   //office_type
		$employeeData["office_type"]  = $this->OfficeModel->getOfficeType($post["office_id"]);   //office_type
		$employeeData["location_type"]= $this->LocationModel->getLocationType($post["location_id"]);
		$employeeData["location_id"]  = $post["location_id"];
		$employeeData["office_id"]    = $post["office_id"];
		$employeeData['name']         = RemoveSpaces($post['name']);
		$employeeData["mobile"]       = $post['mobile'];
		$employeeData["email"]        = $post["email"];
		//$employeeData["person_id"]    = $post['person_id'];
		$employeeData["password"]     = $post["password"];
        $employeeData["added_by"]     = $this->session->userdata("user_id"); 
		$this->EmployeeModel->insertEmployee($employeeData);
		$this->session->set_flashdata(["message"=>"Employee Added Successfully..",
	                                    "css"=>"bg-green"]);
		redirect('Employee');
	}

	
	public function getUserIdByLocationId(){

        $location_id = $this->input->post("location_id");
		$res = $this->EmployeeModel->getUserIdByLocationId($location_id);
		if($res){

			$response["status_code"] = "200";
			$response["status_message"] = "user list found";
			$response["result"] = $res;
		}else{

			$response["status_code"] = "404";
			$response["status_message"] = "user list not found";
			$response["result"] = null;
		}
		echo json_encode($response);
	}



	public function getUserIdByLIdOId(){

        $location_id = $this->input->post("location_id");
        $office_id = $this->input->post("office_id");
		$res = $this->EmployeeModel->getUserIdByLIdOId($location_id,$office_id);
		if($res){

			$response["status_code"] = "200";
			$response["status_message"] = "user list found";
			$response["result"] = $res;
		}else{

			$response["status_code"] = "404";
			$response["status_message"] = "user list not found";
			$response["result"] = null;
		}
		echo json_encode($response);
	}


	public function employeeDetails(){

		$intent["menuActive"]     = "employee";
		$intent["subMenuActive"]  = "employeedetails";
		$intent["headerCss"]      = "admin/employee/employeeDetails/employeeDetailsCss";
		$intent["mainContent"]    = "admin/employee/employeeDetails/employeeDetails";
		$intent["footerJs"]       = "admin/employee/employeeDetails/employeeDetailsJs";
		$this->load->view("admin/include/template",$intent);
	}



	public function getEmployeesDetails(){

		$session_user_id = $this->session->userdata("user_id");
		$locationArr = $this->EmployeeModel->getUserLocationDetail($session_user_id);  // arra either false
		$res = $this->EmployeeModel->getEmployeesDetails( $locationArr );
		if( $res ){

			$response["status_code"] = "200";
			$response["status_message"] = "data found";
			$response["result"] = $res;
		}else{

			$response["status_code"] = "404";
			$response["status_message"] = "data not found";
			$response["result"] = null;
		}
		echo json_encode($response);
	}


	public function deregister(){

		$user_id = $this->input->post("uid");
		$this->EmployeeModel->deregister( $user_id );
		$response["status_code"] = "200";
		$response["status_message"] = "id deregistered Successfully";
		$response["result"] = null;
		echo json_encode($response);
	}


	public function changePasswordView(){
		
		$intent["menuActive"]     = "changepassword";
		$intent["subMenuActive"]  = "changepassword";
		$intent["headerCss"]      = "view/employee/changePassword/changePasswordCss";
		$intent["mainContent"]    = "view/employee/changePassword/changePassword";
		$intent["footerJs"]       = "view/employee/changePassword/changePasswordJs";
		$this->load->view("view/include/template",$intent);
	}

	public function changePassword(){

		$newPwd  = $this->input->post("newPwd");
		$oldPwd  = $this->input->post("oldPwd");
		$conNewPwd = $this->input->post("conNewPwd");
		if( strcmp($newPwd, $conNewPwd) == 0){

			$user_id = $this->session->userdata('id');
			$res = $this->EmployeeModel->changePassword($user_id,$oldPwd,$newPwd);
			if( $res ){
				$arr["message"] = "Password Change Successfully..";
				$arr["css"]     = "bg-green";
			}else{
				$arr["message"] = "InCorrect Old Password..";
				$arr["css"]     = "bg-red";
			}
			
		}else{

			$arr["message"] = "New Password And Confirm New Password Does Not Match..";
			$arr["css"]     = "bg-red";
		}
		$this->session->set_flashdata($arr);
		redirect("view/Employee/changePasswordView");
	}
}