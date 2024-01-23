<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateForm extends CI_Controller {


	public function __construct(){

		parent::__construct();
		$this->load->library('session');
		if( ! $this->isLogin() )  
			redirect('view/Login');
	}


	private function isLogin(){
        
        $is_login = $this->session->userdata("is_login");
        $base_url = $this->session->userdata("base_url");

        if( $is_login && $base_url == base_url() )
        	return true;
        else
        	return false;
	}


	public function index(){

		$this->db = $this->load->database("default",TRUE);

		if( isset($_POST["submit"]) ){
			$this->load->helper("form_elements");
			$this->load->helper("url");
			$form_id = round(microtime(true) * 1000);
      $dept = $this->session->userdata("location");
			$form = form_generate($this,$form_id,$dept);
			redirect(base_url("view/CreateForm/index"));
		}

    $type = $this->session->userdata("type");
    if( $type == 'admin'){
      $res = $this->db->order_by("order","ASC")->get("form_created");
    }else if( $type == 'dept'){
      $dept = $this->session->userdata("dept");
      $res = $this->db->where("dept",$dept)->order_by("order","ASC")->get("form_created");
    }
		
		$intent["data"] = $res->result();
		$intent["menuActive"] = "create_form";
		$intent["subMenuActive"]  = "create_form";
		$intent["headerCss"]   = "view/create_form/create_formCss";
		$intent["mainContent"] = "view/create_form/create_form";
		$intent["footerJs"]    = "view/create_form/create_formJs";
		$this->load->view("view/include/template",$intent);
	}


	public function updateForm( $form_id ){

		$this->db = $this->load->database("default",TRUE);
		$this->load->helper("form_elements");

		if( isset($_POST["submit"]) ){
			$this->load->helper("url");
			$dept = $this->session->userdata("location");
      $form = form_generate($this,$form_id,$dept);
			redirect(base_url("view/CreateForm/updateForm/$form_id"));
		}

		$json_file = sprintf("./application/questions/form/%s.json",$form_id);
		$str = file_get_contents($json_file);
		$form = json_decode($str);
		

		$intent["data"] = $form;
		$intent["menuActive"] = "update_form";
		$intent["subMenuActive"]  = "update_form".$form_id;
		$intent["headerCss"]   = "view/update_form/update_formCss";
		$intent["mainContent"] = "view/update_form/update_form";
		$intent["footerJs"]    = "view/update_form/update_formJs";
		$this->load->view("view/include/template",$intent);
	}

	public function getFormElement(){
		$input_type = $this->input->post("input_type");
		$i = $this->input->post("i");
		$this->load->helper("form_elements");
		echo $input_type($i);
	}


  public function viewFormData( $form_id ){

    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);

    $this->db = $this->load->database("default",TRUE);
  //  $this->db->cache_on();
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
  //   $this->db->cache_off();
   //  $this->db->cache_on();
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
 //   $this->db->cache_off();
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR (approve_id IS NULL AND value IN (%s)) ))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);

      //echo $wherestr;

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }

    
    $data = [];
    $key_label = array();
    $summary = [];
    $last_date = date("Y-m-d");
    $keys = [];

    $this->load->helper("my");
    if( $form_for == 'FAMILY' ){
      list($key_label2,$data2) = getFormData(FMAILY_FROM_ID,$form_for,$form_id);
    }else
    if( $form_for == 'MEMBER' ){
      list($key_label2,$data2) = getFormData(MEMBER_FROM_ID,$form_for,$form_id);
    }else{
      $key_label2 = [];
      $data2 = [];
    }
    //print_r($data2);

    foreach($data_res->result() as $row){

      if(!isset($data[$row->req_id])){
        // $this->db->cache_on();
        // $res = $this->db->get_where('users',["username"=>str_replace('Web_','',$row->child_id)]);
        // $this->db->cache_off();
        //$location_arr = explode("|", $res->row()->location);
        $location_arr = explode("|", $row->location);

        if( $this->session->userdata("type") == "dept" ){
          if($form_id==USER_WORK_DONE_ACTION){
            $status_1 = '';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-red btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='1' data-familyid='$row->family_id'>1<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-amber btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='2' data-familyid='$row->family_id'>2<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-light-green btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='3' data-familyid='$row->family_id'>3<i class='material-icons'>star_rate</i></button></div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
            }
            $data[$row->req_id]["Rating Status"] = $status_1;
            $key_label["Rating Status"] = "Rating Status";
            $keys["Rating Status"] = "Rating Status";
          }else{
            $status_1 = '';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-teal btn-circle waves-effect waves-circle waves-float status_action' data-status='Verified' value='$row->req_id'><i class='material-icons'>verified_user</i></button><button type='button' class='btn bg-pink btn-circle waves-effect waves-circle waves-float status_action' data-status='Rejected' value='$row->req_id'><i class='material-icons'>delete_forever</i></button></div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
            }
            $data[$row->req_id]["Status"] = $status_1;
            $key_label["Status"] = "Status";
            $keys["Status"] = "Status";
          }
        }else{
          $status_1 = '';
          if( $row->status == "Pending" ){
            $status_1 .= "<span class='font-bold col-pink'>Pending</span>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $key_label["Status"] = "Status";
          $keys["Status"] = "Status";
        }

        foreach($key_res->result() as $col){
          $data[$row->req_id][$col->field_id] = "";
          $key_label[$col->field_id] = $col->field;
          $keys[$col->field_id] = $col->field_id;
        }

        if(strtotime($row->create_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->create_datetime));
        }
        if(strtotime($row->update_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->update_datetime));
        }
        

        //$data[$row->req_id]["inserted"] = $row->create_datetime!="0000-00-00 00:00:00"?$row->create_datetime:"";
        $data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
        // $data[$row->req_id]["geo_loc"] = $row->geo_loc;
        // $data[$row->req_id]["child_id"] = $res->row()->name." [".$res->row()->username."]";
        // $data[$row->req_id]["Tehsil"] = isset($location_arr[1])?$location_arr[1]:"";
        //$data[$row->req_id]["Block"] = isset($location_arr[2])?$location_arr[2]:"";
        //$data[$row->req_id]["Village"] = isset($location_arr[3])?$location_arr[3]:"";
        if($form_for == "FAMILY"){
          $data[$row->req_id]["system_family_id"] = $row->family_id;
          if(isset($data2[$row->family_id])){
            foreach($data2[$row->family_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }
        if($form_for == "MEMBER"){
          $data[$row->req_id]["system_member_id"] = $row->member_id;
          if(isset($data2[$row->member_id])){
            foreach($data2[$row->member_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }

        if($form_id==SELECT_ITEMS_FOR_WORK){
          $data[$row->req_id]["Released_Quantity_datetime"] = $row->approve_datetime;
          $key_label["Released_Quantity_datetime"] = "Released Quantity Datetime";
          $keys["Released_Quantity_datetime"] = "Released_Quantity_datetime";
        }
        if($form_id==USER_WORK_DONE_ACTION){
          $data[$row->req_id]["Rating_Datetime"] = $row->rating_datetime;
          $key_label["Rating_Datetime"] = "Rating Datetime";
          $keys["Rating_Datetime"] = "Rating_Datetime";
        }
        //$key_label["inserted"] = "Inserted";
        if($form_id == FMAILY_FROM_ID){
          $key_label["updated"] = "Work Entry Datetime";
        }else if($form_id == SELECT_ITEMS_FOR_WORK){
          $key_label["updated"] = "Item Request Datetime";
        }else  if($form_id == USER_WORK_DONE_ACTION){
          $key_label["updated"] = "Work Done Datetime";
        }else{
          $key_label["updated"] = "Updated";
        }
        
        $keys["updated"] = "updated";
        // $key_label["child_id"] = "Feeder";
        // $key_label["geo_loc"] = "Geo Location";
        // $key_label["Tehsil"] = "तहसील";
        //$key_label["Block"] = "ब्लॉक /  नगर पालिका";
        //$keys["Block"] = "Block";
        //$key_label["Village"] = "गाँव / वार्ड";
        //$keys["Village"] = "Village";
        // $key_label["class"] = "Filter";
        if($form_for == "FAMILY"){
          $key_label["system_family_id"] = "System Work ID";
          $keys["system_family_id"] = "system_family_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
        if($form_for == "MEMBER"){
          $key_label["system_member_id"] = "System Member ID";
          $keys["system_member_id"] = "system_member_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
      }
      $data[$row->req_id][$row->field_id] = $row->value;
    }
   
    /* $today_normal = 0;
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
    $summary["Total"]["total_home_quarantine_not_follow"] = $total_home_quarantine_not_follow; */


    /*echo "<pre>";
    print_r($data);*/

    $intent["form_title"] = $form_title;
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["data"] = $data;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;
    $intent["menuActive"] = "view_form";
    $intent["subMenuActive"]  = "view_form".$form_id;
    $intent["headerCss"]   = "view/view_form_data/view_form_dataCss";
    $intent["mainContent"] = "view/view_form_data/view_form_data";
    $intent["footerJs"]    = "view/view_form_data/view_form_dataJs";
    $this->load->view("view/include/template",$intent);
  }


  public function viewUpdateFormData( $form_id ){

    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);

    $this->db = $this->load->database("default",TRUE);
  //  $this->db->cache_on();
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
  //   $this->db->cache_off();
   //  $this->db->cache_on();
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data_update",["form_id"=>$form_id]);
 //   $this->db->cache_off();
    $location = $this->session->userdata('location');
    $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data_update');
    $data = [];
    $key_label = array();
    $summary = [];
    $last_date = date("Y-m-d");
    $keys = [];

    $this->load->helper("my");
    if( $form_for == 'FAMILY' ){
      list($key_label2,$data2) = getFormData(FMAILY_FROM_ID,$form_for);
    }else
    if( $form_for == 'MEMBER' ){
      list($key_label2,$data2) = getFormData(MEMBER_FROM_ID,$form_for);
    }else{
      $key_label2 = [];
      $data2 = [];
    }
    //print_r($data2);
    foreach($data_res->result() as $row){

      if(!isset($data[$row->req_id])){
        if(  $this->session->userdata("type") == "block" && $data2[$row->family_id]["Railway_Status"] == 'Pending' ){
          continue;
        }
        // $this->db->cache_on();
        // $res = $this->db->get_where('users',["username"=>str_replace('Web_','',$row->child_id)]);
        // $this->db->cache_off();
        //$location_arr = explode("|", $res->row()->location);
        $location_arr = explode("|", $row->location);

        if( $this->session->userdata("type") == "block" ){
          $status_1 = '';
          
          if( $row->status == "Pending" ){
            
            $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><div class='col-sm-12'><div class='form-group'>
                                        <div class='form-line'>
                                            <input type='text' name='qty' class='form-control' placeholder='Qty.' data-maxqty='##max_qty##'value='##max_qty##'/>
                                        </div>
                                    </div></div><button type='button' class='btn bg-teal btn-circle waves-effect waves-circle waves-float status_action' data-status='Verified' value='$row->req_id'><i class='material-icons'>verified_user</i></button><button type='button' class='btn bg-pink btn-circle waves-effect waves-circle waves-float status_action' data-status='Rejected' value='$row->req_id'><i class='material-icons'>delete_forever</i></button></div>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $key_label["Status"] = "Status";
          $keys["Status"] = "Status";
        }else{
          $status_1 = '';
          if( $row->status == "Pending" ){
            $status_1 .= "<span class='font-bold col-pink'>Pending</span>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $key_label["Status"] = "Status";
          $keys["Status"] = "Status";
        }

        foreach($key_res->result() as $col){
          $data[$row->req_id][$col->field_id] = "";
          $key_label[$col->field_id] = $col->field;
          $keys[$col->field_id] = $col->field_id;
        }

        if(strtotime($row->create_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->create_datetime));
        }
        if(strtotime($row->update_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->update_datetime));
        }
        
        //$data[$row->req_id]["inserted"] = $row->create_datetime!="0000-00-00 00:00:00"?$row->create_datetime:"";
        $data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
        // $data[$row->req_id]["geo_loc"] = $row->geo_loc;
        // $data[$row->req_id]["child_id"] = $res->row()->name." [".$res->row()->username."]";
        // $data[$row->req_id]["Tehsil"] = isset($location_arr[1])?$location_arr[1]:"";
        //$data[$row->req_id]["Block"] = isset($location_arr[2])?$location_arr[2]:"";
        //$data[$row->req_id]["Village"] = isset($location_arr[3])?$location_arr[3]:"";
        if($form_for == "FAMILY"){
          $data[$row->req_id]["system_family_id"] = $row->family_id;
          if(isset($data2[$row->family_id])){
            foreach($data2[$row->family_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }
        if($form_for == "MEMBER"){
          $data[$row->req_id]["system_member_id"] = $row->member_id;
          if(isset($data2[$row->member_id])){
            foreach($data2[$row->member_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }
        //$key_label["inserted"] = "Inserted";
        $key_label["updated"] = "Updated";
        $keys["updated"] = "updated";
        // $key_label["child_id"] = "Feeder";
        // $key_label["geo_loc"] = "Geo Location";
        // $key_label["Tehsil"] = "तहसील";
        //$key_label["Block"] = "ब्लॉक /  नगर पालिका";
        //$keys["Block"] = "Block";
        //$key_label["Village"] = "गाँव / वार्ड";
        //$keys["Village"] = "Village";
        // $key_label["class"] = "Filter";
        if($form_for == "FAMILY"){
          $key_label["system_family_id"] = "System Family ID";
          $keys["system_family_id"] = "system_family_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
        if($form_for == "MEMBER"){
          $key_label["system_member_id"] = "System Member ID";
          $keys["system_member_id"] = "system_member_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
      }

      if($row->field_id == SELECT_ITEMS_FOR_WORK_ITEM_QUANTITY){
        $max_qty = $row->value;
        $data[$row->req_id]["Status"] = str_replace("##max_qty##",$max_qty,$data[$row->req_id]["Status"]);
      }
      
      $data[$row->req_id][$row->field_id] = $row->value;
    }
    //print_r($data);
   
    /* $today_normal = 0;
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
    $summary["Total"]["total_home_quarantine_not_follow"] = $total_home_quarantine_not_follow; */


    /*echo "<pre>";
    print_r($data);*/

    $intent["form_title"] = $form_title;
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["data"] = $data;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;
    $intent["menuActive"] = "view_update_form";
    $intent["subMenuActive"]  = "view_update_form".$form_id;
    $intent["headerCss"]   = "view/view_update_form_data/view_update_form_dataCss";
    $intent["mainContent"] = "view/view_update_form_data/view_update_form_data";
    $intent["footerJs"]    = "view/view_update_form_data/view_update_form_dataJs";
    $this->load->view("view/include/template",$intent);
  }

  public function viewRejectedFormData( $form_id ){

    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);

    $this->db = $this->load->database("default",TRUE);
  //  $this->db->cache_on();
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
  //   $this->db->cache_off();
   //  $this->db->cache_on();
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
 //   $this->db->cache_off();
    $location = $this->session->userdata('location');
    $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data_rejected');
    $data = [];
    $key_label = array();
    $summary = [];
    $last_date = date("Y-m-d");
    $keys = [];

    $this->load->helper("my");
    if( $form_for == 'FAMILY' ){
      list($key_label2,$data2) = getFormData(FMAILY_FROM_ID,$form_for);
    }else
    if( $form_for == 'MEMBER' ){
      list($key_label2,$data2) = getFormData(MEMBER_FROM_ID,$form_for);
    }else{
      $key_label2 = [];
      $data2 = [];
    }
    //print_r($data2);

    foreach($data_res->result() as $row){

      if(!isset($data[$row->req_id])){
        // $this->db->cache_on();
        // $res = $this->db->get_where('users',["username"=>str_replace('Web_','',$row->child_id)]);
        // $this->db->cache_off();
        //$location_arr = explode("|", $res->row()->location);
        $location_arr = explode("|", $row->location);

        if( $this->session->userdata("type") == "siteincharge" ){
          if($form_id==USER_WORK_DONE_ACTION){
            $status_1 = '';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-red btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='1' data-familyid='$row->family_id'>1<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-amber btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='2' data-familyid='$row->family_id'>2<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-light-green btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='3' data-familyid='$row->family_id'>3<i class='material-icons'>star_rate</i></button></div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
            }
            $data[$row->req_id]["Rating Status"] = $status_1;
            $key_label["Rating Status"] = "Rating Status";
            $keys["Rating Status"] = "Rating Status";
          }else{
            $status_1 = '';
            if( $row->status == "Rejected" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-teal btn-circle waves-effect waves-circle waves-float status_action' data-status='Verified' value='$row->req_id'><i class='material-icons'>verified_user</i></button><button type='button' class='btn bg-pink btn-circle waves-effect waves-circle waves-float status_action' data-status='Rejected' value='$row->req_id'><i class='material-icons'>delete_forever</i></button></div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
            }
            $data[$row->req_id]["Status"] = $status_1;
            $key_label["Status"] = "Status";
            $keys["Status"] = "Status";
          }
        }else{
          $status_1 = '';
          if( $row->status == "Pending" ){
            $status_1 .= "<span class='font-bold col-pink'>Pending</span>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $key_label["Status"] = "Status";
          $keys["Status"] = "Status";
        }

        foreach($key_res->result() as $col){
          $data[$row->req_id][$col->field_id] = "";
          $key_label[$col->field_id] = $col->field;
          $keys[$col->field_id] = $col->field_id;
        }

        if(strtotime($row->create_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->create_datetime));
        }
        if(strtotime($row->update_datetime) > strtotime($last_date)){
          $last_date = date("Y-m-d",strtotime($row->update_datetime));
        }
        
        //$data[$row->req_id]["inserted"] = $row->create_datetime!="0000-00-00 00:00:00"?$row->create_datetime:"";
        $data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
        // $data[$row->req_id]["geo_loc"] = $row->geo_loc;
        // $data[$row->req_id]["child_id"] = $res->row()->name." [".$res->row()->username."]";
        // $data[$row->req_id]["Tehsil"] = isset($location_arr[1])?$location_arr[1]:"";
        //$data[$row->req_id]["Block"] = isset($location_arr[2])?$location_arr[2]:"";
        //$data[$row->req_id]["Village"] = isset($location_arr[3])?$location_arr[3]:"";
        if($form_for == "FAMILY"){
          $data[$row->req_id]["system_family_id"] = $row->family_id;
          if(isset($data2[$row->family_id])){
            foreach($data2[$row->family_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }
        if($form_for == "MEMBER"){
          $data[$row->req_id]["system_member_id"] = $row->member_id;
          if(isset($data2[$row->member_id])){
            foreach($data2[$row->member_id] as $field_id2 => $value2){
              $data[$row->req_id][$field_id2] = $value2;
            }
          }
        }
        //$key_label["inserted"] = "Inserted";
        $key_label["updated"] = "Updated";
        $keys["updated"] = "updated";
        // $key_label["child_id"] = "Feeder";
        // $key_label["geo_loc"] = "Geo Location";
        // $key_label["Tehsil"] = "तहसील";
        //$key_label["Block"] = "ब्लॉक /  नगर पालिका";
        //$keys["Block"] = "Block";
        //$key_label["Village"] = "गाँव / वार्ड";
        //$keys["Village"] = "Village";
        // $key_label["class"] = "Filter";
        if($form_for == "FAMILY"){
          $key_label["system_family_id"] = "System Work ID";
          $keys["system_family_id"] = "system_family_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
        if($form_for == "MEMBER"){
          $key_label["system_member_id"] = "System Member ID";
          $keys["system_member_id"] = "system_member_id";
          foreach($key_label2 as $field_id2 => $field2){
            $key_label[$field_id2] = $field2;
            $keys[$field_id2] = $field_id2;
          }
        }
      }
      $data[$row->req_id][$row->field_id] = $row->value;
    }
   
    /* $today_normal = 0;
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
    $summary["Total"]["total_home_quarantine_not_follow"] = $total_home_quarantine_not_follow; */


    /*echo "<pre>";
    print_r($data);*/

    $intent["form_title"] = $form_title;
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["data"] = $data;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;
    $intent["menuActive"] = "view_rejected_form";
    $intent["subMenuActive"]  = "view_rejected_form".$form_id;
    $intent["headerCss"]   = "view/view_rejected_form_data/view_rejected_form_dataCss";
    $intent["mainContent"] = "view/view_rejected_form_data/view_rejected_form_data";
    $intent["footerJs"]    = "view/view_rejected_form_data/view_rejected_form_dataJs";
    $this->load->view("view/include/template",$intent);
  }



	public function getUpdateElement(){

		$req_id	  = $this->input->post("req_id");
		$field_id = $this->input->post("field_id");
		list($form_id,$field_no) = explode("_", $field_id);
		$jsonStr = file_get_contents(sprintf("%s/%s/%s.json",APPPATH,"questions/form",$from_id));
		$json = json_decode($jsonStr,true);
		$title = $json["step1"]["title"];
		$fields = $json["step1"]["fields"];


                    foreach($fields as $key => $field){

                    		if($field["key"]!=$field_id){
                    			continue;
                    		}

                            switch ( $field["type"] ) {



                                case 'edit_text':
                                    ?>
                                         <div class="input-group">
                                            <div class="form-line">
                                                <p><b> <?php echo sprintf("%s.) %s",++$sno,$field["hint"]); ?></b></p>
                                                <input 
                                                      type="text" 
                                                      class="form-control" 
                                                      name="<?php echo $field["key"]; ?>" 
                                                      placeholder="<?php echo $field["hint"]; ?>"
                                                      minlength="<?php echo $field["v_min_length"]["value"]; ?>"
                                                      maxlength="<?php echo $field["v_max_length"]["value"]; ?>"
                                                      <?php if( isset($field["v_required"]) && 
                                                                 $field["v_required"]["value"]=="true" 
                                                        ){
                                                          echo "required";
                                                       }?>
                                                >
                                            </div>
                                        </div>
                                    <?php
                                    break;





                                case 'spinner':
                                    ?>
                                      <div class="input-group">
                                        <div class="form-line">
                                             <p><b> <?php echo sprintf("%s.) %s",++$sno,$field["hint"]); ?></b></p>
                                            <select 
                                                    class="form-control show-tick"
                                                    name="<?php echo  $field["key"]; ?>"
                                                    <?php if( isset($field["v_required"]) && 
                                                                 $field["v_required"]["value"]=="true" 
                                                        ){
                                                          echo "required";
                                                       }?>  
                                            >
                                                <option value="">-- Please select --</option>
                                                <?php foreach($field["values"] as $val): ?>
                                                    <option value="<?php echo $val; ?>">
                                                        <?php echo $val; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                     </div>
                                    <?php
                                    break;





                                case 'check_box':
                                    ?>
                                    <div class="input-group">
                                       <div class="form-line">
                                        <p><b> <?php echo sprintf("%s.) %s",++$sno,$field["label"]); ?></b></p>
                                    <?php
                                    foreach($field["options"] as $val){
                                        ?>
                                            <div class="demo-checkbox">
                                                <input 
                                                       name="<?php echo  $field["key"]; ?>" 
                                                       type="checkbox" 
                                                       value="<?php echo  $val["key"]; ?>" 
                                                       class="filled-in chk-col-red"
                                                       id="<?php echo $id; ?>"
                                                >
                                                <label for="<?php echo $id; ?>"><?php echo  $val["text"]; ?></label>
                                            </div>
                                        <?php
                                        $id++;
                                    }
                                    ?>
                                        </div>
                                    </div>
                                    <?php
                                    break;





                                case 'radio':
                                    ?>
                                    <div class="input-group">
                                       <div class="form-line">
                                        <p><b> <?php echo sprintf("%s.) %s",++$sno,$field["label"]); ?></b></p>
                                    <?php
                                    $radio = 0;
                                    foreach($field["options"] as $val){
                                        ?>
                                            <div class="demo-radio-button">
                                                <input 
                                                       name="<?php echo  $field["key"]; ?>" 
                                                       type="radio" 
                                                       value="<?php echo  $val["key"]; ?>" 
                                                       class="radio-col-red"
                                                       id="<?php echo $id; ?>"
                                                       <?php if( $radio == 0 ){
                                                          echo "required checked";
                                                          $radio++;
                                                       }?> 
                                                >
                                                <label for="<?php echo $id; ?>"><?php echo  $val["text"]; ?></label>
                                            </div>
                                        <?php
                                        $id++;
                                    }
                                    ?>
                                        </div>
                                    </div>
                                    <?php
                                    break;



                                    case 'choose_image':
                                    ?>
                                         <div class="input-group">
                                            <div class="form-line">
                                                <p><b> <?php echo sprintf("%s.) %s",++$sno,$field["uploadButtonText"]); ?></b></p>
                                                <input 
                                                      type="file" 
                                                      class="form-control fileupload" 
                                                      name="<?php echo $field["key"]; ?>" 
                                                      placeholder="<?php echo $field["uploadButtonText"]; ?>"
                                                      <?php if( isset($field["v_required"]) && 
                                                                 $field["v_required"]["value"]=="true" 
                                                        ){
                                                          echo "required";
                                                       }?>
                                                >
                                            </div>
                                        </div>
                                    <?php
                                    break;




                                
                                default:
                                    # code...
                                    break;
                            }
                      }
	}


  public function update_form_ui($req_id){
    $this->load->helper('form_elements');
    $this->db = $this->load->database("default",TRUE);
    $json = update_form_ui($this,$req_id);
    $this->load->view("view/update_form_ui",["json"=>$json,"req_id"=>$req_id]);
  }

  public function feedback(){

    $this->db = $this->load->database("default",TRUE);

    $intent["menuActive"] = "feedback";
    $intent["subMenuActive"]  = "feedback";
    $intent["headerCss"]   = "view/feedback/feedbackCss";
    $intent["mainContent"] = "view/feedback/feedback";
    $intent["footerJs"]    = "view/feedback/feedbackJs";
    $this->load->view("view/include/template",$intent);
  }



  public function updateStatusOfReq(){

    $this->db = $this->load->database("default",TRUE);

    $req_id = $this->input->post("req_id");
    $status = $this->input->post("status");
    $datetime = date("Y-m-d H:i:s");
    $id = $this->session->userdata("id");

    if($status=="Verified"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data",["status"=>"Verified","approve_datetime"=>$datetime,"approve_id"=>$id]);
    }
    if($status=="Rejected"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data",["status"=>"Rejected","approve_datetime"=>$datetime,"approve_id"=>$id]);

      $res = $this->db->get_where("form_data",["req_id"=>$req_id]);

      $arr = [];
      foreach($res->result_array() as $index => $row){
        foreach($row as $key => $value){
          if($key!="record_id"){
            $arr[$index][$key] = $value; 
          }
        }
      }
      $this->db->insert_batch("form_data_rejected",$arr);

      $this->db->delete("form_data",["req_id"=>$req_id]);

    }
    echo "200";
  }



  public function updateStatusOfReq2(){

    $this->db = $this->load->database("default",TRUE);

    $req_id = $this->input->post("req_id");
    $status = $this->input->post("status");
    $qty = $this->input->post("qty");
    $datetime = date("Y-m-d H:i:s");
    $id = $this->session->userdata("id");

    if($status=="Verified"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data_update",["status"=>"Verified","approve_datetime"=>$datetime,"approve_id"=>$id]);

      $res = $this->db->get_where("form_data_update",["req_id"=>$req_id]);

      $arr = [];
      $form_id = '';
      foreach($res->result_array() as $index => $row){
        $form_id = $row["form_id"];
        foreach($row as $key => $value){
          if($key!="record_id"){
            $arr[$index][$key] = $value; 
          }
        }
      }
      $lastrow = $arr[count($arr)-1];
      $lastrow["field_id"] = "system_generated";
      $lastrow["field"] = "Relesed Quantity";
      $lastrow["field_type"] = "edit_text";
      $lastrow["value"] = $qty;
      $lastrow["geo_loc"] = $datetime;
      $lastrow["create_datetime"] = $datetime;
      $lastrow["update_datetime"] = $datetime;
      $lastrow["status"] = "Verified";
      $lastrow["approve_datetime"] = $datetime;
      $lastrow["approve_id"] = $id;
      $arr[] = $lastrow;
      $this->db->insert_batch("form_data",$arr);

      $this->db->delete("form_data_update",["req_id"=>$req_id]);
    }
    if($status=="Rejected"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data_update",["status"=>"Rejected","approve_datetime"=>$datetime,"approve_id"=>$id]);

      $res = $this->db->get_where("form_data_update",["req_id"=>$req_id]);
      
      $arr = [];
      foreach($res->result_array() as $index => $row){
        foreach($row as $key => $value){
          if($key!="record_id"){
            $arr[$index][$key] = $value; 
          }
        }
      }
      $this->db->insert_batch("form_data_rejected",$arr);

      $this->db->delete("form_data_update",["req_id"=>$req_id]);

    }
    echo "200";
  }



  public function updateStatusOfReqRating(){

    $this->db = $this->load->database("default",TRUE);

    $req_id = $this->input->post("req_id");
    $status = $this->input->post("status");
    $rating = $this->input->post("rating");
    $family_id = $this->input->post("family_id");
    $datetime = date("Y-m-d H:i:s");
    $id = $this->session->userdata("id");

    if($status=="Verified"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data",["status"=>"Verified","approve_datetime"=>$datetime]);

      $this->db->where("family_id",$family_id);
      $this->db->update("form_data",["rating"=>$rating,"rating_datetime"=>$datetime]);
      echo "200";
    }else{
      echo "error";
    }
  }


  public function updateStatusOfReqRejected(){

    $this->db = $this->load->database("default",TRUE);

    $req_id = $this->input->post("req_id");
    $status = $this->input->post("status");
    $datetime = date("Y-m-d H:i:s");

    if($status=="Rejected"){
      // $this->db->where("req_id",$req_id);
      // $this->db->update("form_data",["status"=>"Verified","approve_datetime"=>$datetime]);
    }
    if($status=="Verified"){
      $this->db->where("req_id",$req_id);
      $this->db->update("form_data_rejected",["status"=>"Pending","update_datetime"=>$datetime]);

      $res = $this->db->get_where("form_data_rejected",["req_id"=>$req_id]);

      $arr = [];
      $form_id = '';
      foreach($res->result_array() as $index => $row){
        $form_id = $row["form_id"];
        foreach($row as $key => $value){
          if($key!="record_id"){
            $arr[$index][$key] = $value; 
          }
        }
      }
      if($form_id==SELECT_ITEMS_FOR_WORK){
        $this->db->insert_batch("form_data_update",$arr);
      }else{
        $this->db->insert_batch("form_data",$arr);
      }

      $this->db->delete("form_data_rejected",["req_id"=>$req_id]);

    }
    echo "200";
  }


  public function assignWork( $type ){

    $this->db = $this->load->database("default",TRUE);

    $train_numbers = [];
    $trains_res = $this->db->distinct()->select("train_number")->get("railway_trains");
    foreach($trains_res->result() as $row){
      $train_numbers[] = $row->train_number;
    }

    $users = [];
    $typename = "";

    if($type=="sbs_supervisor"){
      //user
      $typename = "SBS Supervisor";
      $users_res = $this->db->where("type","user")->where("active","1")->get("users");
      foreach($users_res->result() as $row){
        $users[$row->username] = $row;
        $users[$row->username]->train_numbers = [];
      }
      $railway_mapping_res = $this->db->where("type","user")->get("railway_mapping");
      foreach($railway_mapping_res->result() as $row){
        $users[$row->username]->train_numbers[] = $row->train_number;
      }

    }else if($type=="ssc"){
      //dept
      $typename = "SSC";
      $users_res = $this->db->where("type","dept")->where("active","1")->get("users");
      foreach($users_res->result() as $row){
        $users[$row->username] = $row;
        $users[$row->username]->train_numbers = [];
      }
      $railway_mapping_res = $this->db->where("type","dept")->get("railway_mapping");
      foreach($railway_mapping_res->result() as $row){
        $users[$row->username]->train_numbers[] = $row->train_number;
      }
    }

    $intent["users"] = $users;
    $intent["type"] = $type;
    $intent["train_numbers"] = $train_numbers;
    $intent["form_title"] = "Assign Work ".$typename;
    $intent["typename"] = $typename;

    $intent["menuActive"] = "assign_work";
    $intent["subMenuActive"]  = "assign_work_".$type;
    $intent["headerCss"]   = "view/assign_work/assign_workCss";
    $intent["mainContent"] = "view/assign_work/assign_work";
    $intent["footerJs"]    = "view/assign_work/assign_workJs";
    $this->load->view("view/include/template",$intent);
  }


  public function railwayMappingSaveChanges(){
    
    $this->db = $this->load->database("default",TRUE);

    $assigned_at = date("Y-m-d H:i:s");
    $assigned_by = $this->session->userdata("id");
    $railway_mapping = $this->input->post("railway_mapping");

    $railway_mapping = json_decode($railway_mapping);
    $adddata = [];
    $delete_username_data = [];
    foreach($railway_mapping as $row){
      foreach($row->assign as $train_number){
        $type="";
        if($row->type=="sbs_supervisor"){
          $type="user";
        }else if($row->type=="ssc"){
          $type="dept";
        }
        $adddata[] = [
          "type" => $type,
          "username" => $row->username,
          "train_number" => $train_number,
          "assigned_by" => $assigned_by,
          "assigned_at" => $assigned_at
        ];
        $delete_username_data[] = $row->username;
      }
    }

    if(count($adddata)>0){
      $this->db->where_in("username",$delete_username_data)->delete("railway_mapping");
      $this->db->insert_batch("railway_mapping",$adddata);
    }
    echo "200";

  }


	
} 