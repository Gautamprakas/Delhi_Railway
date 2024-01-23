<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function listing(){
		$this->load->view("template/header",["css"=>["template/css/shopCss"]]);
		if($this->input->get("signup")){
			$this->load->view("template/signup");
		}else{
			$this->load->view("template/login");
		}
		$this->load->view("template/shop");
		$this->load->view("template/footer");
		$this->load->view("template/copyright",["js"=>["template/js/shopJs"]]);
	}

	public function detail(){
		$this->load->view("template/header",["css"=>["template/css/productCss"]]);
		if($this->input->get("signup")){
			$this->load->view("template/signup");
		}else{
			$this->load->view("template/login");
		}
		$this->load->view("template/product");
		$this->load->view("template/footer");
		$this->load->view("template/copyright",["js"=>["template/js/productJs"]]);
	}
}