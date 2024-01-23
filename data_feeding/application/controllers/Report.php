<?php

class Report extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->db = $this->load->database("default",TRUE);
	}


	private function _getReport($child_id = '', $date = ''){

		$result = [];
		$res = $this->db->get_where('child_info',['child_id'=>$child_id]);
		if($res->num_rows()>0){
			
			$result['child_info'] = $res->row();
			$result['quiz'] = [];
			
			$res = $this->db->select('ques_id,ans,record_datetime')->get_where('child_ques_ans',
											['child_id'=>$child_id,'DATE(record_datetime)'=>$date]);
			if($res->num_rows()>0){
				$QuizData = [];
				$QuesId = [];
				foreach($res->result() as $ques){
					$QuizData[$ques->ques_id] = $ques;
					$QuesId[] = $ques->ques_id;
				}
				$res = $this->db->where_in('ques_id',$QuesId)->get('disease_questions');
				foreach($res->result() as $ques){
					$QuizData[$ques->ques_id]->disease = $ques->disease;
					$QuizData[$ques->ques_id]->disease_type = $ques->disease_type;
					$QuizData[$ques->ques_id]->ques = $ques->ques_eng;
					$QuizData[$ques->ques_id]->refer_if = $ques->refer_if;
				}
				$result['quiz'] = array_values($QuizData);
			}
			$response = array("status" => 200, 
							"message" => "data found",
							"result" => $result);
		}else{
			$response = array("status" => 404, "message" => "child info and date not found");
		}
		return $response;
	}

	public function viewReport( $child_id = '', $date = ''){

		$result = $this->_getReport($child_id,$date);
		
		if($result['status'] == 200){
			
			$this->load->view('report_format',["result"=>$result['result']]);
		}else{
			$this->load->view('errors/html/error_404',array(
								'heading'=>'404 Not Found',
								'message'=>sprintf("Child Id '%s' And Date '%s' Not Found",$child_id,$date)
							));
		}
		
	}


	public function viewQuiz( $disease_type = -1, $age = -1 , $gender = 'male' ){


		$disease_type_arr = [
			'Defects at Birth',
			'Deficiencies',
			'Child hood Diseases',
			'Developmental delays and Disabilities'
		];
		if( $disease_type != -1 && isset($disease_type_arr[$disease_type]) ){
			$this->db->where('disease_type',$disease_type_arr[$disease_type]);
		}
		$res = $this->db->get('disease_questions');
		$this->load->helper('my_helper');
		$this->load->library('table');
		$template = array(
		        'table_open'            => '<table border="2" cellpadding="4" cellspacing="0">',

		        'thead_open'            => '<thead>',
		        'thead_close'           => '</thead>',

		        'heading_row_start'     => '<tr>',
		        'heading_row_end'       => '</tr>',
		        'heading_cell_start'    => '<th>',
		        'heading_cell_end'      => '</th>',

		        'tbody_open'            => '<tbody>',
		        'tbody_close'           => '</tbody>',

		        'row_start'             => '<tr>',
		        'row_end'               => '</tr>',
		        'cell_start'            => '<td>',
		        'cell_end'              => '</td>',

		        'row_alt_start'         => '<tr>',
		        'row_alt_end'           => '</tr>',
		        'cell_alt_start'        => '<td>',
		        'cell_alt_end'          => '</td>',

		        'table_close'           => '</table>'
		);
		$this->table->set_template($template);
		$this->table->set_heading('Sno', 'Disease Type', 'Disease', 'Question', 'Images', 'Expression');
        $sno = 0;
		foreach($res->result() as $row){
			
			$bool = evaluate( $row->expression , ['age'=>$age,'gender'=>$gender] );
			if($age == -1 || $bool){
				$image_tag = '';
				if(!empty($row->images)){
					$images = explode(',', $row->images);
					foreach($images as $image){
						$image_tag .= '<img src="'.urldecode(base_url('assets/images/disease/'.$row->disease.'/'.$image)).'" width="80px" height="80px" alt="No Image">';
					}
				}
				$this->table->add_row(++$sno, $row->disease_type, $row->disease, $row->ques_eng, $image_tag,$row->expression);

			}
		}
		echo $this->table->generate();
	}
}