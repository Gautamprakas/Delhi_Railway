<?php

class Seed extends CI_Controller{

	
	function __construct(){
		parent::__construct();
		//exit('Permission Denied');
		$this->db = $this->load->database('default',TRUE);
		$this->load->library("csvimport");
		$this->load->helper('my_helper');
	}

	public function disease_questions(){
		$table_name = 'disease_questions';
		$questions_file = './application/questions/disease_questions.csv';
		$data = $this->csvimport->get_array($questions_file);
		// echo "<pre>";
		// print_r($data);
		$this->db->query("SET FOREIGN_KEY_CHECKS = 0");
		$this->db->truncate($table_name);
		$this->db->query("SET FOREIGN_KEY_CHECKS = 1");
		foreach($data as $key => $value){
			$this->db->insert($table_name,$value);
		}
		echo 'Done';
	}

	public function physical_indicators_for_growth(){
		$table_name = 'physical_indicators_for_growth';
		$questions_file = './application/questions/physical_indicators_for_growth.csv';
		$data = $this->csvimport->get_array($questions_file);
		// echo "<pre>";
		// print_r($data);
		$this->db->query("SET FOREIGN_KEY_CHECKS = 0");
		$this->db->truncate($table_name);
		$this->db->query("SET FOREIGN_KEY_CHECKS = 1");
		foreach($data as $key => $value){
			unset($value['sno']);
			$this->db->insert($table_name,$value);
		}
		echo 'Done';
	}

	public function api_uploadQuiz(){
		$json_file = './application/questions/api_uploadQuiz.json';
		$str = file_get_contents($json_file);
		echo httpPost(base_url('api/uploadQuiz'),array('json'=>$str));
	}

	public function api_uploadMediaUrls(){
		$json_file = './application/questions/api_uploadMediaUrls.json';
		$str = file_get_contents($json_file);
		echo httpPost(base_url('api/uploadMediaUrls'),array('json'=>$str));
	}
}