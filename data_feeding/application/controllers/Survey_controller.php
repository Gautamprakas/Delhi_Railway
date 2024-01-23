<?php

class Survey_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	function index(){
		/*if(  $this->session->userdata('is_feedback') ){
			redirect("survey_controller/comming_soon");
		}else if( $this->session->userdata('is_signup') ){
			redirect("survey_controller/feedback");
		}
		$this->load->view("view/signup");  */
		redirect(base_url("view/login"));
	}


	function feedback(){
		/*if(  $this->session->userdata('is_feedback') ){
			redirect("survey_controller/comming_soon");
		}else*/ if( $this->session->userdata('is_signup') ){
			$this->load->view("view/survey");
		}else{
			redirect("survey_controller/index");
		}
		
	}

	function comming_soon(){
		$this->load->view("view/comming_soon");
	}


	function set_signup(){
		$name =  $this->input->post("name");
		$mobile =  $this->input->post("mobile");
		$form_id =  $this->input->post("form_id");
		$this->session->set_userdata("name",$name);
		$this->session->set_userdata("mobile",$mobile);
		$this->session->set_userdata("form_id",$form_id);
		$this->session->set_userdata("is_signup",true);
		echo "success";
	}

	function set_feedback(){
		$this->session->set_userdata("is_feedback",true);
		echo "success";
	}


	function unset_all(){
		$this->session->sess_destroy();
		redirect();
	}


	function current_datetime(){
		echo date("Y-m-d H:i:s");
	}

}