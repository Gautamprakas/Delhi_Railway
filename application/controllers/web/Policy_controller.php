<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function term(){
		$this->load->view("template/header",["css"=>["template/css/cartCss"]]);
		if($this->input->get("signup")){
			$this->load->view("template/signup");
		}else{
			$this->load->view("template/login");
		}
		$this->load->view("template/term-policy");
		$this->load->view("template/footer");
		$this->load->view("template/copyright",["js"=>["template/js/cartJs"]]);
	}

	function privacy(){
		$this->load->view("template/header",["css"=>["template/css/cartCss"]]);
		if($this->input->get("signup")){
			$this->load->view("template/signup");
		}else{
			$this->load->view("template/login");
		}
		$this->load->view("template/privacy-policy");
		$this->load->view("template/footer");
		$this->load->view("template/copyright",["js"=>["template/js/cartJs"]]);
	}
}