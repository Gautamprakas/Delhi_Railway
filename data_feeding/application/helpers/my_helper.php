<?php

function getDiseaseUrls($disease, $images){
	$urls = [];
	if(!empty($images)){
		$imagesnames = explode(',', $images);
		foreach($imagesnames as $imagename){
			$urls[] = base_url("assets/images/disease/$disease/$imagename");
		}
	}
	return $urls;
}


function evaluate( $expression , $data ){
	foreach($data as $key => $value){
		$expression = str_replace($key, $value, $expression);
	}
	$a = false;
	eval("\$a = $expression;");
	return $a;
}



function httpPost($url, $data){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}



function sam( $data = null){
	
	$score = 0;

	if(empty($data)){
		return $score;
	}

	try{
		
		$age = null;
		$gender = null;
		$height = null;
		$weight = null;
		$mauc   = null;
		$head_circumference = null;

		foreach($data as $key => $value){
			if($key == "age"){
				$age = $value;
			}
			if($key == "gender"){
				$gender = $value;
			}
			if($key == "height"){
				$height = $value;
			}
			if($key == "weight"){
				$weight = $value;
			}
			if($key == "mauc"){
				$mauc = $value;
			}
			if($key == "head circumference"){
				$head_circumference = $value;
			}
		}

		$CI=&get_instance();
		$db = $CI->load->database("default",True);
		$res = $db->query("
			SELECT * FROM physical_indicators_for_growth
			WHERE gender = '$gender' AND (
				(input = 'age' AND input_value = '$age') OR
				(input = 'length' AND input_value = '$height')
			)
		");

		$io = [];
		foreach($res->result_array() as $value){
			$io[$value["indicator"]] = $value;
		}
		echo "<pre>";
		print_r($io);
		switch ($age) {
			case $age>=0&&$age<=6:
				if( $weight > $io["weight for age"]["-2sd"] ){
					//$score++;			
				}
				if( $weight <= $io["weight for age"]["-2sd"] && $weight > $io["weight for age"]["-3sd"] ){
					$score++;			
				}
				if( $weight <= $io["weight for age"]["-3sd"] ){
					$score++;			
				}
			break;

			case $age>6&&$age<=60:
				if( $weight > $io["weight for age"]["-2sd"] ){
					//$score++;			
				}
				if( $weight < $io["weight for age"]["-2sd"] ){
					if( $mauc < 11.5){
						$score++;
					}else{
						if( $weight > $io["weight for length"]["-2sd"] ){
							//$score++;			
						}
						if( $weight <= $io["weight for length"]["-2sd"] && $weight > $io["weight for length"]["-3sd"] ){
							$score++;			
						}
						if( $weight <= $io["weight for length"]["-3sd"] ){
							$score++;			
						}
					}
				}
				
				break;

			case $age>72&&$age<=216:
				$BMI = ($weight*100*100)/($height*$height);
				if( $BMI < $io["bmi for age"]["-3sd"] ){
					$score++;			
				}
				break;
			
			default:
				return $score;
				break;
		}

	}catch(Exception $e){
		return $score;
	}
	return $score;
}




function caseCompareIdPwd( $user_id1 , $password1 , $user_id2 , $password2){

	if( strcmp($user_id1,$user_id2)==0 && strcmp($password1, $password2)==0 )
        return true;
    else
        return false;
}


function getFormData( $form_id = '', $form_for = '', $req_form_id='' ){
	
	$CI=&get_instance(); 
	$db = $CI->load->database("default",True);
	
	$db->where("form_id",$form_id);
	$res = $db->get("form_data");
	
	$data = [];
	$key_label = [];

	foreach($res->result() as $row){
		if($form_for == 'FAMILY'){
			$index = $row->family_id;
		}else if($form_for == 'MEMBER'){
			$index = $row->member_id;
		}else{
			$index = $row->req_id;
		}
		if(!isset($data[$index])){
			$data[$index] = [];
		}
		$key_label[$row->field_id] = $row->field;
		$data[$index][$row->field_id] = $row->value;
		if( $req_form_id != FMAILY_FROM_ID ){
			$key_label["Railway_Status"] = "Railway_Status";
			$data[$index]["Railway_Status"] = $row->status;
		}
		$key_label["Work_Approved_Datetime"] = "Work Approved Datetime";
		$data[$index]["Work_Approved_Datetime"] = $row->approve_datetime;
		if(is_null($row->approve_id)){
			$data[$index]["approve_id"] ='';
		}else{
			$data[$index]["approve_id"] = $row->approve_id;
		}
		
	}
    return [$key_label,$data];
}


function getFormData2( $form_id = '', $form_for = '' ){
	
	$CI=&get_instance(); 
	$db = $CI->load->database("default",True);
	
	$db->where("form_id",$form_id);
	$res = $db->get("form_data");
	
	$data = [];
	$key_label = [];

	foreach($res->result() as $row){
		if($form_for == 'FAMILY'){
			$index = $row->family_id;
			if($form_id==MEMBER_FROM_ID){
				$index = $row->family_id."|".$row->member_id;
			}
		}else if($form_for == 'MEMBER'){
			$index = $row->family_id."|".$row->member_id;
		}else{
			$index = $row->req_id;
		}
		if(!isset($data[$index])){
			$data[$index] = [];
		}
		$key_label["family_id"] = "family_id";
		$key_label["member_id"] = "member_id";
		$key_label["location"] = "location";
		$key_label[$row->field_id] = $row->title."|".$row->field;
		
		$data[$index]["member_id"] = $row->member_id;
		$data[$index]["family_id"] = $row->family_id;
		$data[$index]["location"] = $row->location;
		$data[$index][$row->field_id] = $row->value;
	}
    return [$key_label,$data];
}


function getFormDataForApi( $form_id = '', $form_for = '' ){
	
	$CI=&get_instance(); 
	$db = $CI->load->database("default",True);
	
	$db->where("form_id",$form_id);
	$res = $db->get("form_data");
	
	$data = [];
	$key_label = [];

	foreach($res->result() as $row){
		if($form_for == 'FAMILY'){
			$index = $row->family_id;
		}else if($form_for == 'MEMBER'){
			$index = $row->member_id;
		}else{
			$index = $row->req_id;
		}
		if(!isset($data[$index])){
			$data[$index] = [];
		}
		$key_label[$row->field_id] = $row->field;
		$data[$index][$row->req_id][$row->field_id] = $row->value;
	}
	//print_r($data);
    return [$key_label,$data];
}



// function getWorkList( $form_id = '' ){
// 	$CI=&get_instance();
// 	$arr = [];
// 	$head = '';
// 	$arr[0] = $head;
// 	$flag = true;
// 	$res = $CI->db->distinct()->select("req_id")->get_where("form_data",["form_id"=>FMAILY_FROM_ID]);
// 	foreach($res->result() as $row){
// 		$res1 = $CI->db->get_where("form_data",["form_id"=>FMAILY_FROM_ID,"req_id"=>$row->req_id]);
// 		$arr[$row->req_id] = '';
		
// 		foreach($res1->result() as $row1){
// 			if($flag){
// 				$head .= $row1->field."|";
// 			}
// 			$arr[$row->req_id] .= sprintf("%s=%s|",$row1->field,$row1->value);
// 		}
// 		$flag = false;
// 	}
// 	$arr[0] = $head;
// 	return array_values($arr);
// }