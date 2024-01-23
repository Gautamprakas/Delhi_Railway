<?php

class Create_Database extends CI_Controller{

	
	function __construct(){
		parent::__construct();
		$this->load->helper("my_helper");
		/*print_r(sam([
			"age" => 82,
			"gender" => 'female',
			"height" => 100,
			"weight" => 2,
			"head circumference" => 100,
			"mauc" => 11
		]));*/
		//exit('Permission Denied');
		$this->_create_db();
		$this->dbforge = $this->load->dbforge($this->load->database("default",TRUE),TRUE);
		$this->db = $this->load->database("default",TRUE);
		$this->load->helper("db_helper");
	}


	public function index(){
		
    	$this->_create_disease_questions();
    	$this->_create_child_info();
    	$this->_create_child_ques_ans();
    	$this->_create_child_media();
    	$this->_create_physical_indicators_for_growth();
    	$this->_create_child_media_pred();
    	$this->_create_user();
    	$this->_create_manual_diagnosis();
    	$this->_create_form_created();
    	$this->_create_form_data();
			
	}

	private function _create_db(){
		$myforge = $this->load->dbforge($this->load->database("install",TRUE),TRUE);
		$myforge->create_database('disease_diagnosis');
		echo 'Database created!';
	}

	private function _create_disease_questions(){
		$table_name = 'disease_questions';
		$fields = array(
		        'ques_id' => array(
		                'type' => 'INT',
		                'constraint' => 5,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'ques_eng' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '500'
		        ),
		        'ques_hi' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '500'
		        ),
		        'disease' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'disease_type' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'refer_if' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'is_required' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '10'
		        ),
		        'expression' => array(
		        		'type' => 'VARCHAR',
		        		'constraint' => '100'
		        ),
		        'images' => array(
		        		'type' => 'VARCHAR',
		        		'constraint' => '100'
		        )
		);
		;
		$this->dbforge = $this->load->dbforge($this->load->database("default"),TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ques_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		echo sprintf('Table %s Created!', $table_name);
	}


	private function _create_child_info(){
		$table_name = 'child_info';
		$fields = array(
		        'child_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'child_name' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '50'
		        ),
		        'mother_name' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '50'
		        ),
		        'father_name' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '50'
		        ),
		        'child_age_in_months' => array(
		                'type' => 'INT',
		                'constraint' => 5
		        ),
		        'weight_in_kg' => array(
		                'type' => 'DECIMAL',
		                'constraint' => '5,2'
		        ),
		        'height_in_cm' => array(
		                'type' => 'DECIMAL',
		                'constraint' => '5,2'
		        ),
		        'gender' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '10'
		        ),
		        'record_datetime' => array(
		                'type' => 'DATETIME'
		        ),
		        'quiz' => array(
		                'type' => 'INT',
		                'constraint' => 1,
  						'default' => 0
		        ),
		        'media_url' => array(
		                'type' => 'INT',
		                'constraint' => 1,
  						'default' => 0
		        ),
		        'media' => array(
		                'type' => 'INT',
		                'constraint' => 1,
  						'default' => 0
		        ),
		        'ai_model' => array(
		                'type' => 'INT',
		                'constraint' => 1,
  						'default' => 0
		        ),
		        'diagnosis' => array(
		                'type' => 'TEXT',
  						'default' => ''
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('child_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		echo sprintf('Table %s Created!', $table_name);
	}


	private function _create_child_ques_ans(){
		$table_name = 'child_ques_ans';
		$fields = array(
		        'record_id' => array(
		                'type' => 'INT',
		                'constraint' => 10,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'ques_id' => array(
		                'type' => 'INT',
		                'constraint' => 5,
		                'unsigned' => TRUE,
		        ),
		        'child_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'ans' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'record_datetime' => array(
		                'type' => 'DATETIME'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('record_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		$this->db->query(add_foreign_key($table_name, 'ques_id', 'disease_questions(ques_id)', 'CASCADE', 'CASCADE'));
		$this->db->query(add_foreign_key($table_name, 'child_id', 'child_info(child_id)', 'CASCADE', 'CASCADE'));
		echo sprintf('Table %s Created!', $table_name);
	}


	private function _create_child_media(){
		$table_name = 'child_media';
		$fields = array(
		        'child_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'label' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'media_type' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'media_url' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'record_datetime' => array(
		        		'type' => 'DATETIME'
		        ),
		        'online' => array(
		                'type' => 'INT',
		                'constraint' => 1,
  						'default' => 0
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('media_url', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		$this->db->query(add_foreign_key($table_name, 'child_id', 'child_info(child_id)', 'CASCADE', 'CASCADE'));
		echo sprintf('Table %s Created!', $table_name);
	}



	private function _create_child_media_pred(){
		$table_name = 'child_media_pred';
		$fields = array(
				'media_url' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'model' => array(
		        		'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'class' => array(
		        		'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'prob' => array(
		        		'type' => 'VARCHAR',
		                'constraint' => '10'
		        ),
		        'record_datetime' => array(
		        		'type' => 'DATETIME'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('media_url', TRUE);
		$this->dbforge->add_key('model', TRUE);
		$this->dbforge->add_key('class', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		$this->db->query(add_foreign_key($table_name, 'media_url', 'child_media(media_url)', 'CASCADE', 'CASCADE'));
		echo sprintf('Table %s Created!', $table_name);
	}


	private function _create_physical_indicators_for_growth(){

		$table_name = 'physical_indicators_for_growth';
		$fields = array(
		        'record_id' => array(
		                'type' => 'INT',
		                'constraint' => 10,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'indicator' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'gender' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '10'
		        ),
		        'input' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'input_value' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'output' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        '-3sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        '-2sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        '-1sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        'median' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        '1sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        '2sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        ),
		        '3sd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '5'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('record_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		echo sprintf('Table %s Created!', $table_name);

	}
    

    private function _create_user(){

		$table_name = 'user';
		$fields = array(
		        'id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '20'
		        ),
		        'pwd' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '20'
		        ),
		        'type' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '20'
		        ),
		        'mobile' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '10'
		        ),
		        'status' => array(
		                'type' => 'ENUM("active","inActive")',
  						'default' => 'active'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		echo sprintf('Table %s Created!', $table_name);

	}


	private function _create_manual_diagnosis(){
		$table_name = 'manual_diagnosis';
		$fields = array(
			    'record_id' => array(
		                'type' => 'INT',
		                'constraint' => 10,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'child_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'disease' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '70'
		        ),
		        'record_datetime' => array(
		                'type' => 'DATETIME'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('record_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		$this->db->query(add_foreign_key($table_name, 'child_id', 'child_info(child_id)', 'CASCADE', 'CASCADE'));
		echo sprintf('Table %s Created!', $table_name);
	}




	private function _create_form_created(){
		$table_name = 'form_created';
		$fields = array(
		        'form_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'form_title' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '500'
		        ),
		        'fields_count' => array(
		                'type' => 'INT',
		                'constraint' => 10,
		                'unsigned' => TRUE
		        ),
		        'create_datetime' => array(
		                'type' => 'DATETIME'
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('form_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		echo sprintf('Table %s Created!', $table_name);
	}


	private function _create_form_data(){
		$table_name = 'form_data';
		$fields = array(
				'record_id' => array(
		                'type' => 'INT',
		                'constraint' => 10,
		                'unsigned' => TRUE,
		                'auto_increment' => TRUE
		        ),
		        'req_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'child_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'form_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'field_id' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'title' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '500'
		        ),
		        'field' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '500'
		        ),
		        'field_type' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '50'
		        ),
		        'value' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '500'
		        ),
		        'create_datetime' => array(
		                'type' => 'DATETIME'
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME'
		        )
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('record_id', TRUE);
		$this->dbforge->create_table($table_name, TRUE);
		$this->db->query(add_foreign_key($table_name, 'form_id', 'form_created(form_id)', 'CASCADE', 'CASCADE'));
		echo sprintf('Table %s Created!', $table_name);
	}
}


