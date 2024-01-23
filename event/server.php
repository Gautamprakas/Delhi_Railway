<?php

if( $_POST['req_type'] == 'fetch' ){
	$json = file_get_contents('data.json');
	if(!empty($json)){
		echo $json;
	}else{
		echo '[]';
	}
}else if( $_POST['req_type'] == 'save' ){
	$name = $_POST['name'];
	$date = $_POST['date'];
	$type = $_POST['type'];
	$everyYear = $_POST['everyYear'];
	$json = file_get_contents('data.json');
	$data = json_decode($json);
	$data[] = [
		"name" => $name,
		"date" => $date,
		"type" => $type,
		"everyYear" => $everyYear
	];
	file_put_contents('data.json',json_encode($data));
	echo '1';
}else{
	echo '0';
}