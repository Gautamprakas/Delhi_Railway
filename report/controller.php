<?php
	include('dbconn.php');

	//$category = $_POST['category'];
	$func_name = $_POST['func_name'];
	//$disease_name = $_POST['disease_name'];

	if($func_name == "getPath"){
		$sql = "SELECT division,sum($category) as $category FROM map_data GROUP BY division";
		$result = mysqli_query($conn,$sql);

		$arr1 = array();
		while ($row = mysqli_fetch_array($result)){ 
		  $arr1[] = $row["$category"]; 
		  $arr2[] = $row["division"]; 
		}
		$k = array_search(max($arr1), $arr1);
		$max_key = $arr2[$k];
		$max_val = max($arr1);

		$sql2 = "SELECT path_id,label_no FROM mapping_division where division='$max_key'";
		$result2 = mysqli_query($conn,$sql2);

		$path = array();

		while ($row2 = mysqli_fetch_array($result2)){       
		  $path[] = $row2["path_id"];
		  $label  = $row2["label_no"];		
		}	

		$data['path'] = $path;
		$data['label'] = $label;
		$data['max_key'] = strtoupper($max_key);
		$data['max_val'] = $max_val;
		echo json_encode($data);
	}

	if( $func_name == "totalCount" ){
		$res = mysqli_query($conn,"SELECT sum(screened) as 'screened',sum(refer) as 'refer',sum(under_process) as 'under_process',sum(complete) as 'complete' FROM map_data");
		$row = mysqli_fetch_object($res);

		$res_diag = mysqli_query($connect_diag,"SELECT count(diagnosis) as count FROM child_info WHERE diagnosis!=0");
		$val = mysqli_fetch_object($res_diag);

		$screened = $row->screened+$val->count;		

		$data['screened'] = "$screened";
		$data['refer'] = $row->refer;
		$data['under_process'] = $row->under_process;
		$data['complete'] = $row->complete;
		echo json_encode($data);
	}

	if($func_name == "getPathDisease"){

		$disease_name = $_POST['disease_name'];

		$sql = "SELECT division,sum(refer) as refer FROM map_data WHERE disease='$disease_name' GROUP BY division";
		$result = mysqli_query($conn,$sql);

		$arr1 = array();
		while ($row = mysqli_fetch_array($result)){ 
		  $arr1[] = $row["refer"];
		  $arr2[] = $row["division"]; 
		}
		$k = array_search(max($arr1), $arr1);
		$max_key = $arr2[$k];
		$max_val = max($arr1);
		$sql2 = "SELECT path_id,label_no FROM mapping_division where division='$max_key'";
		$result2 = mysqli_query($conn,$sql2);

		$path = array();

		while ($row2 = mysqli_fetch_array($result2)){       
		  $path[] = $row2["path_id"];
		  $label  = $row2["label_no"];		
		}	

		$data['path'] = $path;
		$data['label'] = $label;
		$data['max_key'] = strtoupper($max_key);
		$data['max_val'] = $max_val;
		echo json_encode($data);
	}

	if($func_name == "getDisease"){
        $category = $_POST['category'];
		$sql3 = "SELECT DISTINCT diseases_name FROM diseases_type WHERE diseases_name!='diseases_name'";
		$result3 = mysqli_query($conn,$sql3);
		echo '<option value="-Select Disease Name-">-Select Disease Name-</option>';
		while ($row3 = mysqli_fetch_array($result3)){
			echo '<option value="'.$row3["diseases_name"].'">'.$row3["diseases_name"].'</option>';
		}
	}

	if($func_name == "getSkills"){
		$sql = "SELECT DISTINCT skill FROM map_data ORDER BY skill ASC";
		$result = mysqli_query($conn,$sql);
		echo json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));
	}

	if($func_name == "getExperience"){
		$skill = $_POST["skill"];
		$sql = "SELECT DISTINCT experience FROM map_data WHERE skill = '$skill' ORDER BY experience ASC";
		$result = mysqli_query($conn,$sql);
		echo json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));
	}

	if($func_name == "getDistrictReport"){

		$sql = "SELECT * FROM mapping_district";
		$result = mysqli_query($conn,$sql);
		$map = array();
		while ($row = mysqli_fetch_array($result)){       
		  $index = $row["division"].$row["district"];
		  $map[$index] = array("path_id"=>$row["path_id"],"color"=>$row["color"]);
		}

		$sql = "SELECT * FROM map_data ORDER BY district ASC";
		$result = mysqli_query($conn,$sql);
		$report = array();
		while ($row = mysqli_fetch_array($result)){       
		  $index = $row["division"].$row["district"];
		  if(!isset($report[$index])){
		  	$report[$index]["district"]	 = $row["district"];
		  	$report[$index]["below 15"]	 = 0;
		  	$report[$index]["15-24"]	 = 0;
		  	$report[$index]["25-54"]	 = 0;
		  	$report[$index]["55-64"]	 = 0;
		  	$report[$index]["above 64"]	 = 0;
		  	$report[$index]["path_id"]   = $map[$index]["path_id"];
		  	$report[$index]["color"]   = $map[$index]["color"];
		  }

		  if(isset($_POST["skill"]) && !empty($_POST["skill"]) && strcasecmp($_POST["skill"], $row["skill"]) != 0){
		  	continue;
		  }
		  if(isset($_POST["experience"]) && !empty($_POST["experience"]) && strcasecmp($_POST["experience"], $row["experience"]) != 0){
		  	continue;
		  }
		  if(isset($_POST["gender"]) && !empty($_POST["gender"]) && strcasecmp($_POST["gender"], $row["gender"]) != 0){
		  	continue;
		  }
		  $report[$index][$row["age"]] += $row["count"]; 
		  	
		}
		echo json_encode($report);
	}

	if($func_name == "getBlockReport"){
		$district = $_POST["district"];
		$sql = "SELECT * FROM map_data WHERE district = '$district' ORDER BY district ASC";
		$result = mysqli_query($conn,$sql);
		$report = array();
		while ($row = mysqli_fetch_array($result)){       
		  $index = $row["division"].$row["district"].$row["block"];
		  if(!isset($report[$index])){
		  	$report[$index]["block"]	 = $row["block"];
		  	$report[$index]["below 15"]	 = 0;
		  	$report[$index]["15-24"]	 = 0;
		  	$report[$index]["25-54"]	 = 0;
		  	$report[$index]["55-64"]	 = 0;
		  	$report[$index]["above 64"]	 = 0;
		  }

		  if(isset($_POST["skill"]) && !empty($_POST["skill"]) && strcasecmp($_POST["skill"], $row["skill"]) != 0){
		  	continue;
		  }
		  if(isset($_POST["experience"]) && !empty($_POST["experience"]) && strcasecmp($_POST["experience"], $row["experience"]) != 0){
		  	continue;
		  }
		  if(isset($_POST["gender"]) && !empty($_POST["gender"]) && strcasecmp($_POST["gender"], $row["gender"]) != 0){
		  	continue;
		  }
		  $report[$index][$row["age"]] += $row["count"]; 
		  	
		}
		echo json_encode($report);
	}

?>