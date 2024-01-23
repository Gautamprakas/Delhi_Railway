<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct(){
		parent::__construct();
		ini_set('memory_limit', '-1');
		
	}

	public function index(){
		$this->load->view('view/division_report');
	}

	public function generate_report($child_id = ''){
		$this->load->model('ScreeningModel');
		$this->ScreeningModel->getChildsScreeningDetail($child_id);
	}


	public function generate_trace4security_report(){

		ini_set('memory_limit', '-1');
		$form_id = 1589285939267;
		$district = array(
			"default"=>"auraiya",
			"etawah" => "etawah",
			"farukhabad" => "farukhabad",
			"kanpurdehat" => "kanpurdehat",
			"kanpurnagar" => "kanpurnagar"
		);
		$cron_id = date("Y-m-d H:i:s");
		$globaldb = $this->load->database('default',TRUE);
		$globaldb->truncate("form_trace4security_data_temp");
		$globaldb->truncate("form_trace4security_report_temp");

		foreach($district as $dbname => $district_name){

		    $this->db = $this->load->database($dbname,TRUE);

		    $form_title = $this->db->get_where("form_created",["form_id"=>$form_id])->row()->form_title;
		    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
		    $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id")
		                         ->where("form_id",$form_id)
		                         ->get('form_data');
		    $data = [];
		    $key_label = array();
		    $summary = [];

		    foreach($data_res->result() as $row){

		      if(!isset($data[$row->req_id])){
		        $res = $this->db->get_where('users',["username"=>str_replace('Web_','',$row->child_id)]);
		        $location_arr = explode("|", $res->row()->location);

		        foreach($key_res->result() as $col){
		          $data[$row->req_id][$col->field_id] = "";
		          $key_label[$col->field_id] = $col->field;
		        }
		        
		        $data[$row->req_id]["inserted"] = $row->create_datetime!="0000-00-00 00:00:00"?$row->create_datetime:"";
		        $data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
		        $data[$row->req_id]["geo_loc"] = $row->geo_loc;
		        $data[$row->req_id]["child_id"] = $res->row()->name." [".$res->row()->username."]";
		        $data[$row->req_id]["Tehsil"] = isset($location_arr[1])?$location_arr[1]:"";
		        $data[$row->req_id]["Block"] = isset($location_arr[2])?$location_arr[2]:"";
		        $data[$row->req_id]["Village"] = isset($location_arr[3])?$location_arr[3]:"";
		        $key_label["inserted"] = "Inserted";
		        $key_label["updated"] = "Updated";
		        $key_label["child_id"] = "Feeder";
		        $key_label["geo_loc"] = "Geo Location";
		        $key_label["Tehsil"] = "तहसील";
		        $key_label["Block"] = "ब्लॉक /  नगर पालिका";
		        $key_label["Village"] = "गाँव / वार्ड";
		        $key_label["class"] = "Filter";
		      }
		      $data[$row->req_id][$row->field_id] = $row->value;
		    }

		   
		    $today_normal = 0;
		    $today_warning = 0;
		    $total_normal = 0;
		    $total_warning = 0;
		    $total_arogay_setu_installed = 0;
		    $total_arogay_setu_not_installed = 0;
		    $total_home_quarantine_follow = 0;
		    $total_home_quarantine_not_follow = 0;
		    $today_arogay_setu_installed = 0;
		    $today_arogay_setu_not_installed = 0;
		    $today_home_quarantine_follow = 0;
		    $today_home_quarantine_not_follow = 0;

		    foreach($data as $index => $row){

		      $form_trace4security_data = [
		      	"req_id"=>$index,
		      	"name"=>$row["1589285939267_1"],
		      	"arogay_setu_installed"=>$row["1589285939267_10"],
		      	"cough"=>$row["1589285939267_11"],
		      	"fever"=>$row["1589285939267_12"],
		      	"difficulty_breathing"=>$row["1589285939267_13"],
		      	"cold"=>$row["1589285939267_14"],
		      	"home_quarantine"=>$row["1589285939267_15"],
		      	"ration_card"=>$row["1589285939267_16"],
		      	"mgnrega_job_card"=>$row["1589285939267_17"],
		      	"skill"=>$row["1589285939267_18"],
		      	"contact_with_corona_positive"=>$row["1589285939267_19"],
		      	"father_name"=>$row["1589285939267_2"],
		      	"address"=>$row["1589285939267_3"],
		      	"mobile"=>$row["1589285939267_7"],
		      	"return_from_district"=>$row["1589285939267_8"],
		      	"date_of_returning"=>$row["1589285939267_9"],
		      	"inserted"=>$row["inserted"],
		      	"updated"=>$row["updated"],
		      	"geo_loc"=>$row["geo_loc"],
		      	"feeder"=>$row["child_id"],
		      	"division"=>"auraiya",
		      	"district"=>$district_name,
		      	"tehsil"=>$row["Tehsil"],
		      	"block"=>$row["Block"],
		      	"village"=>$row["Village"],
		      	"datetime"=>date("Y-m-d H:i:s"),
		      	"cron_id"=>$cron_id
		      ];

		      $globaldb->insert("form_trace4security_data",$form_trace4security_data);
		      $globaldb->insert("form_trace4security_data_temp",$form_trace4security_data);

		      $data[$index]["class"] = "";

		      if(!isset($summary[$row["Block"]])){
		        $summary[$row["Block"]] = [
		          "total_normal"=>0,
		          "total_warning"=>0,
		          "total_arogay_setu_installed"=>0,
		          "total_arogay_setu_not_installed"=>0,
		          "total_home_quarantine_follow"=>0,
		          "total_home_quarantine_not_follow"=>0,
		          "today_normal"=>0,
		          "today_warning"=>0,
		          "today_arogay_setu_installed"=>0,
		          "today_arogay_setu_not_installed"=>0,
		          "today_home_quarantine_follow"=>0,
		          "today_home_quarantine_not_follow"=>0,
		        ];
		      }
		      if($row["1589285939267_11"]=="नहीं" && $row["1589285939267_12"]=="नहीं" && $row["1589285939267_13"]=="नहीं" && $row["1589285939267_14"]=="नहीं" && $row["1589285939267_19"]=="नहीं"){
		        $summary[$row["Block"]]["total_normal"] += 1;
		        $total_normal += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_normal ";
		        $data[$index]["class"] .= "Total-total_normal ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_normal"] += 1;
		          $today_normal += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_normal ";
		          $data[$index]["class"] .= "Total-today_normal ";
		        }
		      }else{
		        $summary[$row["Block"]]["total_warning"] += 1;
		        $total_warning += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_warning ";
		        $data[$index]["class"] .= "Total-total_warning ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_warning"] += 1;
		          $today_warning += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_warning ";
		          $data[$index]["class"] .= "Total-today_warning ";
		        }
		      }

		      if($row["1589285939267_10"]=="नहीं"){
		        $summary[$row["Block"]]["total_arogay_setu_not_installed"] += 1;
		        $total_arogay_setu_not_installed += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_arogay_setu_not_installed ";
		        $data[$index]["class"] .= "Total-total_arogay_setu_not_installed ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_arogay_setu_not_installed"] += 1;
		          $today_arogay_setu_not_installed += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_arogay_setu_not_installed ";
		          $data[$index]["class"] .= "Total-today_arogay_setu_not_installed ";
		        }
		      }else{
		        $summary[$row["Block"]]["total_arogay_setu_installed"] += 1;
		        $total_arogay_setu_installed += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_arogay_setu_installed ";
		        $data[$index]["class"] .= "Total-total_arogay_setu_installed ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_arogay_setu_installed"] += 1;
		          $today_arogay_setu_installed += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_arogay_setu_installed ";
		          $data[$index]["class"] .= "Total-today_arogay_setu_installed ";
		        }
		      }

		    if($row["1589285939267_15"]=="नहीं" ){
		        $summary[$row["Block"]]["total_home_quarantine_not_follow"] += 1;
		        $total_home_quarantine_not_follow += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_home_quarantine_not_follow ";
		        $data[$index]["class"] .= "Total-total_home_quarantine_not_follow ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_home_quarantine_not_follow"] += 1;
		          $today_home_quarantine_not_follow += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_home_quarantine_not_follow ";
		          $data[$index]["class"] .= "Total-today_home_quarantine_not_follow ";
		        }
		      }else{
		        $summary[$row["Block"]]["total_home_quarantine_follow"] += 1;
		        $total_home_quarantine_follow += 1;
		        $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-total_home_quarantine_follow ";
		        $data[$index]["class"] .= "Total-total_home_quarantine_follow ";
		        if( date("Y-m-d",strtotime($row["updated"])) == date("Y-m-d") || date("Y-m-d",strtotime($row["inserted"])) == date("Y-m-d") ){
		          $summary[$row["Block"]]["today_home_quarantine_follow"] += 1;
		          $today_home_quarantine_follow += 1;
		          $data[$index]["class"] .= str_replace(" ", "_", $row["Block"])."-today_home_quarantine_follow ";
		          $data[$index]["class"] .= "Total-today_home_quarantine_follow ";
		        }
		      }
		    }



		    $summary["Total"]["total_normal"] = $total_normal;
		    $summary["Total"]["total_warning"] = $total_warning;
		    $summary["Total"]["today_normal"] = $today_normal;
		    $summary["Total"]["today_warning"] = $today_warning;
		    $summary["Total"]["today_arogay_setu_installed"] = $today_arogay_setu_installed;
		    $summary["Total"]["today_arogay_setu_not_installed"] = $today_arogay_setu_not_installed;
		    $summary["Total"]["today_home_quarantine_follow"] = $today_home_quarantine_follow;
		    $summary["Total"]["today_home_quarantine_not_follow"] = $today_home_quarantine_not_follow;
		    $summary["Total"]["total_arogay_setu_installed"] = $total_arogay_setu_installed;
		    $summary["Total"]["total_arogay_setu_not_installed"] = $total_arogay_setu_not_installed;
		    $summary["Total"]["total_home_quarantine_follow"] = $total_home_quarantine_follow;
		    $summary["Total"]["total_home_quarantine_not_follow"] = $total_home_quarantine_not_follow; 

		    foreach($summary as $block_np => $row){
		    	$row["division"] = "auraiya";
		    	$row["district"] = $district_name;
		    	$row["block_np"] = $block_np;
		    	$row["datetime"] = date("Y-m-d H:i:s");
		    	$row["cron_id"]	 = $cron_id;
		    	$globaldb->insert("form_trace4security_report",$row);
		    	$globaldb->insert("form_trace4security_report_temp",$row);
		    }
		    unset($summary);
		    unset($data);
		    unset($key_label);
		    unset($data_res);
		    unset($key_res);
		}

	}


	public function combineFamilyRegisterReports(){

		$report = [];

		$db = $this->load->database("default",True);
		$this->load->helper("my");

		$db->where_in("form_id",[FMAILY_FROM_ID]);
		$formIdsRes = $db->get("form_created");
		$row = $formIdsRes->row();
		list($key_label,$data) = getFormData2($row->form_id,$row->form_for);
		$report[$row->form_id] = [
			"form_title" => $row->form_title,
			"form_id" => $row->form_id,
			"form_for" => $row->form_for,
			"key_label" => $key_label,
			"data" => $data
		];


		$db->where_in("form_id",[MEMBER_FROM_ID]);
		$formIdsRes = $db->get("form_created");
		$row = $formIdsRes->row();
		list($key_label,$data) = getFormData2($row->form_id,$row->form_for);
		$report[$row->form_id] = [
			"form_title" => $row->form_title,
			"form_id" => $row->form_id,
			"form_for" => $row->form_for,
			"key_label" => $key_label,
			"data" => $data
		];


		$db->where_not_in("form_id",[FMAILY_FROM_ID,MEMBER_FROM_ID]);
		$formIdsRes = $db->get("form_created");

		foreach($formIdsRes->result() as $row){
			list($key_label,$data) = getFormData2($row->form_id,$row->form_for);
			$report[$row->form_id] = [
				"form_title" => $row->form_title,
				"form_id" => $row->form_id,
				"form_for" => $row->form_for,
				"key_label" => $key_label,
				"data" => $data
			];
		}

		//echo "<pre>";
		//print_r($report);

		$report2 = ["key_label"=>[],"data"=>[]];
		$member_family_ids = [];

		$report2["key_label"] = array_merge($report[FMAILY_FROM_ID]["key_label"],$report[MEMBER_FROM_ID]["key_label"]);
		foreach($report[MEMBER_FROM_ID]["data"] as $index => $member_row){
			$family_id = $member_row["family_id"];
			$family_row = isset($report[FMAILY_FROM_ID]["data"][$family_id])?$report[FMAILY_FROM_ID]["data"][$family_id]:[];
			$report2["data"][$family_id] = $family_row;
			$report2["data"][$index] = array_merge($family_row,$member_row);
			$member_family_ids[] = $family_id;
		}

		foreach($report[FMAILY_FROM_ID]["data"] as $index => $family_row){
			$family_id = $family_row["family_id"];
			if( array_search($family_id,$member_family_ids) == FALSE ){
				$report2["data"][$family_id] = $family_row;
			}
		}
		//print_r($report2);

		unset($report[FMAILY_FROM_ID]);
		unset($report[MEMBER_FROM_ID]);

		foreach($report as $index => $rowset){
			$report2["key_label"] = array_merge($report2["key_label"],$rowset["key_label"]);
			foreach($rowset["data"] as $index => $row){
				if($rowset["form_for"]=="FAMILY"){
					$temp_row = isset($report2["data"][$index])?$report2["data"][$index]:[];
					$report2["data"][$index] = array_merge($temp_row,$row);
				}else if($rowset["form_for"]=="MEMBER"){
					if(substr($row["member_id"],0,4) == 'head' || $row["member_id"]=="null"){
						$temp_row = isset($report2["data"][$row["family_id"]])?$report2["data"][$row["family_id"]]:[];
						$report2["data"][$row["family_id"]] = array_merge($temp_row,$row);
					}else{
						$temp_row = isset($report2["data"][$index])?$report2["data"][$index]:[];
						$report2["data"][$index] = array_merge($temp_row,$row);
					}
				}
			}
		}
		
		//print_r($report2);

		$report3 = [];
		$sno1 = 0;
		foreach($report2["data"] as $index => $row){
			$header = $report2["key_label"];
			$firstflag = true;
			foreach($header as $key => $headtitle){
				if($firstflag){
					$report3[$index]['sno'] = ++$sno1;
				}
				$report3[$index][$headtitle] = isset($row[$key])?$row[$key]:'';
				$firstflag = false;
			}
		}

		//echo "final";
		//print_r($report3);
		$headflag = true;
		$thead = '';
		$tbody = '';
		$sno2 = 0;
		foreach($report3 as $index3 => $row3){
			$tbody .= '<tr>';
			$tbody .= '<td>'.(++$sno2).'</td>';
			if($headflag){
				$thead .= '<th>sno</th>';
			}
			foreach($row3 as $index => $value){
				if($headflag){
					$thead .= '<th>'.$index.'</th>';
				}
				$tbody .= '<td>'.$value.'</td>';
			}
			$tbody .= '</tr>';
			$headflag = false;

		}
		$table = '<table border="2"><tr>'.$thead.'</tr>'.$tbody.'</table>';

		//echo $table;

		header('Content-Type: text/csv; charset=utf-8');

		// Set the response header to specify that the file should be downloaded as an attachment
		$filename = sprintf("data_%s.csv",date("Y_m_d_H_i_s"));
		header('Content-Disposition: attachment; filename='.$filename);
		echo "\xEF\xBB\xBF"; // UTF-8 BOM

		// Open a file handle for writing
		$fp = fopen('php://output', 'w');

		fputcsv($fp, array_keys(current($report3)));
		// Write the data to the file
		foreach ($report3 as $row) {
		  fputcsv($fp, array_values($row));
		}

		// Close the file handle
		fclose($fp);

	}
}