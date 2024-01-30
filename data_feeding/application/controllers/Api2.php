<?php

class Api2 extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
		$this->load->helper('my_helper');
	}


	public function index(){
		redirect(base_url("view/login"));
	}
	public function isWarranty(){
		$work=$this->input->post("work");
		$work_item=$this->input->post("work_item");
        $train_number=$this->input->post("train_number");
        $toilet_gallery_berth_no=$this->input->post("toilet_gallery_berth_no");
        $coach_number=$this->input->post("coach_number");
        $item_name='';
        if(!empty($work_item)){
        	$item_name=explode("|",$work_item)[0];
        }
		if(!empty($item_name)){
				$this->db->select("warranty_days");
				$this->db->where("item_name",$item_name);
			$query=$this->db->get("railway_work");
			$warrantyDay=$query->row_array();
		}else{
			$response['status']=200;
			$response['message']="No Data Found";
			echo json_encode($response);
			die();
		}
		$sql = 'SELECT family_id,DATE(create_datetime) as create_datetime FROM form_data WHERE family_id IN (SELECT family_id FROM form_data WHERE family_id IN (SELECT family_id FROM form_data WHERE family_id IN (SELECT family_id FROM form_data WHERE family_id IN (SELECT family_id FROM form_data WHERE field_id="1690365766_5" AND value= ?) AND  field_id="1690365766B_2" AND value= ?) AND field_id="1690365766_1" AND value=?) AND field_id="1690365766_4" AND value= ?) AND field_id="1690365766_2" AND value=?;';

		// $params=['42. Repair and fixing of AC attendant berth.@1000$W_Test101',"Flush Valve|Per Item Test","12015","Seat No.1","111571|Test Type 2"];
		$params=[$work,$work_item,$train_number,$toilet_gallery_berth_no,$coach_number];
		$query = $this->db->query($sql,$params);
		$result = $query->row_array();
		// echo "<pre>";
		// print_r($result);
		// die();
		if(!is_null($result)){
			$item_use_date=$result['create_datetime'];
			$warrantyInDay=(int)$warrantyDay['warranty_days'];
			$itemDate=new DateTime($result['create_datetime']);
			$currentDate=date('Y-m-d');
			$currentDate=new DateTime($currentDate);
			$interval=$currentDate->diff($itemDate);
			if($interval->days < $warrantyInDay){
				$remaining_days=$warrantyInDay-$interval->days;
				$warrantyStatus=1;
				$response['status']=200;
				$response['message']="success";
				$response['data']=array(
					"warranty_status"=>$warrantyStatus,
					"item_use_date"=>$item_use_date,
					"warranty_days"=>$warrantyInDay,
					"remaining_days"=>$remaining_days
				);
			}else if($interval->days > $warrantyInDay){
				$warrantyStatus=0;
				$response['status']=200;
				$response['message']="success";
				$response['data']=array(
					"warranty_status"=>$warrantyStatus,
					"item_use_date"=>$item_use_date,
					"warranty_days"=>$warrantyInDay,
					"remaining_days"=>0
				);
			}

		}else{
			$response['status']=200;
			$response['message']="No Data Found";
		}
		echo json_encode($response);
	}
	public function getDiseaseQuestions( $month = null, $gender = null ){
		$data = [];
		$genderArr = array('Male','Female');

		$res = $this->db->get('disease_questions');
		foreach($res->result() as $row){
			if(!isset($month)||!is_numeric($month)||evaluate($row->expression,["age"=>$month])){
				$data[$row->expression]['expression'] = $row->expression;
				$data[$row->expression]['form_json']['count']    = 1;
				$data[$row->expression]['form_json']['step1']    = 'step1';
				$data[$row->expression]['form_json']['title']    = '';
				$data[$row->expression]['form_json']['next']     = '';
				$data[$row->expression]['form_json']['fields'][] = array(
					"key" => $row->ques_id,
					'type' => 'radio',
					'label' => $row->ques_eng,
					'disease_type' => $row->disease_type,
					'disease' => $row->disease,
					'options' => array(array('key'=>'Yes','text'=>'Yes'),
										array('key'=>'No','text'=>'No')),
					'value' => $row->refer_if,
					'images' => getDiseaseUrls($row->disease, $row->images)
				);
			}
		}
		echo json_encode(array_values($data),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function uploadQuiz(){
		
		$response = array("status" => 400, "message" => "bad request");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('json','json','required');
		if( !$this->form_validation->run() ){
			$response = array("status" => 400, "message" => "json field required");
		} else {
			$json = json_decode($this->input->post('json'));
			if( json_last_error() != JSON_ERROR_NONE ){
				$response = array("status" => 400, "message" => "invalid json");
			}else{
				try{
					/*Child Info Start*/
					$ChildInfo = $json->child_info;
					$ChildId   = $ChildInfo->child_id;
					$Search = array(
						'child_id'	=> $ChildId,
						'child_name' => $ChildInfo->name,
						'mother_name' => $ChildInfo->mother_name,
						'father_name' => $ChildInfo->father_name,
						'child_age_in_months' => $ChildInfo->age_in_months,
						'weight_in_kg' => $ChildInfo->weight_in_kg,
						'height_in_cm' => $ChildInfo->height_in_cm,
						'gender'	   => $ChildInfo->gender,
						'record_datetime' =>  date("Y-m-d H:i:s",$ChildInfo->record_datetime/1000)
					);
					$res = $this->db->get_where('child_info',["child_id"=>$ChildId]);
					if($res->num_rows()==0){
						$this->db->insert('child_info',$Search);
					}else{
						$ChildId = $res->row()->child_id;
					}
					$response = array("status" => 200, "message" => 'child info added');
					/*Child Info End*/
					
					/*Quiz Start*/
					$Quiz     = $json->quiz;
					$QuizData = [];
					$ManualDiagnosis = [];
					$flag     = True;
					foreach ($Quiz->data as $key => $value) {

						if($value->decide == 0){  //Quiz
							$Search = array(
								'child_id'=> $ChildId,
								'ques_id' => $value->ques_id,
								'ans'	  => $value->ans=="yes"?100:0,
								'record_datetime' => date("Y-m-d H:i:s",$Quiz->record_datetime/1000)
							);
							$res = $this->db->get_where('child_ques_ans',$Search);
							if($res->num_rows()>0){
								/*$response = array("status" => 400, "message" => 'already exist');
								$flag = False;
								break;*/
							}else{
								$QuizData[] = $Search;
							}
							
						}

						if($value->decide == 1){  //Manual Diagnosis
							$Search = array(
								'child_id'    => $ChildId,
								'disease'	  => $value->ans,
								'record_datetime' => date("Y-m-d H:i:s",$Quiz->record_datetime/1000)
							);
							$res = $this->db->get_where('manual_diagnosis',$Search);
							if($res->num_rows()>0){
								/*$response = array("status" => 400, "message" => 'already exist');
								$flag = False;
								break;*/
							}else{
								$ManualDiagnosis[] = $Search;
							}
							
						}

						
					}
					if($flag){
						if(count($QuizData)>0){
							$this->db->insert_batch('child_ques_ans',$QuizData);
						}
						if(count($ManualDiagnosis)>0){
							$this->db->insert_batch('manual_diagnosis',$ManualDiagnosis);
						}
						$this->db->where("child_id",$ChildId)->update("child_info",["quiz"=>1]);
						$response = array("status" => 200, "message" => 'quiz added');
					}
					/*Quiz End*/


				}catch(Exception $e){
					$response = array("status" => 400, "message" => $e->getMessage());
				}
			}
		}
		echo json_encode($response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		
	}


	public function uploadMediaUrls(){

		$response = array("status" => 400, "message" => "bad request");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('json','json','required');
		if( !$this->form_validation->run() ){
			$response = array("status" => 400, "message" => "json field required");
		} else {
			$json = json_decode($this->input->post('json'));
			if( json_last_error() != JSON_ERROR_NONE ){
				$response = array("status" => 400, "message" => "invalid json");
			}else{
				try{
					/*Child Info Start*/
					$ChildInfo = $json->child_info;
					$ChildId   = $ChildInfo->child_id;
					$Search = array(
						'child_id'	=> $ChildId,
						'child_name' => $ChildInfo->name,
						'mother_name' => $ChildInfo->mother_name,
						'father_name' => $ChildInfo->father_name,
						'child_age_in_months' => $ChildInfo->age_in_months,
						'weight_in_kg' => $ChildInfo->weight_in_kg,
						'height_in_cm' => $ChildInfo->height_in_cm,
						'gender'	   => $ChildInfo->gender,
						'record_datetime' => date("Y-m-d H:i:s",$ChildInfo->record_datetime/1000)
					);
					$res = $this->db->get_where('child_info',["child_id"=>$ChildId]);
					if($res->num_rows()==0){
						$this->db->insert('child_info',$Search);
					}else{
						$ChildId = $res->row()->child_id;
					}
					$response = array("status" => 200, "message" => 'child info added');
					/*Child Info End*/
					
					/*Media Start*/
					$Media     = $json->media;
					$MediaData = [];
					$flag     = True;
					foreach ($Media->data as $key => $value) {
						$Search = array(
							'child_id'=> $ChildId,
							'label' => $value->label,
							'media_type' => $value->media_type,
							'media_url'	=> $value->filename,
							'record_datetime' => date("Y-m-d H:i:s",$Media->record_datetime/1000)
						);
						$res = $this->db->get_where('child_media',$Search);
						if($res->num_rows()>0){
							$response = array("status" => 400, "message" => 'already exist');
							$flag = False;
							break;
						}
						$MediaData[] = $Search;
					}
					if($flag){
						$this->db->insert_batch('child_media',$MediaData);
						$this->db->where("child_id",$ChildId)->update("child_info",["media_url"=>1]);
						$response = array("status" => 200, "message" => 'media added');
					}
					/*Media End*/


				}catch(Exception $e){
					$response = array("status" => 400, "message" => $e->getMessage());
				}
			}
		}
		echo json_encode($response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}


	public function uploadFile(){

		$filekey = 'file';
		$file_name = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';

		$res = $this->db->get_where('child_media',['media_url'=>$file_name]);
		if($res->num_rows() > 0){
			$row = $res->row();
			$loaction = sprintf('assets/%s/%s/%s/',$row->media_type,$row->child_id,$row->label);
			if (!is_dir($loaction)) {
			    mkdir($loaction, 0775, TRUE);
			}
			$config["upload_path"]   = realpath(APPPATH.'../'.$loaction);
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|doc|pdf|mp4|mp3|3gp|zip|db';
			$config["file_name"]     = $file_name;
			$config['max_size']	     = 0;

			$this->load->library('upload', $config);
			if( !$this->upload->do_upload($filekey) ){
				$response["status_code"]  = "400";
				$response["message"]      = "File Not Uploaded";
				$response["result"]       = ["error"=>$this->upload->display_errors(),
												"file"=>$_FILES['file']];
			}else{
				$this->db->where("media_url",$file_name)->update("child_media",["online"=>1]);
				if( $this->db->get_where("child_media",["child_id"=>$row->child_id,"online"=>0])->num_rows() == 0 ){
					$this->db->where("child_id",$row->child_id)->update("child_info",["media"=>1]);
				}
				$response["status_code"]  = "200";
				$response["message"]      = "File Uploaded Successfully..";
				$response["result"]       = ["file_name"=>$file_name];
			}
		}else{
			$response["status_code"]  = "400";
			$response["message"]      = "File Not Uploaded";
			$response["result"]       = ["error"=>"filename not exist. first upload filename",
										"file"=>$_FILES['file']];
		}
		
        echo json_encode($response);
	}

	public function getFormTitle(){
		//$res = $this->db->order_by("create_datetime","DESC")->get("form_created");
		$res = $this->db->where_in("form_id",[FMAILY_FROM_ID,SELECT_ITEMS_FOR_WORK,USER_WORK_DONE_ACTION])->order_by("order","ASC")->get("form_created");
		echo json_encode($res->result());
	}

	public function fromSchema(){
		$form_id = $this->input->post("form_id");
		$login = $this->input->post("login");
		$json_file = sprintf("./application/questions/form/%s.json",$form_id);
		$str = file_get_contents($json_file);

		$form_data = json_decode($str,true);
		foreach($form_data["step1"]["fields"] as $index => $field){
			if($field["key"]==TRAIN_NUMBER_FIELD_ID){
	            $train_numbers = ["Train Number*"];
	            $res = $this->db->where("username",$login)->get("railway_mapping");
	            foreach($res->result() as $row){
	                $train_numbers[] = $row->train_number;
	            }
	            $form_data["step1"]["fields"][$index]["values"] = $train_numbers;
	        }
		}
		echo json_encode($form_data);
	}

	public function updateformschema(){
		$this->load->helper('form_elements');
		$form_id = $this->input->post("form_id");
		$req_id  = $this->input->post('req_id');
		$family_id  = $this->input->post('family_id');
		$member_id  = $this->input->post('member_id');
		$form_data = update_form_ui2($this,$req_id,$form_id,$family_id,$member_id);
		echo json_encode($form_data);
	}

	public function trains(){
		$this->db->select("train_number");
		$this->db->from("railway_trains");
		$query=$this->db->get();
		$data=$query->result_array();
		$trainNumbers=[];
		foreach($data as $row){
			$trainNumbers[]=$row['train_number'];


		}
		$jsonResponse=["Train numbers"=>$trainNumbers];

		echo json_encode($jsonResponse);
	}
	public function uploadFormData(){

		$form_id = $this->input->post("form_id");
		$family_id = $this->input->post("family_id");
		$member_id = $this->input->post("member_id");
		$child_id = $this->input->post("child_id");
		$datetime = $this->input->post("datetime");
		$geo_loc = $this->input->post("geo_loc");
		$location = $this->input->post("location");
		$form_data_json = $this->input->post("form_data");
		$req_id = uniqid(rand(10000,99999),true);

		$form_data = json_decode($form_data_json);
		if(json_last_error() == JSON_ERROR_NONE){

			$res = $this->db->get_where("form_created",["form_id"=>$form_id]);
			if($res->num_rows()>0){
				$data =  array();
				$user_res = $this->db->get_where("users",["username"=>$child_id]);
				//$location = $user_res->num_rows()>0 ? $user_res->row()->location : '';
				$dept = $res->row()->dept;
				$form_for = $res->row()->form_for;
				$form_title = $res->row()->form_title;
				foreach($form_data->step1->fields as $index => $field){
					switch ($field->type) {
	                    case 'edit_text':
	                    		$data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'spinner':
	                        $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'check_box':
	                    	$arr = [];
	                    	foreach($field->options as $val){
	                    		if($val->value=="true"){
	                    			$arr[] = $val->text;
	                    		}
	                    	}
	                    	$data[] = array(
		                    			"req_id" => $req_id,
		                    			"child_id" => $child_id,
		                    			"form_id" => $form_id,
		                    			"field_id" => $field->key,
		                    			"title"	=> $form_title,
		                    			"field"	=> $field->label,
		                    			"field_type" => $field->type,
		                    			"value" => implode(",", $arr),
		                    			"geo_loc" => $geo_loc,
		                    			"create_datetime" => $datetime,
		                    			"update_datetime" => $datetime,
		                    			"family_id" => $family_id,
		                    			"member_id" => $member_id,
		                    			"location" => $location,
		                    			"dept" => $dept,
		                    			"form_for" => $form_for
		                    		);
	                        break;

	                    case 'radio':
		                    $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->label,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;


	                    case 'choose_image':
		                    $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->uploadButtonText,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'date_picker':
	                    		$data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    // case 'label':
	                    // 		$data[] = array(
	                    // 			"req_id" => $req_id,
	                    // 			"child_id" => $child_id,
	                    // 			"form_id" => $form_id,
	                    // 			"field_id" => $field->key,
	                    // 			"title"	=> $form_title,
	                    // 			"field"	=> $field->text,
	                    // 			"field_type" => $field->type,
	                    // 			"value" => '--',
	                    // 			"geo_loc" => $geo_loc,
	                    // 			"create_datetime" => $datetime
	                    // 		);
	                    //     break;
	                    
	                    default:
	                        # code...
	                        break;
	                }
				}
				$this->db->insert_batch("form_data",$data);
				$response["status"] = 200;
				$response["msg"] = "success";
				$response["result"] = ["child_id"=>$child_id,"datetime"=>$datetime];
			}else{
				$response["status"] = 400;
				$response["msg"] = "invalid form id";
				$response["result"] = null;
			}
			
		}else{
			$response["status"] = 400;
			$response["msg"] = "1 invalid json";
			$response["result"] = null;
		}

		echo json_encode($response);
		
	}


	// public function updateFormData(){

	// 	$req_id = $this->input->post("req_id");
	// 	$datetime = $this->input->post("datetime");
	// 	$geo_loc = $this->input->post("geo_loc");
	// 	$form_data_json = $this->input->post("form_data");

	// 	$form_data = json_decode($form_data_json);
	// 	if(json_last_error() == JSON_ERROR_NONE){

	// 		$res = $this->db->get_where("form_data",["req_id"=>$req_id]);
	// 		if($res->num_rows()>0){
	// 			$data =  array();
	// 			foreach($form_data->step1->fields as $index => $field){
	// 				switch ($field->type) {
	
	//                     case 'radio':
		                   
	// 	                    $this->db->trans_start();
	// 	                    foreach($field->options as $index2 => $option){
	// 	                    	$this->db->where("req_id",$req_id);
	// 	                    	$this->db->where("field_id",$field->key);
	// 	                    	$this->db->update("form_data",["value"=>$field->value,"geo_loc"=>$geo_loc,"update_datetime"=>$datetime]);
	// 	                    }
	// 	                    $this->db->trans_complete();
	//                         break;
	                    
	//                     default:
	//                         break;
	//                 }
	// 			}
	// 			$response["status"] = 200;
	// 			$response["msg"] = "success";
	// 			$response["result"] = ["req_id"=>$req_id,"datetime"=>$datetime];
	// 		}else{
	// 			$response["status"] = 400;
	// 			$response["msg"] = "invalid req id";
	// 			$response["result"] = null;
	// 		}
			
	// 	}else{
	// 		$response["status"] = 400;
	// 		$response["msg"] = "1 invalid json";
	// 		$response["result"] = null;
	// 	}

	// 	echo json_encode($response);
		
	// }

	public function updateFormData(){

		$form_id = $this->input->post("form_id");
		$family_id = $this->input->post("family_id");
		$member_id = $this->input->post("member_id");
		$child_id = $this->input->post("child_id");
		$datetime = $this->input->post("datetime");
		$geo_loc = $this->input->post("geo_loc");
		$location = $this->input->post("location");
		$form_data_json = $this->input->post("form_data");
		$req_id = $this->input->post("req_id");

		$form_data = json_decode($form_data_json);
		if(json_last_error() == JSON_ERROR_NONE){

			$res = $this->db->get_where("form_created",["form_id"=>$form_id]);
			if($res->num_rows()>0){
				$data =  array();
				$user_res = $this->db->get_where("users",["username"=>$child_id]);
				//$location = $user_res->num_rows()>0 ? $user_res->row()->location : '';
				$dept = $res->row()->dept;
				$form_for = $res->row()->form_for;
				$form_title = $res->row()->form_title;
				foreach($form_data->step1->fields as $index => $field){
					switch ($field->type) {
	                    case 'edit_text':
	                    		$data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'spinner':
	                        $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'check_box':
	                    	$arr = [];
	                    	foreach($field->options as $val){
	                    		if($val->value=="true"){
	                    			$arr[] = $val->text;
	                    		}
	                    	}
	                    	$data[] = array(
		                    			"req_id" => $req_id,
		                    			"child_id" => $child_id,
		                    			"form_id" => $form_id,
		                    			"field_id" => $field->key,
		                    			"title"	=> $form_title,
		                    			"field"	=> $field->label,
		                    			"field_type" => $field->type,
		                    			"value" => implode(",", $arr),
		                    			"create_datetime" => $datetime,
		                    			"update_datetime" => $datetime,
		                    			"family_id" => $family_id,
		                    			"member_id" => $member_id,
		                    			"location" => $location,
		                    			"dept" => $dept,
		                    			"form_for" => $form_for
		                    		);
	                        break;

	                    case 'radio':
		                    $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->label,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;


	                    case 'choose_image':
		                    $data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->uploadButtonText,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    case 'date_picker':
	                    		$data[] = array(
	                    			"req_id" => $req_id,
	                    			"child_id" => $child_id,
	                    			"form_id" => $form_id,
	                    			"field_id" => $field->key,
	                    			"title"	=> $form_title,
	                    			"field"	=> $field->hint,
	                    			"field_type" => $field->type,
	                    			"value" => $field->value,
	                    			"geo_loc" => $geo_loc,
	                    			"create_datetime" => $datetime,
	                    			"update_datetime" => $datetime,
	                    			"family_id" => $family_id,
	                    			"member_id" => $member_id,
	                    			"location" => $location,
	                    			"dept" => $dept,
	                    			"form_for" => $form_for
	                    		);
	                        break;

	                    // case 'label':
	                    // 		$data[] = array(
	                    // 			"req_id" => $req_id,
	                    // 			"child_id" => $child_id,
	                    // 			"form_id" => $form_id,
	                    // 			"field_id" => $field->key,
	                    // 			"title"	=> $form_title,
	                    // 			"field"	=> $field->text,
	                    // 			"field_type" => $field->type,
	                    // 			"value" => '--',
	                    // 			"geo_loc" => $geo_loc,
	                    // 			"create_datetime" => $datetime
	                    // 		);
	                    //     break;
	                    
	                    default:
	                        # code...
	                        break;
	                }
				}
				if($form_id==USER_WORK_DONE_ACTION){
					$this->db->insert_batch("form_data",$data);
					$this->db->where("family_id",$family_id)->update("form_data",["work_done_datetime"=>$datetime]);
				}else{
					$this->db->insert_batch("form_data_update",$data);
				}
				
				$response["status"] = 200;
				$response["msg"] = "success";
				$response["result"] = ["child_id"=>$child_id,"datetime"=>$datetime];
			}else{
				$response["status"] = 400;
				$response["msg"] = "invalid form id";
				$response["result"] = null;
			}
			
		}else{
			$response["status"] = 400;
			$response["msg"] = "1 invalid json";
			$response["result"] = null;
		}

		echo json_encode($response);
		
	}




	public function upload_dynamic_form_files(){

		$filekey = 'file';
		$form_id = $this->input->post('form_id');
		$field_id = $this->input->post('field_id');
		$child_id = $this->input->post('child_id');
		$file_name = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';

		if( !empty($file_name) && !empty($form_id) && !empty($field_id) && !empty($child_id) ){
			$loaction = sprintf('assets/dynamic_form_files/%s/%s/%s/',$child_id,$form_id,$field_id);
			if (!is_dir($loaction)) {
			    mkdir($loaction, 0775, TRUE);
			}
			$config["upload_path"]   = realpath(APPPATH.'../'.$loaction);
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|doc|pdf|mp4|mp3|3gp|zip|db';
			$config["file_name"]     = $file_name;
			$config['max_size']	     = 102400;

			$this->load->library('upload', $config);
			if( !$this->upload->do_upload($filekey) ){
				$response["status_code"]  = "400";
				$response["message"]      = "File Not Uploaded";
				$response["result"]       = ["error"=>$this->upload->display_errors(),
												"file"=>$_FILES['file']];
			}else{
				$response["status_code"]  = "200";
				$response["message"]      = "File Uploaded Successfully..";
				$response["result"]       = ["file_name"=>$file_name];
			}
		}else{
			$response["status_code"]  = "400";
			$response["message"]      = "File Not Uploaded";
			$response["result"]       = ["error"=>"form id, field id, child id or filename not exist."];
		}
		
        echo json_encode($response);

	}



	public function fetch_dynamic_data(){

		ini_set('memory_limit', '-1');

		$report = $this->input->post('report');

		if( $report == 'family_members_details' ){
			$form_id = [MEMBER_FROM_ID,FMAILY_FROM_ID];
			$family_id = $this->input->post('family_id');
			$id = $this->input->post('child_id');
		}else if( $report == 'family_details' ){
			$form_id = [FMAILY_FROM_ID];
			$id = $this->input->post('child_id');
		}else{
			$form_id = $this->input->post('form_id');
			$id = $this->input->post('child_id');
		}


		$this->db = $this->load->database("default",TRUE);
		$user_row = $this->db->get_where("users",["username"=>$id])->row();
		$location_arr2 = explode(",",$user_row->location);
		$where_location = "";
		foreach($location_arr2 as $index => $location2){
			if(count($location_arr2)==$index+1){
				$where_location .= "location like '$location2%'";
			}else{
				$where_location .= "location like '$location2%' OR ";
			}
		}
		
		//$key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);

		if( $report == 'family_members_details' ){
			$form_title = $this->db->get_where("form_created",["form_id"=>$form_id[0]])->row()->form_title;
			$key_res = $this->db->select("field,field_id")
								->where_in("form_id",$form_id)
								->group_by("field_id")
								->order_by("field_id")
								->get("form_data");
			$data_res = $this->db->where_in("form_id",$form_id)
								 ->where("family_id",$family_id)
								 ->where("work_done_datetime",null)
								 ->order_by("update_datetime","DESC")
                            	 ->get('form_data');
		}else if( $report == 'family_details' ){
			$form_title = $this->db->get_where("form_created",["form_id"=>$form_id[0]])->row()->form_title;
			$key_res = $this->db->select("field,field_id")
								->where_in("form_id",$form_id)
								->group_by("field_id")
								->order_by("field_id")
								->get("form_data");
			if( $user_row->type == "user" ){
      
		      	$train_numbers = [];
		      	$res2 = $this->db->where("username",$id)->get("railway_mapping");
	            foreach($res2->result() as $row){
	                $train_numbers[] = $row->train_number;
	            }
	            $train_numbers = implode(",",$train_numbers);
	            $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
		      	$wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);

		        $data_res = $this->db->where_in("form_id",$form_id)
		        				//->where("$wherestr",null)
		        				->where("child_id",$id)
								->where("$where_location",null)
								->where("work_done_datetime",null)
								->order_by("update_datetime","DESC")
                            	 ->get('form_data');

		    }else{
		    	$data_res = $this->db->where_in("form_id",$form_id)
								->where("$where_location",null)
								->where("work_done_datetime",null)
								->order_by("update_datetime","DESC")
                            	 ->get('form_data');
		    }
			
		}else{
			$form_title = $this->db->get_where("form_created",["form_id"=>$form_id])->row()->form_title;
			$key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
			$data_res = $this->db->where("form_id",$form_id)
	                         	 ->where("$where_location",null)
	                         	 ->where("work_done_datetime",null)
	                         	 ->order_by("update_datetime","DESC")
                            	 ->get('form_data');
		}

		$this->load->helper("my");
	    list($key_label2,$data2) = getFormDataForApi(SELECT_ITEMS_FOR_WORK,"FAMILY");
	    
	    
		$data = [];
		$key_label = array();

		foreach($data_res->result() as $row){

			if(!isset($data[$row->req_id])){

				// $res = $this->db->get_where('users',["username"=>str_replace('Web_','',$row->child_id)]);
				// $location_arr = explode("|", $res->row()->location);
				$location_arr = explode("|", $row->location);
				
				foreach($key_res->result() as $col){
					$data[$row->req_id][$col->field_id] = "";
					$key_label[$col->field_id] = $col->field;
				}
				
				//$data[$row->req_id]["inserted"] = $row->create_datetime!="0000-00-00 00:00:00"?$row->create_datetime:"";
				$data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
       			//$data[$row->req_id]["geo_loc"] = $row->geo_loc;
				//$data[$row->req_id]["child_id"] = $res->row()->name." [".$res->row()->username."]";
				//$data[$row->req_id]["Tehsil"] = isset($location_arr[1])?$location_arr[1]:"";
       			$data[$row->req_id]["Block"] = isset($location_arr[2])?$location_arr[2]:"";
        		$data[$row->req_id]["Village"] = isset($location_arr[3])?$location_arr[3]:"";
        		$data[$row->req_id]["family_id"] = $row->family_id;
        		$data[$row->req_id]["member_id"] = $row->member_id;
        		$data[$row->req_id]["form_id"] = $row->form_id;
        		$data[$row->req_id]["railway_status"] = $row->status;
        		$data[$row->req_id]["work_approved_datetime"] = $row->approve_datetime;

        		$sno2=0;
		        if(isset($data2[$row->family_id])){
		        	
		            foreach($data2[$row->family_id] as $req_id2 => $arr2){
		            	$sno2++;
		            	foreach($arr2 as $field_id2 => $value2){
		            		$data[$row->req_id][$sno2.$field_id2] = $value2;
		            	}
		            }
		        }

				//$key_label["inserted"] = "Inserted";
				$key_label["updated"] = "Work Entry";
				//$key_label["child_id"] = "Feeder";
        		//$key_label["geo_loc"] = "Geo Location";
        		//$key_label["Tehsil"] = "तहसील";
      			$key_label["Block"] = "ब्लॉक /  नगर पालिका";
        		$key_label["Village"] = "गाँव / वार्ड";
        		$key_label["family_id"] = "Family Id";
				$key_label["member_id"] = "Member Id";
				$key_label["form_id"] = "Form Id";
				$key_label["railway_status"] = "Railway Status";
				$key_label["work_approved_datetime"] = "Work Approved";

				for($i=1;$i<=$sno2;$i++){
		        	foreach($key_label2 as $field_id2 => $field2){
		            	$key_label[$i.$field_id2] = $i.".) ".$field2;
		          	}
		        }
			}
			$data[$row->req_id][$row->field_id] = $row->value;
		}

		//print_r($key_label);
		//print_r($data);

		$i=0; 
		$report = array();
		foreach($data as $req_id => $row){ 
                foreach( $key_label as $key => $key_val){ 
                     $report[$i]["req_id"] = $req_id;
                     if(isset($row[$key])){
                     	$report[$i][$key_val] = isset($row[$key])?$row[$key]:'';
                     }
                }
                $i++;
         }
		echo json_encode($report);

	}
	//ini_set('memory_limit', '-1');
	public function railwayAppDropDown(){
		$this->load->helper('form_elements');
		$login = $this->input->post("login");
		$data=[];
		//START//
		$train_numbers = [];
		$coach_numbers=[];
		$work_name=[];
		$berth=[];
		$work_status=[];
		$work_category=[];
		$item_name=[];
		$this->db->select("train_number");
		$res1=$this->db->get("railway_trains");
		$train_numbers=$res1->result_array();

		$this->db->select("coach_number,coach_category");
		$res2=$this->db->get("railway_coach");
		$coach_numbers=$res2->result_array();

		$this->db->select("work_name,work_rate,work_category,work_code,item_name,uom");
		$res5=$this->db->get("railway_work");
		$work_name=$res5->result_array();
		$newWorkList=array();
		foreach($work_name as $row){
			$newWorkList[]=array(
				"work_category" => $row['work_category'],
                "work" => $row['work_name']."@".$row['work_rate']."$".$row['work_code'],
				"work_item" => $row['item_name']."|".$row['uom']

			);
		}
		

		$this->db->select("status");
		$res6=$this->db->get("railway_work_status");
		$work_status=$res6->result_array();

		$this->db->select("berth");
		$res7=$this->db->get("railway_berth");
		$berth=$res7->result_array();
		$train=[];
		$eachBerth=[];
		$eachCoach=[];
		$work_status_array=[];
		foreach($work_status as $row){
			$work_status_array[]=$row['status'];
		}
		$coach_locations=["Yard","Stick Line"];
		foreach($train_numbers as $train_number){
			$train[]=$train_number['train_number'];
		}
		foreach($berth as $Berth){
			$eachBerth[]=$Berth['berth'];
		}
		foreach($coach_numbers as $Coach){
			$eachCoach[]=$Coach['coach_number']."|".$Coach['coach_category'];
		}

		$maxCount=max(count($train),count($eachCoach),count($work_name),count($work_status_array),count($eachBerth),count($coach_locations));
		$countWork=0;
		$tr=0;
		$ch=0;
		$br=0;
		$ch_loc=0;
		$cl=0;
		$st=0;

		$newWorkListRepeated=array();
		for ($i=0; $i <$maxCount ; $i++) { 
			if(count($train)>$tr){
				$local_train=$train[$tr];
			}else{
				$tr=0;
				$local_train=$train[$tr];
			}
			if(count($eachCoach)>$ch){
				$local_Coach=$eachCoach[$ch];
			}else{
				$ch=0;
				$local_Coach=$train[$eachBerth];
			}
			if(count($eachBerth)>$br){
				$local_berth=$eachBerth[$br];
			}else{
				$br=0;
				$local_berth=$eachBerth[$br];
			}
			if(count($coach_locations)>$cl){
			$local_coach_location=$coach_locations[$cl];
			}else{
				$cl=0;
				$local_coach_location=$coach_locations[$cl];
			}
			if(count($work_status_array)>$st){
			$local_work_status=$work_status_array[$st];
			}else{
				$st=0;
				$local_work_status=$work_status_array[$st];
			}
			if(count($newWorkList)>$countWork){
				$newWorkListRepeated[]=array(
					 "sno" => $i,
                     "work_category" => $newWorkList[$countWork]['work_category'],
                     "work" => $newWorkList[$countWork]['work'],
                     "work_item" => $newWorkList[$countWork]['work_item'],
                     "train_number"=>$local_train,
                     "toilet_gallery_berth_no"=>$local_berth,
                     "coach_number"=>$local_Coach,
                     "work_status"=>$local_work_status,
                     "coach_location"=>$local_coach_location

				);
			}else{
				$countWork=0;
				$newWorkListRepeated[]=array(
					"sno" => $i+1,
                     "work_category" => $newWorkList[$countWork]['work_category'],
                     "work" => $newWorkList[$countWork]['work'],
                     "work_item" => $newWorkList[$countWork]['work_item'],
                     "train_number"=>$local_train,
                     "toilet_gallery_berth_no"=>$local_berth,
                     "coach_number"=>$local_Coach,
                     "work_status"=>$local_work_status,
                     "coach_location"=>$local_coach_location

				);
			}
			$countWork+=1;
			$ch+=1;
			$br+=1;
			$tr+=1;
			$st+=1;
			$cl+=1;
			


			
		}
		$noData=[];
		$noData['train_number']=$train;
		$noData['coach_number']=$eachCoach;
		$noData['toilet_gallery_berth_no']=$eachBerth;
		// $noData['data']=$data_mapping;
		$response["status_code"]  = "200";
		$response["message"]      = "Data Fetched Successfully..";
		$response["result"]       = $newWorkListRepeated;
		$response["data"]		  =	$noData;
		echo json_encode($response);

	}

}