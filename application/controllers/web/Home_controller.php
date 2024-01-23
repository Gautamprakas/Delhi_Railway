<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function home(){
		$this->load->view("template/header",["css"=>["template/css/homeCss"]]);
		if($this->input->get("signup")){
			$this->load->view("template/signup");
		}else{
			$this->load->view("template/login");
		}
		$this->load->view("template/banner");
		$this->load->view("template/adverts");
		$this->load->view("template/brands");
		$this->load->view("template/footer");
		$this->load->view("template/copyright",["js"=>["template/js/homeJs"]]);
	}


	public function important_links(){
		$this->load->view("template/header2",["css"=>["template/css/home2Css"]]);
		$this->load->view("template/banner2");
		$this->load->view("template/copyright",["js"=>["template/js/home2Js"]]);
	}
}