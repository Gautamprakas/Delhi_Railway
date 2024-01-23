<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function dashboard(){

		$intent["menuActive"] = "home";
		$intent["subMenuActive"]  = "home";
		$intent["headerCss"]   = "admin/dashboard/dashboardCss";
		$intent["mainContent"] = "admin/dashboard/dashboard";
		$intent["footerJs"]    = "admin/dashboard/dashboardJs";
		$this->load->view("admin/include/template",$intent);
	}

	
} 