<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_controller extends Api_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load('api', $this->language);
	}

	public function get_all_categories_get(){
		$this->load->model('api/categories_model','categories_model');
		$categories = $this->categories_model->get_all_categories();
		$this->set_response([
			"status" => REST_Controller::HTTP_OK,
			"message" => $this->lang->line('get_all_categories'),
			"error" => null,
			"data" => $categories
		], REST_Controller::HTTP_OK);
	}
}