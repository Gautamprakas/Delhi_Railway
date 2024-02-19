<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateForm extends CI_Controller {

 
	public function __construct(){

		parent::__construct();
		$this->load->library('session');
    $this->db=$this->load->database("default",TRUE);
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

		// if( isset($_POST["submit"]) ){
		// 	$this->load->helper("form_elements");
		// 	$this->load->helper("url");
		// 	$form_id = round(microtime(true) * 1000);
    //   $dept = $this->session->userdata("location");
		// 	$form = form_generate($this,$form_id,$dept);
		// 	redirect(base_url("view/CreateForm//index"));
		// }

    // $type = $this->session->userdata("type");
    // if( $type == 'admin'){
    //   $res = $this->db->order_by("order","ASC")->get("form_created");
    // }else if( $type == 'dept'){
    //   $dept = $this->session->userdata("dept");
    //   $res = $this->db->where("dept",$dept)->order_by("order","ASC")->get("form_created");
    // }
		
		// $intent["data"] = $res->result();
		// $intent["menuActive"] = "create_form";
		// $intent["subMenuActive"]  = "create_form";
		// $intent["headerCss"]   = "view/create_form/create_formCss";
		// $intent["mainContent"] = "view/create_form/create_form";
		// $intent["footerJs"]    = "view/create_form/create_formJs";
		// $this->load->view("view/include/template",$intent);
    redirect(base_url("view/CreateForm/reportBilling/1690450752274"));
	}
  public function addWarranty(){
    $this->db = $this->load->database("default",TRUE);
    $intent["menuActive"] = "warranty";
    $intent["subMenuActive"]  = "add_warranty";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_warranty";
    $intent["footerJs"]    = "view/master/add_warrantyJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveaddWarranty(){
    // $this->db = $this->load->database("default",TRUE);
    $data['days'] = $this->input->post("days");
    $this->db->insert('railway_warranty_days', $data); // Correct way to insert data into the table

    if ($this->db->affected_rows() > 0) {
        echo "Data Inserted";
    } else {
        echo $this->db->error();
    }
 }

  public function editWarranty(){
    $this->db->select("days");
    $this->db->from("railway_warranty_days");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "warranty";
    $intent["subMenuActive"]  = "edit_warranty";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_warranty";
    $intent["footerJs"]    = "view/master/edit_warrantyJs";
    $this->load->view("view/include/template",$intent);
    // print_r($intent);
  }

  public function saveUpdateWarranty(){

    $days=$this->input->post("days");
    $status=$this->input->post("status");
    $inputValue=$this->input->post("inputValue");
    $data['days']=$inputValue;
    if($status=="Delete"){
      $this->db->where("days",$days);
      $this->db->delete("railway_warranty_days");
    }else if($days!=$inputValue){
    $this->db->where("days",$days);
    $this->db->update("railway_warranty_days",$data);
   }else if($days==$inputValue){
    echo "Status Updated";
    die();
   }
    if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }
  //
  public function addTrain(){
    $this->db = $this->load->database("default",TRUE);
    $intent["menuActive"] = "update_form1";
    $intent["subMenuActive"]  = "add_train";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_train";
    $intent["footerJs"]    = "view/master/add_trainJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveAddTrain(){
    // $this->db = $this->load->database("default",TRUE);
    $data['train_number'] = $this->input->post("trainNo");
    $this->db->insert('railway_trains', $data); // Correct way to insert data into the table

    if ($this->db->affected_rows() > 0) {
        echo "Data Inserted";
    } else {
        echo $this->db->error();
    }
 }

  public function editTrain(){
    $this->db->select("train_number");
    $this->db->from("railway_trains");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form1";
    $intent["subMenuActive"]  = "edit_train";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_train";
    $intent["footerJs"]    = "view/master/edit_trainJs";
    $this->load->view("view/include/template",$intent);
    // print_r($intent);
  }

  public function saveUpdateTrain(){

    $train_no=$this->input->post("trainNo");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Train"){
      $this->db->where("train_number",$train_no);
      $this->db->delete("railway_trains");
    }else{
    $this->db->where("train_number",$train_no);
    $this->db->update("railway_trains",$data);
   }
    if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }
  public function saveUpdateBerth(){

    $berth=$this->input->post("berth");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Berth"){
      $this->db->where("berth",$berth);
      $this->db->delete("railway_berth");
    }else{
    $this->db->where("berth",$berth);
    $this->db->update("railway_berth",$data);
   }
    if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }
  public function saveUpdateItem(){

    $item=$this->input->post("item");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Item"){
      $this->db->where("item_name",$item);
      $this->db->delete("railway_item");
    }else{
    $this->db->where("item_name",$item);
    $this->db->update("railway_item",$data);
   }
   if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }
  public function saveUpdateUom(){

    $uom=$this->input->post("uom");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete UOM"){
      $this->db->where("uom",$uom);
      $this->db->delete("railway_uom");
    }else{
    $this->db->where("uom",$uom);
    $this->db->update("railway_uom",$data);
   }
   if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }

  public function saveUpdateWork(){

    $work_code=$this->input->post("work_code");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Work"){
      $this->db->where("work_code",$uom);
      $this->db->delete("railway_work");
    }else{
    $this->db->where("work_code",$work_code);
    $this->db->update("railway_work",$data);
   }
   if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }

  public function saveUpdateCategory(){

    $work_category=$this->input->post("work_category");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Category"){
      $this->db->where("category",$work_category);
      $this->db->delete("railway_work_categories");
    }else{
    $this->db->where("category",$work_category);
    $this->db->update("railway_work_categories",$data);
   }
   if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }

  public function saveUpdateStatus(){

    $work_status=$this->input->post("work_status");
    $status=$this->input->post("status");
    $data['work_status']=$status;
    if($status=="Delete Status"){
      $this->db->where("status",$work_status);
      $this->db->delete("railway_work_status");
    }else{
    $this->db->where("status",$work_status);
    $this->db->update("railway_work_status",$data);
   }
   if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }


  public function addCoach(){
    $this->db = $this->load->database("default",TRUE);
    $intent["menuActive"] = "update_form2";
    $intent["subMenuActive"]  = "add_coach";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_coach";
    $intent["footerJs"]    = "view/master/add_coachJs";
    $this->load->view("view/include/template",$intent);
  }

  public function saveCoach(){
    $data['coach_number']=$this->input->post("CoachNo");
    $data['coach_category']=$this->input->post("CoachCat");
    $this->db->insert("railway_coach",$data);
    if($this->db->affected_rows()>0){
      echo "Coach Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editCoach(){
    $this->db->select("coach_number,coach_category");
    $this->db->from("railway_coach");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form2";
    $intent["subMenuActive"]  = "edit_coach";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_coach";
    $intent["footerJs"]    = "view/master/edit_coachJs";
    $this->load->view("view/include/template",$intent);
    // print_r($intent);
  }
  public function saveUpdateCoach(){

    $coach_no=$this->input->post("coachNo");
    $status=$this->input->post("status");
    $data['status']=$status;
    if($status=="Delete Coach"){
      $this->db->where("coach_number",$coach_no);
      $this->db->delete("railway_coach");
    }else{
    $this->db->where("coach_number",$coach_no);
    $this->db->update("railway_coach",$data);
   }
    if($this->db->affected_rows()>0){
      echo "Status Updated";
    }
    else{
      echo $this->db->error();
    }

  }
  public function addBerth(){
    $this->db = $this->load->database("default",TRUE);
    $intent["menuActive"] = "update_form3";
    $intent["subMenuActive"]  = "add_berth";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_berth";
    $intent["footerJs"]    = "view/master/add_berthJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveBerth(){
    $data['berth']=$this->input->post("berth");
    $this->db->insert("railway_berth",$data);
    if($this->db->affected_rows()>0){
      echo "Berth Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editBerth(){
    $this->db->select("berth");
    $this->db->from("railway_berth");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form3";
    $intent["subMenuActive"]  = "edit_berth";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_berth";
    $intent["footerJs"]    = "view/master/edit_berthJs";
    $this->load->view("view/include/template",$intent);
  }

  public function addUom(){
    $this->db = $this->load->database("default",TRUE);
    $intent["menuActive"] = "update_form4";
    $intent["subMenuActive"]  = "add_uom";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_uom";
    $intent["footerJs"]    = "view/master/add_uomJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveUom(){
    $data['uom']=$this->input->post("uom");
    $this->db->insert("railway_uom",$data);
    if($this->db->affected_rows()>0){
      echo "UOM Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editUom(){
    $this->db->select("uom");
    $this->db->from("railway_uom");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form4";
    $intent["subMenuActive"]  = "edit_uom";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_uom";
    $intent["footerJs"]    = "view/master/edit_uomJs";
    $this->load->view("view/include/template",$intent);
  }
  public function addItem(){
    $this->db->select("uom");
    $this->db->from("railway_uom");
    $query=$this->db->get();
    $intent['result']=$query->result_array();
    $intent["menuActive"] = "update_form5";
    $intent["subMenuActive"]  = "add_item";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_item";
    $intent["footerJs"]    = "view/master/add_itemJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveItem(){
    $data['item_name']=$this->input->post("itemName");
    $data['uom_value']=$this->input->post("uom_value");
    $this->db->insert("railway_item",$data);
    if($this->db->affected_rows()>0){
      echo "Item Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editItem(){
    $this->db->select("item_name,uom_value");
    $this->db->from("railway_item");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form5";
    $intent["subMenuActive"]  = "edit_item";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_item";
    $intent["footerJs"]    = "view/master/edit_itemJs";
    $this->load->view("view/include/template",$intent);
  }
  public function addWork(){
    $this->db->select("uom");
    $this->db->from("railway_uom");
    $query=$this->db->get();
    $intent['result_uom']=$query->result_array();
    $this->db->select("item_name");
    $this->db->from("railway_item");
    $query2=$this->db->get();
    $this->db->select("category");
    $this->db->from("railway_work_categories");
    $query3=$this->db->get();
    $intent['result_categories']=$query3->result_array();
    $this->db->select("days");
    $this->db->from("railway_warranty_days");
    $query_5=$this->db->get();
    $intent['warranty_days']=$query_5->result_array();
    $intent['item_name']=$query2->result_array();
    $intent["menuActive"] = "update_form6";
    $intent["subMenuActive"]  = "add_work";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_work2";
    $intent["footerJs"]    = "view/master/add_workJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveWork(){
    $data['item_name']=$this->input->post("item_name");
    $data['uom']=$this->input->post("uom_value");
    $data['work_code']=$this->input->post("workCode");
    $data['work_name']=$this->input->post("workName");
    $data['work_category']=$this->input->post("workCat");
    $data['work_rate']=$this->input->post("workRate");
    $data['warranty_days']=$this->input->post("warrantyDays");
    $this->db->insert("railway_work",$data);
    if($this->db->affected_rows()>0){
      echo "Work Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editWork(){
    $this->db->select("*");
    $this->db->from("railway_work");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form6";
    $intent["subMenuActive"]  = "edit_work";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_work";
    $intent["footerJs"]    = "view/master/edit_workJs";
    $this->load->view("view/include/template",$intent);
  }

  public function addCategory(){
    $intent["menuActive"] = "update_form7";
    $intent["subMenuActive"]  = "add_category";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_category";
    $intent["footerJs"]    = "view/master/add_categoryJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveCategory(){
    $data['category']=$this->input->post("category");
    $this->db->insert("railway_work_categories",$data);
    if($this->db->affected_rows()>0){
      echo "Work Category Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editCategory(){
    $this->db->select("*");
    $this->db->from("railway_work_categories");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form7";
    $intent["subMenuActive"]  = "edit_category";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_category";
    $intent["footerJs"]    = "view/master/edit_categoryJs";
    $this->load->view("view/include/template",$intent);
  }
  public function addStatus(){
    $intent["menuActive"] = "update_form8";
    $intent["subMenuActive"]  = "add_status";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/add_status";
    $intent["footerJs"]    = "view/master/add_statusJs";
    $this->load->view("view/include/template",$intent);
  }
  public function saveStatus(){
    $data['status']=$this->input->post("status");
    $this->db->insert("railway_work_status",$data);
    if($this->db->affected_rows()>0){
      echo "Work Status Added";
    }
    else{
      $message=$this->db->error();
      echo $message;
    }
  }
  public function editStatus(){
    $this->db->select("*");
    $this->db->from("railway_work_status");
    $query=$this->db->get();
    $intent['data']=$query->result_array();
    $intent["menuActive"] = "update_form8";
    $intent["subMenuActive"]  = "edit_status";
    $intent["headerCss"]   = "view/update_form/update_formCss";
    $intent["mainContent"] = "view/master/edit_status";
    $intent["footerJs"]    = "view/master/edit_statusJs";
    $this->load->view("view/include/template",$intent);
  }
  public function dataSheet($form_id){
    // $query=$this->db->select("value")->distinct()->where("field","Train Number*")->get("form_data");
    $query=$this->db->select("username,train_number")->get("railway_mapping");
    // $this->db->from("railway_trains");
    // $query=$this->db->get();
    $intent['railway_trains']=$query->result_array();
    // echo "<pre>";
    // print_r($intent['railway_trains']);
    // die();
    $intent['form_id']=$form_id;
    $intent["menuActive"] = "update_form9";
    $intent["subMenuActive"]  = "data_sheet".$form_id;
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/data_sheet2";
    $intent["footerJs"]    = "view/reports/data_sheetJs2";
    $this->load->view("view/include/template",$intent);
  }
  public function reportHistory( $form_id ){

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
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      if($form_id=="1690450752274"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }

      //echo $wherestr;

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $item_name='';
      $item_quantity='';
      $result_str='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $work_date = isset($row->create_datetime) ? new DateTime($row->create_datetime): '';
      if(!empty($work_date)){
        $work_date=$work_date->format('Y-m-d');
      }
      $create_datetime = !empty($row->create_datetime) ? new DateTime($row->create_datetime) : null;
      $update_datetime = !empty($row->update_datetime) ? new DateTime($row->update_datetime) : null;

      if (!empty($create_datetime) && !empty($update_datetime)) {
          $interval = $create_datetime->diff($update_datetime);
          if ($interval->days > 180) {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
          } else {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-teal'>Yes</span>";
          }
      } else {
          $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
      }
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id]["work_date"]=$work_date;
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
      
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if($row['1690450752274_2']=="Done"){
        $data[$req_id]["Work_Done_Status"]="Done";
      }else{
        $data[$req_id]["Work_Done_Status"]="Not Done";
      }
    }
    // echo "<pre>";
    // print_r($data);
    // die();
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    $new_data=array();
    $uom='';
    foreach($data as $req_id=>$row){
       $item_name='';
       $item_quantity='';
       $warrantyStatus='';
       $uom='';
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $warrantyStatus='';
          $uom='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$row['1690365766_2'],
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$row['1690365766_2'],
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

      }
    }
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  

    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("approve_id IS NOT NULL");
      $this->db->where("field_id","1690365766_1");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }
    // echo "<pre>";
    // print_r($new_data);
    // die();
   
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
     // echo "<pre>";
    $newKeys=['1690365766_1','updated','1690365766_5',"item_name","item_quantity","uom","work_date","is_six_month","work_code","warranty_status","child_id","approve_id"];
    $query_1=$this->db->select("train_number")->get("railway_trains");
    $query_2=$this->db->select("coach_number")->get("railway_coach");
    $query_3=$this->db->select("status")->get("railway_work_status");
    $query_4=$this->db->select("berth")->get("railway_berth");
    $query_5=$this->db->select("category")->get("railway_work_categories");
    $intent['railway_trains']=$query_1->result_array();
    $intent['coach_numbers']=$query_2->result_array();
    $intent['work_status']=$query_3->result_array();
    $intent['berth']=$query_4->result_array();
    $intent['work_category']=$query_5->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Repair And Replace History";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newData"] = $new_data;
    $intent['newKeys']=$newKeys;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "data_sheet_history";
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/data_sheet_history";
    $intent["footerJs"]    = "view/reports/data_sheet_historyJs";
    $this->load->view("view/include/template",$intent);
  }

  public function reportInWarranty( $form_id ){

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
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      if($form_id=="1690450752274"){
          $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
        }
      //echo $wherestr;

      $data_res = $this->db->select("record_id,child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("send_for_rating IS NULL")
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("record_id,child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("send_for_rating IS NULL")
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $item_name='';
      $item_quantity='';
      $result_str='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $work_date = isset($row->create_datetime) ? new DateTime($row->create_datetime): '';
      if(!empty($work_date)){
        $work_date=$work_date->format('Y-m-d');
      }
      $create_datetime = !empty($row->create_datetime) ? new DateTime($row->create_datetime) : null;
      $update_datetime = !empty($row->update_datetime) ? new DateTime($row->update_datetime) : null;

      if (!empty($create_datetime) && !empty($update_datetime)) {
          $interval = $create_datetime->diff($update_datetime);
          if ($interval->days > 180) {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
          } else {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-teal'>Yes</span>";
          }
      } else {
          $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
      }
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id]["work_date"]=$work_date;
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if($row['1690450752274_2']=="Done"){
        $data[$req_id]["Work_Done_Status"]="Done";
      }else{
        $data[$req_id]["Work_Done_Status"]="Not Done";
      }
    }
    // echo "<pre>";
    // print_r($data);
    // die();
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    $new_data=array();
    $uom='';
    foreach($data as $req_id=>$row){
       $item_name='';
       $item_quantity='';
       $warrantyStatus='';
       $uom='';
       $coach_no='';
       $coach_type='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
        }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $warrantyStatus='';
          $uom='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyStatus=1;
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "item_use_date"=>$row['item_use_date'],
              "coach_type"=>$coach_type,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$row['1690365766_2'],
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "item_use_date"=>$row['item_use_date'],
              "coach_type"=>$coach_type,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

      }
    }
    $itemWarrantyArray=array();
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        if($row['warranty_status']==1){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['item_use_date']);
        foreach($new_data as $data1){
          foreach($data1 as $req_id1=>$row1){
            if($row1['warranty_status']==1 && $row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['item_use_date'])>$item_use_date){
              $row1_family_id=$row1['system_family_id'];
              $row1['req_id']=$req_id1;
              $row['req_id']=$req_id;
              if($this->session->userdata("type") == "dept"){
                  $row1['sendItem']="<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-teal btn-circle waves-effect waves-circle waves-float status_action' data-status='$row1_family_id' value='$req_id1'><i class='material-icons'>send_item</i></div>";
              }
              if($this->session->userdata("type") == "admin"){
                  $row1['sendItem']="<span class='font-bold col-red'>Pending</span>";
              }
              $itemWarrantyArray[]=array(
                $row['item_use_date']=>$row,
                $row1['item_use_date']=>$row1
              );


            }
          }
        }

      }


      }
    }
    // echo "<pre>";
    // print_r($itemWarrantyArray);
    // die();
    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("approve_id IS NOT NULL");
      $this->db->where("field_id","1690365766_1");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }
   
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
     // echo "<pre>";
    // $newKeys=['1690365766_1','updated','1690365766_5',"item_name","item_quantity","uom","work_date","is_six_month","work_code","warranty_status"];
    $newKeys=['1690365766_1','item_use_date','1690365766_2','coach_type','1690365766_4','1690365766_5','Work_Done_Status','item_name','item_quantity','uom','work_code','sendItem','child_id','approve_id'];
    $query_1=$this->db->select("username,train_number")->get("railway_mapping");
    $intent['railway_trains']=$query_1->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Resend For Rating";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newData"] = $itemWarrantyArray;
    $intent['newKeys']=$newKeys;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "warranty_report";
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/warranty_report";
    $intent["footerJs"]    = "view/reports/warranty_reportJs";
    $this->load->view("view/include/template",$intent);
  }
    public function filterWarrantyReport( $form_id ){

    $trainNo=$this->input->post("trainNo");
    $date=$this->input->post("date");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");

    ini_set('memory_limit', '-1');
    $this->db = $this->load->database("default",TRUE);  
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $params=[];
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690450752274" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }

      if($train_numbers=="0" && $this->session->userdata("type") == "admin"){
        $wherestr = "family_id IN (SELECT DISTINCT family_id FROM form_data)";
      }
      if(!empty($trainNo) && $this->session->userdata("type") == "admin"){
        $$wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
      }

      //echo $wherestr;

      $data_res = $this->db->select("record_id,child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("send_for_rating IS NULL")
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

      // if(!empty($date)){
      //   $data_res = $this->db->select("record_id,child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
      //                    ->where("form_id",$form_id)
      //                    ->where("send_for_rating IS NULL")
      //                    ->where("$wherestr",null)
      //                    ->where("location like '$location%'",null)
      //                    ->where("DATE(update_datetime)",$date)
      //                    ->where("rating IS NOT NULL")
      //                    ->order_by("update_datetime","DESC")
      //                    ->get('form_data');
      // }

    }else{

      $data_res = $this->db->select("record_id,child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("send_for_rating IS NULL")
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      // echo $date;
      // die();
      $this->db->select('field, value, DATE(create_datetime) as create_datetime, DATE(update_datetime) as update_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();

      if (count($result) == 0) {
          $this->db->select('field, value, DATE(create_datetime) as create_datetime, DATE(update_datetime) as update_datetime');
          $this->db->where('family_id', $row->family_id);
          $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
          $query = $this->db->get('form_data');
          $result = $query->result_array();
      }

      $i=1;
      $item_name='';
      $item_quantity='';
      $result_str='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $work_date = isset($row->create_datetime) ? new DateTime($row->create_datetime): '';
      if(!empty($work_date)){
        $work_date=$work_date->format('Y-m-d');
      }
      $create_datetime = !empty($row->create_datetime) ? new DateTime($row->create_datetime) : null;
      $update_datetime = !empty($row->update_datetime) ? new DateTime($row->update_datetime) : null;

      if (!empty($create_datetime) && !empty($update_datetime)) {
          $interval = $create_datetime->diff($update_datetime);
          if ($interval->days > 180) {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
          } else {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-teal'>Yes</span>";
          }
      } else {
          $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
      }
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id]["work_date"]=$work_date;
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if($row['1690450752274_2']=="Done"){
        $data[$req_id]["Work_Done_Status"]="Done";
      }else{
        $data[$req_id]["Work_Done_Status"]="Not Done";
      }
    }
   
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    $new_data=array();
    $uom='';
    foreach($data as $req_id=>$row){
       $item_name='';
       $item_quantity='';
       $warrantyStatus='';
       $uom='';
       $coach_no='';
       $coach_type='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
        }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $warrantyStatus='';
          $uom='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyStatus=1;
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "item_use_date"=>$row['item_use_date'],
              "coach_type"=>$coach_type,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "item_use_date"=>$row['item_use_date'],
              "coach_type"=>$coach_type,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

      }
    }
    $itemWarrantyArray=array();
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        if($row['warranty_status']==1){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['item_use_date']);
        foreach($new_data as $data1){
          foreach($data1 as $req_id1=>$row1){
            if($row1['warranty_status']==1 && $row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['item_use_date'])>$item_use_date){
              $row1_family_id=$row1['system_family_id'];
              $row1['req_id']=$req_id1;
              $row['req_id']=$req_id;
              if($this->session->userdata("type") == "dept"){
                  $row1['sendItem']="<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-teal btn-circle waves-effect waves-circle waves-float status_action' data-status='$row1_family_id' value='$req_id1'><i class='material-icons'>send_item</i></div>";
              }
              if($this->session->userdata("type") == "admin"){
                  $row1['sendItem']="<span class='font-bold col-red'>Pending</span>";
              }
              //$row['sendItem']='';
              if(!empty($date) && $row1['item_use_date']==$date){
                  $itemWarrantyArray[]=array(
                  $row['item_use_date']=>$row,
                  $row1['item_use_date']=>$row1
                );

              }
              if(empty($date)){
                 $itemWarrantyArray[]=array(
                  $row['item_use_date']=>$row,
                  $row1['item_use_date']=>$row1
                );
              }
             


            }
          }
        }

      }


      }
    }
    echo json_encode($itemWarrantyArray);
    // echo "<pre>";
    // print_r($itemWarrantyArray);
    // die();
   
  }
  public function sendItemForRating(){
    $req_id=$this->input->post("req_id");
    $family_id=$this->input->post("family_id");
          $this->db->select("*");
          $this->db->where("form_id","1690450752274");
          $this->db->where("req_id",$req_id);
    $data=$this->db->get("form_data");
    $result=$data->result_array();
    if(count($result)>0){
      foreach($result as $data){
      $this->db->insert("form_data_clone",$data);
      }
    }
    $dataRating = array(
    'rating' => null,
    'status'=>"Pending",
    "send_for_rating"=>"1"
    );

    $this->db->where('req_id', $req_id);
    $this->db->where('form_id', '1690450752274');
    $this->db->where('family_id', $family_id);
    $this->db->update('form_data', $dataRating);
    if($this->db->affected_rows()>0){
      echo "200";
    }
    else{
      echo "error occured";
    }
  }


  public function reportsRailway( $form_id ){

    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);

    $this->db = $this->load->database("default",TRUE);  
  //  $this->db->cache_on();
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title_report;
    $form_for = $form_res->row()->form_for;
  //   $this->db->cache_off();
   //  $this->db->cache_on();
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
 //   $this->db->cache_off();
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE ( approve_id='%s' OR approve_id IS NULL))",$this->session->userdata("id"));
      if($form_id=="1690450752274"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }

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
    // echo "<pre>";
    // print_r($data2);
    // die();
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

    $count_row=0;
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
            $bulk_rating='';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button' class='btn bg-black btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='0' data-familyid='$row->family_id'>0<i class='material-icons'>star_rate</i><button type='button' class='btn bg-red btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='1' data-familyid='$row->family_id'>1<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-amber btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='2' data-familyid='$row->family_id'>2<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-light-green btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='3' data-familyid='$row->family_id'>3<i class='material-icons'>star_rate</i></button></div>";

              $bulk_rating="<div class='icon-button-demo' style='display: inline-flex;'>
                  <div class='checkbox-wrapper'>
                      <input type='checkbox' class='checkbox bg-teal' data-status='Verified' value='{$row->req_id}' id='checkbox_{$row->req_id}' data-familyid='{$row->family_id}' />
                      <label for='checkbox_{$row->req_id}' class='checkbox-label'></label>
                  </div>
                  <input type='text' class='remarks-input' placeholder='Add remarks...' />
              </div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
              $bulk_rating="<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
            }
            $data[$row->req_id]["Rating Status"] = $status_1;
            $data[$row->req_id]["bulk_rating"]=$bulk_rating;
            $key_label["Rating Status"] = "Rating Status";
            $keys["Rating Status"] = "Rating Status";
          }else{
            $status_1 = '';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'>
                  <div class='checkbox-wrapper'>
                      <input type='checkbox' class='checkbox bg-teal' data-status='Verified' value='{$row->req_id}' id='checkbox_{$row->req_id}' />
                      <label for='checkbox_{$row->req_id}' class='checkbox-label'></label>
                  </div>
                  <input type='text' class='remarks-input' placeholder='Add remarks...' />
              </div>";
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
          $bulk_rating='';
          if( $row->status == "Pending" ){
            $status_1 .= "<span class='font-bold col-pink'>Pending</span>";
            $bulk_rating .= "<span class='font-bold col-pink'>Pending</span>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
            $bulk_rating .= "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $key_label["Status"] = "Status";
          $keys["Status"] = "Status";
          $data[$row->req_id]["bulk_rating"] = $bulk_rating;
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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      $data[$row->req_id]["child_id"]=$row->child_id;
      // $count_row+=1;
      //   if($count_row>100){
      //     break;
      //   }
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    //echo $this->session->userdata("type"); 
    // echo "<pre>";
    // print_r($data);
    // die();
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if($this->session->userdata("type")=="dept" && $form_id=="1690365766"){
      $typeOfStatus="Status";
    }
    $new_data=array();
    $warrantyStatus='';
    $uom='';
    if($form_id=="1690450752274"){
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
          if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id'],
                  "bulk_rating"=>$row['bulk_rating']
                )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id'],
                  "bulk_rating"=>$row['bulk_rating']
              )
              );

          }
        }
      }else{
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
           if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
                  
              )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
              )
              );

          }
        }
      }

    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  
    // echo "<pre>";
    // print_r($new_data);
    // die();
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
     // echo "<pre>";
    $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom",$typeOfStatus,"work_code","warranty_status","child_id","approve_id"];
    if($form_id=="1690450752274"){
      $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom","1690450752274_2","work_code","warranty_status","Work_Done_Status",$typeOfStatus,"bulk_rating","child_id","approve_id"];
    }

    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("approve_id IS NOT NULL");
      $this->db->where("field_id","1690365766_1");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }
    // foreach($keys as $key){
    //   echo $key;
    // }
    // echo "<pre>";
    // print_r($new_data);
    // die();
    $query_1=$this->db->select("username,train_number")->get("railway_mapping");
    $intent['railway_trains']=$query_1->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = $form_title;
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newData"] = $new_data;
    $intent['newKeys']=$newKeys;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "data_sheet".$form_id;
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/data_sheet";
    $intent["footerJs"]    = "view/reports/data_sheetJs";
    if($form_id=="1690450752274"){
    $intent["mainContent"] = "view/reports/work_rating";
    $intent["footerJs"]    = "view/reports/work_ratingJs";
    }
    $this->load->view("view/include/template",$intent);
  }

  public function reportsWorkOrder( $form_id ){

    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);

    $this->db = $this->load->database("default",TRUE);  
  //  $this->db->cache_on();
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title_report;
    $form_for = $form_res->row()->form_for;
  //   $this->db->cache_off();
   //  $this->db->cache_on();
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
 //   $this->db->cache_off();
    $location = $this->session->userdata('location');
    // echo $this->session->userdata("type");
    // print_r($this->session->userdata('train_numbers'));
    // die();

    if( $this->session->userdata("type") == "dept"){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      if($form_id=="1690365766"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }

      //echo $wherestr;

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("status","Verified")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("status","Verified")
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

    $count_row=0;
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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }

    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    //echo $this->session->userdata("type"); 
    // echo "<pre>";
    // print_r($data);
    // die();
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if($this->session->userdata("type")=="dept" && $form_id=="1690365766"){
      $typeOfStatus="Status";
    }
    $new_data=array();
    $warrantyStatus='';
    $uom='';
    foreach($data as $req_id=>$row){
             $item_name='';
             $item_quantity='';
             $coach_type='';
             $coach_no='';
             $warrantyStatus='';
             $uom='';
             if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
                 $coachParts=explode("|",$row['1690365766_2']);
                 if(count($coachParts)>1){
                  $coach_type=$coachParts[1];
                  $coach_no=$coachParts[0];
                 }else{
                  $coach_no=$coachParts[0];
                 }
             }
             if(count($row['item_list'])>0){
              foreach($row['item_list'] as $row2){
                $warrantyStatus='';
                $uom='';
                $itemWithUom=explode("|",$row2['item_name']);
                $item_name=$itemWithUom[0];
                $uom=$itemWithUom[count($itemWithUom)-1];
                $item_quantity=$row2['item_quantity'];
                foreach($itemWithWarranty as $itemWarranty){
                    if($itemWarranty['item_name']==$item_name){
                      $warrantyDay=(int)$itemWarranty['warranty_days'];
                      $currDate=new DateTime();
                      $itemUseDate=new DateTime($row['item_use_date']);
                      $interval=$currDate->diff($itemUseDate);
                      if($interval->days>$warrantyDay){
                        $warrantyStatus=0;
                      }else{
                        $warrantyLeftInDays=$warrantyDay-$interval->days;
                        $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                      }
                    }
                }
                $new_data[]=array(
                  $req_id=>array(
                    $typeOfStatus=>$row[$typeOfStatus],
                    "1690365766_1"=>$row['1690365766_1'],
                    "1690365766_2"=>$coach_no,
                    "coach_type"=>$coach_type,
                    "1690365766_3"=>$row['1690365766_3'],
                    "1690365766_4"=>$row['1690365766_4'],
                    "1690365766_5"=>$row['1690365766_5'],
                    "1690365766_6"=>$row['1690365766_6'],
                    "updated"=>$row['updated'],
                    "system_family_id"=>$row['system_family_id'],
                    "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                    "item_name"=>$item_name,
                    "item_quantity"=>$item_quantity,
                    "work_code"=>$row['work_code'],
                    "warranty_status"=>$warrantyStatus,
                    "uom"=>$uom,
                    "child_id"=>$row['child_id'],
                    "approve_id"=>$row['approve_id']
                    
                )
                );

              }
            }else{
              $new_data[]=array(
                  $req_id=>array(
                    $typeOfStatus=>$row[$typeOfStatus],
                    "1690365766_1"=>$row['1690365766_1'],
                    "1690365766_2"=>$coach_no,
                    "coach_type"=>$coach_type,
                    "1690365766_3"=>$row['1690365766_3'],
                    "1690365766_4"=>$row['1690365766_4'],
                    "1690365766_5"=>$row['1690365766_5'],
                    "1690365766_6"=>$row['1690365766_6'],
                    "updated"=>$row['updated'],
                    "system_family_id"=>$row['system_family_id'],
                    "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                    "item_name"=>$item_name,
                    "item_quantity"=>$item_quantity,
                    "work_code"=>$row['work_code'],
                    "warranty_status"=>$warrantyStatus,
                    "uom"=>$uom,
                    "child_id"=>$row['child_id'],
                    "approve_id"=>$row['approve_id']
                )
                );

            }
          
    }

    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    } 
    

    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
     // echo "<pre>";
    $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom",$typeOfStatus,"work_code","warranty_status","child_id","approve_id"];
    if($form_id=="1690450752274"){
      $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom","1690450752274_2","work_code","warranty_status","Work_Done_Status","child_id","approve_id"];
    }
    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("approve_id IS NOT NULL");
      $this->db->where("field_id","1690365766_1");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }
    // foreach($keys as $key){
    //   echo $key;
    // }
    // echo "<pre>";
    // print_r($new_data);
    // die();
    $query_1=$this->db->select("username,train_number")->get("railway_mapping");
    $intent['railway_trains']=$query_1->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Work Order Report";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newData"] = $new_data;
    $intent['newKeys']=$newKeys;
    //$intent["summary"] = $summary;
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "work_order";
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/work_order_report";
    $intent["footerJs"]    = "view/reports/work_order_reportJs";
    $this->load->view("view/include/template",$intent);
  }

  public function filterData($form_id){
    $trainNo=$this->input->post("trainNo");
    $date=$this->input->post("date");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");
    if(empty($time1) && empty($time2)){
       $sql = "SELECT field,value FROM `form_data` WHERE family_id IN 
                    (SELECT family_id FROM form_data WHERE DATE(update_datetime)=? AND field='Train Number*' AND value=? AND form_id=?)";

        $query = $this->db->query($sql, array($date, $trainNo,$form_id));


    $result = json_encode($query->result()); // Retrieve the results
    print_r($result);
    } elseif (!empty($time1) && !empty($time2) && !empty($trainNo) && !empty($date)) {
      $sql = "SELECT field, value 
                    FROM `form_data` 
                    WHERE family_id IN (
                        SELECT family_id 
                        FROM form_data 
                        WHERE DATE(update_datetime) = ? 
                            AND field = 'Train Number*' 
                            AND value = ? 
                            AND form_id=?
                            AND TIME(update_datetime) > ? 
                            AND TIME(update_datetime) < ?
                    )";

        $query = $this->db->query($sql, array($date, $trainNo,$form_id,$time1,$time2));


    $result = json_encode($query->result()); // Retrieve the results
    print_r($result);
    }

  }

  public function filterWorkOrder( $form_id,$trainNo="",$dateFilter='',$time1='',$time2='' ){


    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);
    $dateFilter=$this->input->post("date");
    $trainNo=$this->input->post("trainNo");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");

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

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690365766" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690365766" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }
      if($this->session->userdata("type") == "admin"){
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
       }

      if($train_numbers=="0" && $this->session->userdata("type") == "admin"){
          $wherestr = "family_id IN (SELECT DISTINCT family_id FROM form_data)";
        }
    

        $sql = "SELECT child_id, geo_loc, create_datetime, update_datetime, value, req_id, field_id, status, family_id, member_id, location, rating, approve_datetime, rating_datetime,approve_id
        FROM form_data
        WHERE form_id = ?
          AND $wherestr
          AND status='Verified'
          AND location LIKE ?";
      $params[]=$form_id;
      $params[]=$location."%";
      if(isset($dateFilter) && !empty($dateFilter)){
        $sql.=" AND DATE(update_datetime) = ? ";
        $params[]=$dateFilter;
        
      }
      if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2)){
        $sql.=" AND TIME(update_datetime)>= ? AND TIME(update_datetime)<= ? ";
        $params[]=$time1;
        $params[]=$time2;
        
      }
      $sql.=" ;";
      // echo $sql;
      // print_r($params);
      // die();
      $data_res=$this->db->query($sql,$params);
    }else{
      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if($this->session->userdata("type")=="dept" && $form_id=="1690365766"){
      $typeOfStatus="Status";
    }
    $new_data=array();
    $warrantyStatus='';
    $uon='';
    if($form_id!="1690365766"){
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
           if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
              )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
              )
              );

          }
        }
      }else{
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
           if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
                  
              )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
              )
              );

          }
        }
      }
      foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    } 
    $result=json_encode($new_data);
    print_r($result);
  }

  public function viewFormDataCheck( $form_id,$trainNo="",$dateFilter='',$time1='',$time2='' ){


    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);
    $dateFilter=$this->input->post("date");
    $trainNo=$this->input->post("trainNo");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");

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

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      // $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690365766" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  (approve_id='%s' OR approve_id IS NULL))",$this->session->userdata("id"));
      }
      if($form_id=="1690365766" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690450752274" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      }
      if($this->session->userdata("type") == "admin"){
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
      }

      if($train_numbers=="0" && $this->session->userdata("type") == "admin"){
          $wherestr = "family_id IN (SELECT DISTINCT family_id FROM form_data)";
      }
      // echo $wherestr;
      // die();
        if(!empty($dateFilter)){
          $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                           ->where("form_id",$form_id)
                           ->where("DATE(update_datetime)",$dateFilter)
                           ->where("$wherestr",null)
                           ->where("location like '$location%'",null)
                           ->order_by("update_datetime","DESC")
                           ->get('form_data');
        }else{
          $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                           ->where("form_id",$form_id)
                           ->where("$wherestr",null)
                           ->where("location like '$location%'",null)
                           ->order_by("update_datetime","DESC")
                           ->get('form_data');
        }
    }else{
      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
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
    //print_r($data_res->result());
    // print_r($params);
    //die();
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

    $count_row=0;
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
            $bulk_rating='';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'><button type='button'  class='btn bg-black btn-circle waves-effect waves-circle waves-float rating-button' data-status='Verified' data-rating='0' >0<i class='material-icons'>star_rate</i><button type='button' class='btn bg-red btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='1' data-familyid='$row->family_id'>1<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-amber btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='2' data-familyid='$row->family_id'>2<i class='material-icons'>star_rate</i></button><button type='button' class='btn bg-light-green btn-circle waves-effect waves-circle waves-float status_action_rating' data-status='Verified' value='$row->req_id' data-rating='3' data-familyid='$row->family_id'>3<i class='material-icons'>star_rate</i></button></div>";

              $bulk_rating="<div class='icon-button-demo' style='display: inline-flex;'>
                  <div class='checkbox-wrapper'>
                      <input type='checkbox' class='checkbox bg-teal' data-status='Verified' value='{$row->req_id}' id='checkbox_{$row->req_id}' data-familyid='{$row->family_id}' />
                      <label for='checkbox_{$row->req_id}' class='checkbox-label'></label>
                  </div>
                  <input type='text' class='remarks-input' placeholder='Add remarks...' />
              </div>";
            }
            if( $row->status == "Verified" ){
              $status_1 .= "<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
              $bulk_rating .= "<span class='font-bold'>$row->rating<i class='material-icons'>star_rate</i></span>";
            }
            $data[$row->req_id]["bulk_rating"] = $bulk_rating;
            $data[$row->req_id]["Rating Status"] = $status_1;
            $key_label["Rating Status"] = "Rating Status";
            $keys["Rating Status"] = "Rating Status";
          }else{
            $status_1 = '';
            if( $row->status == "Pending" ){
              $status_1 .= "<div class='icon-button-demo' style='display: inline-flex;'>
                  <div class='checkbox-wrapper'>
                      <input type='checkbox' class='checkbox bg-teal' data-status='Verified' value='{$row->req_id}' id='checkbox_{$row->req_id}' />
                      <label for='checkbox_{$row->req_id}' class='checkbox-label'></label>
                  </div>
                  <input type='text' class='remarks-input' placeholder='Add remarks...' />
              </div>";
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
          $bulk_rating='';
          if( $row->status == "Pending" ){
            $status_1 .= "<span class='font-bold col-pink'>Pending</span>";
            $bulk_rating= "<span class='font-bold col-pink'>Pending</span>";
          }
          if( $row->status == "Verified" ){
            $status_1 .= "<span class='font-bold col-teal'>Verified</span>";
            $bulk_rating = "<span class='font-bold col-teal'>Verified</span>";
          }
          $data[$row->req_id]["Status"] = $status_1;
          $data[$row->req_id]["bulk_rating"] = $bulk_rating;
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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
      }
      
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
      $count_row+=1;
        if($count_row>100){
          break;
      }
      
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if($this->session->userdata("type")=="dept" && $form_id=="1690365766"){
      $typeOfStatus="Status";
    }
    $new_data=array();
    $warrantyStatus='';
    $uon='';
    if($form_id!="1690365766"){
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
           if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id'],
                  "bulk_rating"=>$row['bulk_rating']
              )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690450752274_2"=>$row['1690450752274_2'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "1690365766_1"=>$row['1690365766_1'],
                  "Railway_Status"=>$row['Railway_Status'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "Rating_Datetime"=>$row['Rating_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "Work_Done_Status"=>$row['Work_Done_Status'],
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id'],
                  "bulk_rating"=>$row['bulk_rating']
              )
              );

          }
        }
    }else{
        foreach($data as $req_id=>$row){
           $item_name='';
           $item_quantity='';
           $coach_type='';
           $coach_no='';
           $warrantyStatus='';
           $uom='';
           if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
               $coachParts=explode("|",$row['1690365766_2']);
               if(count($coachParts)>1){
                $coach_type=$coachParts[1];
                $coach_no=$coachParts[0];
               }else{
                $coach_no=$coachParts[0];
               }
           }
           if(count($row['item_list'])>0){
            foreach($row['item_list'] as $row2){
              $warrantyStatus='';
              $uom='';
              $itemWithUom=explode("|",$row2['item_name']);
              $item_name=$itemWithUom[0];
              $uom=$itemWithUom[count($itemWithUom)-1];
              $item_quantity=$row2['item_quantity'];
              foreach($itemWithWarranty as $itemWarranty){
                  if($itemWarranty['item_name']==$item_name){
                    $warrantyDay=(int)$itemWarranty['warranty_days'];
                    $currDate=new DateTime();
                    $itemUseDate=new DateTime($row['item_use_date']);
                    $interval=$currDate->diff($itemUseDate);
                    if($interval->days>$warrantyDay){
                      $warrantyStatus=0;
                    }else{
                      $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                    }
                  }
              }
              $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
                  
              )
              );

            }
          }else{
            $new_data[]=array(
                $req_id=>array(
                  $typeOfStatus=>$row[$typeOfStatus],
                  "1690365766_1"=>$row['1690365766_1'],
                  "1690365766_2"=>$coach_no,
                  "coach_type"=>$coach_type,
                  "1690365766_3"=>$row['1690365766_3'],
                  "1690365766_4"=>$row['1690365766_4'],
                  "1690365766_5"=>$row['1690365766_5'],
                  "1690365766_6"=>$row['1690365766_6'],
                  "updated"=>$row['updated'],
                  "system_family_id"=>$row['system_family_id'],
                  "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
                  "item_name"=>$item_name,
                  "item_quantity"=>$item_quantity,
                  "work_code"=>$row['work_code'],
                  "warranty_status"=>$warrantyStatus,
                  "uom"=>$uom,
                  "child_id"=>$row['child_id'],
                  "approve_id"=>$row['approve_id']
              )
              );

          }
        }
      }
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  
    $result=json_encode($new_data);
    print_r($result);
  }
  public function filterDataSheetHistory($form_id){


    ini_set('memory_limit', '-1');
    //$this->output->cache(5);
    //$this->output->enable_profiler(TRUE);
    $coach_no=$this->input->post("coachNo");
    $trainNo=$this->input->post("trainNo");
    $berth=$this->input->post("berth");
    $work_status=$this->input->post("workStatus");
    $dateFilter=$this->input->post("date");
    $workCategory=$this->input->post("category");

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
    // echo $location;
    // die();
    if($this->session->userdata("type")=="dept" || $this->session->userdata("type") == "admin"){
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690450752274" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }
      if($this->session->userdata("type") == "admin"){
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
       }

      if($train_numbers=="0" && $this->session->userdata("type") == "admin"){
          $wherestr = "family_id IN (SELECT DISTINCT family_id FROM form_data)";
        }

        $sql = "SELECT child_id, geo_loc, create_datetime, update_datetime, value, req_id, field_id, status, family_id, member_id, location, rating, approve_datetime, rating_datetime
        FROM form_data
        WHERE form_id = ?
          AND $wherestr
          AND location LIKE ?";
      $params[]=$form_id;
      $params[]=$location."%";

      if (!empty($coach_no)) {
          $sql .= " AND family_id IN (SELECT family_id FROM form_data where field_id = '1690365766_2' AND value = ?)";
          $params[] = $coach_no;
      }

      if (!empty($work_status)) {
          $sql .= " AND family_id IN (SELECT family_id FROM form_data where field_id = '1690365766_6' AND value = ?)";
          $params[] = $work_status;
      }
      if (!empty($berth)) {
        $sql .= " AND family_id IN (SELECT family_id FROM form_data where field_id = '1690365766_4' AND value = ?)";
          $params[] = $berth;
      }
      if(!empty($dateFilter)){

        $sql.=" AND DATE(update_datetime) = ? ";
        $params[]=$dateFilter;
      }

      
      
      // echo $sql;
      // print_r($params);
      // die();
      $data_res = $this->db->query($sql, $params);
    }else{
      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }

    // echo "<pre";
    // print_r($data_res->result());
    // die();
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime,DATE(update_datetime) as update_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $work_date='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $work_date = isset($row->create_datetime) ? new DateTime($row->create_datetime): '';
      if(!empty($work_date)){
        $work_date=$work_date->format('Y-m-d');
      }
      $create_datetime = !empty($row->create_datetime) ? new DateTime($row->create_datetime) : null;
      $update_datetime = !empty($row->update_datetime) ? new DateTime($row->update_datetime) : null;

      if (!empty($create_datetime) && !empty($update_datetime)) {
          $interval = $create_datetime->diff($update_datetime);
          if ($interval->days > 180) {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
          } else {
              $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-teal'>Yes</span>";
          }
      } else {
          $data[$row->req_id]["is_six_month"] = "<span class='font-bold col-red'>No</span>";
      }
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id]["work_date"]=$work_date;
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
      
    }
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if($row['1690450752274_2']=="Done"){
        $data[$req_id]["Work_Done_Status"]="Done";
      }else{
        $data[$req_id]["Work_Done_Status"]="Not Done";
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if($this->session->userdata("type")=="dept" && $form_id=="1690365766"){
      $typeOfStatus="Status";
    }
    $new_data=array();
    $uom='';
    $warrantyStatus='';
    foreach($data as $req_id=>$row){
       $item_name='';
       $item_quantity='';
       $uom='';
       $work_category='';
       $workParts=explode("|",$row['1690365766_5']);
          if(count($workParts)>1){
            $work_category_parts=explode("-",$workParts[0]);
            if(count($work_category_parts)>1){
              $work_category=$work_category_parts[1];
            }else{
              $work_category=$workParts[0];
            }

          }else{
            $work_category='';
          }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          $warrantyStatus='';
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$row['1690365766_2'],
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "work_category"=>$work_category,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$row['1690365766_2'],
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "is_six_month"=>$row['is_six_month'],
              "work_date"=>$row['work_date'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "work_category"=>$work_category,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

      }
    }
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  
    $filterdCategoryData=array();
    if(empty($workCategory)){
      $result=json_encode($new_data);
      print_r($result);
    }else{
      foreach($new_data as $data){
        foreach($data as $req_id=>$row){
          if($row['work_category']==$workCategory){
            $filterdCategoryData[]=array(
              $req_id=>$row
            );
          }
        }
      }
      print_r(json_encode($filterdCategoryData));
    }
  }

  public function reportBilling( $form_id ){

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
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      if($form_id=="1690450752274"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }
      //echo $wherestr;

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }

    // echo "<pre>";
    // print_r($data_res->result());
    // die();
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    //print_r($data2);
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';

      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
        
    }

    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $toalRatingAMount=0;
    $totalAmount=0;
    $amt='';
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){

        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"]) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workWithCode=explode("$",$workList);
        $workListParts=explode("@",$workWithCode[0]);
        if(count($workListParts)>1){
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
          if($percentage>85){
            $final_amt=$amt;
          }else if(($percentage<=85) && ($percentage>75)){
            $final_amt=$amt-($amt*5)/100;
          }else if(($percentage<=75) && ($percentage>65)){
            $final_amt=$amt-($amt*10)/100;
          }else if(($percentage<=65) && ($percentage>=55)){
            $final_amt=$amt-($amt*20)/100;
          }else if($percentage<55){
            $final_amt=$amt-($amt*40)/100;
          }
          $data[$req_id]["amt_before_rating"]=$amt;
          $data[$req_id]["final_amt"]=$final_amt;
          $toalRatingAMount+=$final_amt;
        }else{
          $data[$req_id]["final_amt"]="";
          $data[$req_id]["amt_before_rating"]=$amt;
        }
      }else{
        $data[$req_id]["final_amt"]="";
        $data[$req_id]["amt_before_rating"]=$amt;
      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    // echo "<pre>";
    // print_r($data);
    
    // die();
    $new_data=array();
    $uom='';
    $TotalamtBeforeRatingIntoQuant=0;
    $TotalamtAfterRatingIntoQuant=0;
    foreach($data as $req_id=>$row){
       $warrantyStatus='';
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $uom='';
       $finalAmtIntoQuantity='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $warrantyStatus='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          if(isset($row['final_amt']) && !empty($row['final_amt'])){
            $finalAmtIntoQuantity=(int)$item_quantity*(int)$row['final_amt'];
            $TotalamtAfterRatingIntoQuant+=$finalAmtIntoQuantity;
          }else{
            $finalAmtIntoQuantity='';
          }
          
          if(isset($row['amt_before_rating']) && !empty($row['amt_before_rating'])){
            $amtBeforeRatingIntoQuant=(int)$item_quantity*(int)$row['amt_before_rating'];
            $TotalamtBeforeRatingIntoQuant+=$amtBeforeRatingIntoQuant;
          }else{
            $amtBeforeRatingIntoQuant='';
          }
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "finalAmtIntoQuantity"=>"",
              "amtBeforeRatingIntoQuant"=>""
          )
          );

      }
    }
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  
    // echo "<pre>";
    // print_r($ratingAverage);
   
    // die();
    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("approve_id IS NOT NULL");
      $this->db->where("field_id","1690365766_1");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }

    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
    $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom","1690450752274_2","Work_Done_Status","amtBeforeRatingIntoQuant","rating","finalAmtIntoQuantity","work_code","warranty_status","child_id","approve_id"];
    // echo "<pre>";
    // print_r($new_data);
 
    // die();
    $query_1=$this->db->select("username,train_number")->get("railway_mapping");
    $intent['railway_trains']=$query_1->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Billing Report";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newdata"] = $new_data;
    $intent['newKeys']=$newKeys;
    $intent["ratingAverage"] = $ratingAverage;
    $intent["toalRatingAMount"] = $TotalamtAfterRatingIntoQuant;
    $intent["totalAmount"] = $TotalamtBeforeRatingIntoQuant;    
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "data_sheet_billing";
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/data_sheet_billing";
    $intent["footerJs"]    = "view/reports/data_sheet_billingJs";
    $this->load->view("view/include/template",$intent);
  }
  public function finalBillingReport( $form_id ){

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
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE  approve_id='%s')",$this->session->userdata("id"));
      if($form_id=="1690450752274"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }
      // echo $wherestr;
      // print_r($train_numbers);
      // die();

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->where("billing_status","0")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->where("billing_status","0")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }

    // echo "<pre>";
    // print_r($data_res->result());
    // die();
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    //print_r($data2);
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';

      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
        
    }

    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $toalRatingAMount=0;
    $totalAmount=0;
    $totalRatingGet=0;
    $totalRatingPercent=0;
    $maxRatingWithWork=0;
    $totalPenaltyAmt=0;
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){

        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"]) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workWithCode=explode("$",$workList);
        $workListParts=explode("@",$workWithCode[0]);
        if(count($workListParts)>1){
          $currentRating=(int)$row['rating'];
          $totalRatingGet+=$currentRating;
          $ratingPercent=($currentRating/3)*100;
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
          if($percentage>85){
            $final_amt=$amt;
          }else if(($percentage<=85) && ($percentage>75)){
            $final_amt=$amt-($amt*5)/100;
          }else if(($percentage<=75) && ($percentage>65)){
            $final_amt=$amt-($amt*10)/100;
          }else if(($percentage<=65) && ($percentage>=55)){
            $final_amt=$amt-($amt*20)/100;
          }else if($percentage<55){
            $final_amt=$amt-($amt*40)/100;
          }
          $penaltyAmt=$amt-$final_amt;
          $totalPenaltyAmt+=$penaltyAmt;
          $data[$req_id]["final_amt"]=$final_amt;
          $data[$req_id]["tender_amt"]=$amt;
          $data[$req_id]["rating_percent"]=number_format($ratingPercent,2);
          $data[$req_id]["penalty_amt"]=number_format($penaltyAmt,2);
          $toalRatingAMount+=$final_amt;
          $maxRatingWithWork+=3;
        }else{
          $data[$req_id]["final_amt"]="";
          $data[$req_id]["tender_amt"]="";
          $data[$req_id]["rating_percent"]='';
          $data[$req_id]["penalty_amt"]='';
        }
      }else{
        $data[$req_id]["final_amt"]="";
        $data[$req_id]["tender_amt"]="";
        $data[$req_id]["rating_percent"]='';
        $data[$req_id]["penalty_amt"]='';
      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    // echo "<pre>";
    // print_r($data);
    
    // die();
    $new_data=array();
    $uom='';
    $TotalamtBeforeRatingIntoQuant=0;
    $TotalamtAfterRatingIntoQuant=0;
    $ToalPenaltyAmount=0;
    $ToalAmountToPaidWithQty=0;
    foreach($data as $req_id=>$row){
       $warrantyStatus='';
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $uom='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $warrantyStatus='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          if(isset($row['final_amt']) && !empty($row['final_amt']) && isset($row['tender_amt']) && !empty($row['tender_amt'])){
            $finalAmtIntoQuantity=(int)$item_quantity*(int)$row['final_amt'];
            $TotalamtAfterRatingIntoQuant+=$finalAmtIntoQuantity;
            $amtBeforeRatingIntoQuant=(int)$item_quantity*(int)$row['tender_amt'];
            $TotalamtBeforeRatingIntoQuant+=$amtBeforeRatingIntoQuant;
            $penaltyAmtWithQty=$amtBeforeRatingIntoQuant-$finalAmtIntoQuantity;
            $ToalAmountToPaidWithQty+=$finalAmtIntoQuantity;
            $ToalPenaltyAmount+=$penaltyAmtWithQty;
          }else{
            $finalAmtIntoQuantity='';
            $amtBeforeRatingIntoQuant='';
            $penaltyAmtWithQty='';
          }
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus="<span class='font-bold col-pink'>Not In Warranty</span>";
                }else{
                  $warrantyStatus="<span class='font-bold col-teal'>In Warranty</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant,
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>$penaltyAmtWithQty,
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant,
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>$penaltyAmtWithQty,
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty
          )
          );

      }
    }
    // echo "<pre>";
    // print_r($ratingAverage);
   
    // die();
    if($maxRatingWithWork!=0){
      $totalRatingPercent=($totalRatingGet/$maxRatingWithWork)*100;
    }else{
      $totalRatingPercent=0;
    }
    
   
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
    $newKeys=['1690365766_1','updated','1690365766_2',"work_code","1690365766_4","item_quantity","max_rating","rating","rating_percent","amtBeforeRatingIntoQuant","penaltyAmtWithQty","finalAmtIntoQuantity"];
    $this->db->distinct();
    $this->db->select("value");
    $this->db->from("form_data");
    $this->db->where("field_id","1690365766_1");
    $query_1=$this->db->get();
    $result_trains=$query_1->result_array();

    $this->db->distinct();
    $this->db->select('value');
    $this->db->from('form_data');
    $this->db->where('field_id', '1690365766_7');
    $this->db->where('rating IS NOT NULL', null, false);
    $date_query = $this->db->get();
    $intent['date']=$date_query->result_array();

    $this->db->distinct();
    $this->db->select('value');
    $this->db->from('form_data');
    $this->db->where('field_id', '1690365766_8');
    $this->db->where('rating IS NOT NULL', null, false);
    $time1_query = $this->db->get();
    $intent['time1']=$time1_query->result_array();

    $this->db->distinct();
    $this->db->select('value');
    $this->db->from('form_data');
    $this->db->where('field_id', '1690365766_9');
    $this->db->where('rating IS NOT NULL', null, false);
    $time2_query = $this->db->get();
    $intent['time2']=$time2_query->result_array();

    $this->db->distinct();
    $this->db->select('value,approve_id');
    $this->db->from('form_data');
    $this->db->where("field_id","1690365766_1");
    $this->db->where('approve_id',$this->session->userdata("id"));
    $train_dropdown_query = $this->db->get();
    $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();
    if($this->session->userdata("type")=="admin"){
      $this->db->distinct();
      $this->db->select('value,approve_id');
      $this->db->from('form_data');
      $this->db->where("field_id","1690365766_1");
      $this->db->where("approve_id IS NOT NULL");
      $train_dropdown_query = $this->db->get();
      $intent['train_numbers_dropdown']=$train_dropdown_query->result_array();

    }

    $train_numbers_string = $this->session->userdata('train_numbers');
    $train_numbers_dropdown=explode(",",$train_numbers_string);
    // print_r($train_numbers_dropdown);
    // die();
    if($this->session->userdata("type")=="dept"){
      $intent['railway_trains']=$train_numbers_dropdown;
    }else{
      $intent['railway_trains']=$result_trains;
    }
    
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Billing Report";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newdata"] = $new_data;
    $intent['newKeys']=$newKeys;
    $intent["ratingAverage"] = $ratingAverage;
    $intent["toalRatingAMount"] = $ToalAmountToPaidWithQty;
    $intent["totalAmount"] = $TotalamtBeforeRatingIntoQuant; 
    $intent["totalRatingGot"] = $totalRatingGet;  
    $intent["total_max_rating"] = $maxRatingWithWork;  
    $intent["toal_penalty_amt"] = $ToalPenaltyAmount;  
    $intent["totalRatingPercent"] = number_format($totalRatingPercent,2);  
    $intent["last_date"] = $last_date;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "final_billing_report";
    $intent["headerCss"]   = "view/reports/data_sheetCss";
    $intent["mainContent"] = "view/reports/final_billing_report";
    $intent["footerJs"]    = "view/reports/final_billing_reportJs";
    $this->load->view("view/include/template",$intent);
  }

  public function printFilterFinalBillingReport( $form_id ){
    $trainNo=$this->input->post("trainNo");
    $date=$this->input->post("date");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");

    ini_set('memory_limit', '-1');
    $this->db = $this->load->database("default",TRUE);  
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){ 
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $params=[];
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      // $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if(!empty($trainNo) && $this->session->userdata("type") == "admin"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
      }
      // echo $wherestr;
      // die();
      //$new_params = [$date, $time1, $time2, $trainNo, $location . "%",$form_id];
      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("DATE(update_datetime)",$date)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->where("billing_status","0")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("DATE(update_datetime)",$date)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    //print_r($data2);
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();
    $family_ids=[];

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
      $family_ids[]=$row->family_id;
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';

      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
        
    }
    if(count($data)==0){
      echo "404";
      die();
    }
    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $toalRatingAMount=0;
    $totalAmount=0;
    $totalRatingGet=0;
    $totalRatingPercent=0;
    $maxRatingWithWork=0;
    $totalPenaltyAmt=0;
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){

        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"]) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workWithCode=explode("$",$workList);
        $workListParts=explode("@",$workWithCode[0]);
        if(count($workListParts)>1){
          $currentRating=(int)$row['rating'];
          $totalRatingGet+=$currentRating;
          $ratingPercent=($currentRating/3)*100;
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
          if($percentage>85){
            $final_amt=$amt;
          }else if(($percentage<=85) && ($percentage>75)){
            $final_amt=$amt-($amt*5)/100;
          }else if(($percentage<=75) && ($percentage>65)){
            $final_amt=$amt-($amt*10)/100;
          }else if(($percentage<=65) && ($percentage>=55)){
            $final_amt=$amt-($amt*20)/100;
          }else if($percentage<55){
            $final_amt=$amt-($amt*40)/100;
          }
          $penaltyAmt=$amt-$final_amt;
          $totalPenaltyAmt+=$penaltyAmt;
          $data[$req_id]["final_amt"]=$final_amt;
          $data[$req_id]["tender_amt"]=$amt;
          $data[$req_id]["rating_percent"]=number_format($ratingPercent,2);
          $data[$req_id]["penalty_amt"]=number_format($penaltyAmt,2);
          $toalRatingAMount+=$final_amt;
          $maxRatingWithWork+=3;
        }else{
          $data[$req_id]["final_amt"]="";
          $data[$req_id]["tender_amt"]="";
          $data[$req_id]["rating_percent"]='';
          $data[$req_id]["penalty_amt"]='';
        }
      }else{
        $data[$req_id]["final_amt"]="";
        $data[$req_id]["tender_amt"]="";
        $data[$req_id]["rating_percent"]='';
        $data[$req_id]["penalty_amt"]='';
      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    if(isset($totalRatingGet) && isset($maxRatingWithWork) && $maxRatingWithWork
      !=0){
      $totalRatingPercent=($totalRatingGet/$maxRatingWithWork)*100;
    }else{
      $totalRatingPercent=0;
    }
    // echo "<pre>";
    // print_r($data);
    
    // die();
    $new_data=array();
    $uom='';
    $username='';
    $child_id='';
    $TotalamtBeforeRatingIntoQuant=0;
    $TotalamtAfterRatingIntoQuant=0;
    $ToalAmountToPaidWithQty=0;
    $ToalPenaltyAmount=0;
    foreach($data as $req_id=>$row){
       $warrantyStatus='';
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $uom='';
       if(!empty($row['approve_id'])){
        $username=$row['approve_id'];
       }
       if(!empty($row['child_id'])){
        $child_id=$row['child_id'];
       }
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $warrantyStatus='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          if(isset($row['final_amt']) && !empty($row['final_amt']) && isset($row['tender_amt']) && !empty($row['tender_amt'])){
            $finalAmtIntoQuantity=(int)$item_quantity*(int)$row['final_amt'];
            $TotalamtAfterRatingIntoQuant+=$finalAmtIntoQuantity;
            $amtBeforeRatingIntoQuant=(int)$item_quantity*(int)$row['tender_amt'];
            $TotalamtBeforeRatingIntoQuant+=$amtBeforeRatingIntoQuant;
            $penaltyAmtWithQty=$amtBeforeRatingIntoQuant-$finalAmtIntoQuantity;
            $ToalAmountToPaidWithQty+=$finalAmtIntoQuantity;
            $ToalPenaltyAmount+=$penaltyAmtWithQty;
          }else{
            $finalAmtIntoQuantity='';
            $amtBeforeRatingIntoQuant='';
            $penaltyAmtWithQty='';
          }
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus="<span class='font-bold col-pink'>Not In Warranty</span>";
                }else{
                  $warrantyStatus="<span class='font-bold col-teal'>In Warranty</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "total_rating_percent"=>$totalRatingPercent,
              "ratingAverage"=>$ratingAverage,
              "toalRatingAMount"=>$toalRatingAMount,
              "totalAmount"=>$totalAmount,
              "totalRatingGot"=>$totalRatingGet,
              "total_max_rating"=>$maxRatingWithWork,
              "toal_penalty_amt"=>$totalPenaltyAmt,
              "totalRatingPercent"=>number_format($totalRatingPercent,2),
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant,
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>$penaltyAmtWithQty,
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "total_rating_percent"=>$totalRatingPercent,
              "ratingAverage"=>$ratingAverage,
              "toalRatingAMount"=>$toalRatingAMount,
              "totalAmount"=>$totalAmount,
              "totalRatingGot"=>$totalRatingGet,
              "total_max_rating"=>$maxRatingWithWork,
              "toal_penalty_amt"=>$totalPenaltyAmt,
              "totalRatingPercent"=>number_format($totalRatingPercent,2),
              "finalAmtIntoQuantity"=>"",
              "amtBeforeRatingIntoQuant"=>"",
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>"",
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty

          )
          );

      }
    }
    // echo $username.$child_id;
    // die();
    if(count($data)>0){
      foreach($data as $req_id=>$row){
        if(isset($row['system_family_id'])){
            $dataForUpdate=array("billing_status"=>"1");
            $this->db->where("family_id",$row['system_family_id']);
            $this->db->update("form_data",$dataForUpdate);
        }
      }
      $this->db->where("train_number", $trainNo);
      $this->db->where("type", "dept");
      $this->db->where_in("username",array($username,$child_id));
      $res = $this->db->get("railway_mapping");
      if(count($res->result_array())>0){
        $batch_data=$res->result_array();
        $this->db->trans_begin();
        $this->db->insert_batch("railway_mapping_history",$batch_data);
        if($this->db->affected_rows()>0){
          $this->db->where("train_number",$trainNo);
          $this->db->delete("railway_mapping");
          if($this->db->affected_rows()>0){
            $this->db->trans_commit();
          }else{
            $this->db->trans_rollback();
          }
        }else{
          $this->db->trans_rollback();
        }
      }
      // echo "<pre>";
      // print_r($res->result_array());
      // die();
    }

    $intent['train_number'] = $trainNo;
    $intent['date']=$date;
    $intent['time1']=$time1;
    $intent['time2']=$time2;
    $intent['newdata']=$new_data;
    $intent['total_max_rating']=$maxRatingWithWork;
    $intent['totalRatingGot']=$totalRatingGet;
    $intent['totalRatingPercent']=number_format($totalRatingPercent,2);
    $intent['totalAmount']=$TotalamtBeforeRatingIntoQuant;
    $intent['toal_penalty_amt']=$ToalPenaltyAmount;
    $intent['toalRatingAMount']=$ToalAmountToPaidWithQty;
    $intent['username']=$username;
    $newKeys=['1690365766_2',"work_code","1690365766_4","item_quantity","max_rating","rating","rating_percent","amtBeforeRatingIntoQuant","penaltyAmtWithQty","TotalamtAfterRatingIntoQuant"];
    $intent['newKeys']=$newKeys;
    $this->load->view('view/reports/final_billing_report_sample', $intent);




  }

  public function filterFinalBillingReport( $form_id ){
    $trainNo=$this->input->post("trainNo");
    $date=$this->input->post("date");
    // $time1=$this->input->post("time1");
    // $time2=$this->input->post("time2");

    ini_set('memory_limit', '-1');
    $this->db = $this->load->database("default",TRUE);  
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){
  
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $params=[];
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if(!empty($trainNo) && $this->session->userdata("type") == "admin"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);
      }
      //$new_params = [$date, $time1, $time2, $trainNo, $location . "%",$form_id];
      // $new_params = [$date,$trainNo,$this->session->userdata("id"),$location . "%"];
      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("DATE(update_datetime)",$date)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->where("rating >",0)
                         ->where("billing_status","0")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
      // $data_res=$this->db->query($sql_1,$new_params);


    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("DATE(update_datetime)",$date)
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    //print_r($data2);
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();
    // if(is_null($data_res->result()){
    //    print_r(json_encode($data_res->result()));
    //   die();
    // }
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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';

      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
        
    }
    // echo "<pre>";
    // print_r($data);
    // die();
    // echo is_null($data);
    if(count($data)==0){
      echo json_encode([]);
      die();
    }
    // die();
    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $toalRatingAMount=0;
    $totalAmount=0;
    $totalRatingGet=0;
    $totalRatingPercent=0;
    $maxRatingWithWork=0;
    $totalPenaltyAmt=0;
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){

        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"]) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workWithCode=explode("$",$workList);
        $workListParts=explode("@",$workWithCode[0]);
        if(count($workListParts)>1){
          $currentRating=(int)$row['rating'];
          $totalRatingGet+=$currentRating;
          $ratingPercent=($currentRating/3)*100;
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
          if($percentage>85){
            $final_amt=$amt;
          }else if(($percentage<=85) && ($percentage>75)){
            $final_amt=$amt-($amt*5)/100;
          }else if(($percentage<=75) && ($percentage>65)){
            $final_amt=$amt-($amt*10)/100;
          }else if(($percentage<=65) && ($percentage>=55)){
            $final_amt=$amt-($amt*20)/100;
          }else if($percentage<55){
            $final_amt=$amt-($amt*40)/100;
          }
          $penaltyAmt=$amt-$final_amt;
          $totalPenaltyAmt+=$penaltyAmt;
          $data[$req_id]["final_amt"]=$final_amt;
          $data[$req_id]["tender_amt"]=$amt;
          $data[$req_id]["rating_percent"]=number_format($ratingPercent,2);
          $data[$req_id]["penalty_amt"]=number_format($penaltyAmt,2);
          $toalRatingAMount+=$final_amt;
          $maxRatingWithWork+=3;
        }else{
          $data[$req_id]["final_amt"]="";
          $data[$req_id]["tender_amt"]="";
          $data[$req_id]["rating_percent"]='';
          $data[$req_id]["penalty_amt"]='';
        }
      }else{
        $data[$req_id]["final_amt"]="";
        $data[$req_id]["tender_amt"]="";
        $data[$req_id]["rating_percent"]='';
        $data[$req_id]["penalty_amt"]='';
      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    // echo "<pre> yes";
    // print_r($data);
    // echo is_null($data);
    // die();
    
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    // echo "<pre>";
    // print_r($data);
    // die();
    if(isset($totalRatingGet) && isset($maxRatingWithWork) && $maxRatingWithWork
      !=0){
      $totalRatingPercent=($totalRatingGet/$maxRatingWithWork)*100;
    }else{
      $totalRatingPercent=0;
    }
    
    $new_data=array();
    $uom='';
    $TotalamtBeforeRatingIntoQuant=0;
    $TotalamtAfterRatingIntoQuant=0;
    $ToalPenaltyAmount=0;
    $ToalAmountToPaidWithQty=0;
    foreach($data as $req_id=>$row){
       $warrantyStatus='';
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $uom='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $warrantyStatus='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          if(isset($row['final_amt']) && !empty($row['final_amt']) && isset($row['tender_amt']) && !empty($row['tender_amt'])){
            $finalAmtIntoQuantity=(int)$item_quantity*(int)$row['final_amt'];
            $TotalamtAfterRatingIntoQuant+=$finalAmtIntoQuantity;
            $amtBeforeRatingIntoQuant=(int)$item_quantity*(int)$row['tender_amt'];
            $TotalamtBeforeRatingIntoQuant+=$amtBeforeRatingIntoQuant;
            $penaltyAmtWithQty=$amtBeforeRatingIntoQuant-$finalAmtIntoQuantity;
            $ToalAmountToPaidWithQty+=$finalAmtIntoQuantity;
            $ToalPenaltyAmount+=$penaltyAmtWithQty;
          }else{
            $finalAmtIntoQuantity='';
            $amtBeforeRatingIntoQuant='';
            $penaltyAmtWithQty='';
          }
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus="<span class='font-bold col-pink'>Not In Warranty</span>";
                }else{
                  $warrantyStatus="<span class='font-bold col-teal'>In Warranty</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "total_rating_percent"=>$totalRatingPercent,
              "ratingAverage"=>$ratingAverage,
              "toalRatingAMount"=>$toalRatingAMount,
              "totalAmount"=>$totalAmount,
              "totalRatingGot"=>$totalRatingGet,
              "total_max_rating"=>$maxRatingWithWork,
              "toal_penalty_amt"=>$totalPenaltyAmt,
              "totalRatingPercent"=>number_format($totalRatingPercent,2),
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant,
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>$penaltyAmtWithQty,
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "max_rating"=>"3",
              "tender_amt"=>$row['tender_amt'],
              "rating_percent"=>$row['rating_percent'],
              "penalty_amt"=>$row['penalty_amt'],
              "total_rating_percent"=>$totalRatingPercent,
              "ratingAverage"=>$ratingAverage,
              "toalRatingAMount"=>$toalRatingAMount,
              "totalAmount"=>$totalAmount,
              "totalRatingGot"=>$totalRatingGet,
              "total_max_rating"=>$maxRatingWithWork,
              "toal_penalty_amt"=>$totalPenaltyAmt,
              "totalRatingPercent"=>number_format($totalRatingPercent,2),
              "finalAmtIntoQuantity"=>"",
              "amtBeforeRatingIntoQuant"=>"",
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant,
              "penaltyAmtWithQty"=>"",
              "ToalPenaltyAmount"=>$ToalPenaltyAmount,
              "ToalAmountToPaidWithQty"=>$ToalAmountToPaidWithQty

          )
          );

      }
    }
    echo json_encode($new_data);


  }

  public function finalBilling( $form_id ){

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

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("$wherestr",null)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("rating IS NOT NULL")
                         ->order_by("update_datetime","DESC")
                         ->get('form_data');
    }

    // echo "<pre>";
    // print_r($data_res->result());
    // die();
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
    // echo "<pre>";
    // print_r($data_res->result());
    // die();
    //print_r($data2);
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';

      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
        
    }

    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $toalRatingAMount=0;
    $totalAmount=0;
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){

        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"]) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workWithCode=explode("$",$workList);
        $workListParts=explode("@",$workWithCode[0]);
        if(count($workListParts)>1){
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
          if($percentage>85){
            $final_amt=$amt;
          }else if(($percentage<=85) && ($percentage>75)){
            $final_amt=$amt-($amt*5)/100;
          }else if(($percentage<=75) && ($percentage>65)){
            $final_amt=$amt-($amt*10)/100;
          }else if(($percentage<=65) && ($percentage>=55)){
            $final_amt=$amt-($amt*20)/100;
          }else if($percentage<55){
            $final_amt=$amt-($amt*40)/100;
          }
          $data[$req_id]["final_amt"]=$final_amt;
          $toalRatingAMount+=$final_amt;
        }else{
          $data[$req_id]["final_amt"]="N/A";
        }
      }else{
        $data[$req_id]["final_amt"]="N/A";
      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    // echo "<pre>";
    // print_r($data);
    
    // die();
    $new_data=array();
    $uom='';
    foreach($data as $req_id=>$row){
       $warrantyStatus='';
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $uom='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $uom='';
          $warrantyStatus='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus="<span class='font-bold col-pink'>Not In Warranty</span>";
                }else{
                  $warrantyStatus="<span class='font-bold col-teal'>In Warranty</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id']
          )
          );

      }
    }
    // echo "<pre>";
    // print_r($ratingAverage);
   
    // die();
   
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";
    $newKeys=['1690365766_1','updated','1690365766_2',"coach_type","1690365766_4","1690365766_5","1690365766_6","item_name","item_quantity","uom","1690450752274_2","Work_Done_Status","amount","Rating Status","final_amt","work_code","warranty_status","child_id","approve_id"];
    // echo "<pre>";
    // print_r($new_data);
 
    // die();
    $query_1=$this->db->select("username,train_number")->get("railway_mapping");
    $intent['railway_trains']=$query_1->result_array();
    $intent['form_id']=$form_id;
    $intent["form_title"] = "Billing Report";
    $intent["key_label"] = $key_label;
    $intent["keys"] = $keys;
    $intent["newdata"] = $new_data;
    $intent['newKeys']=$newKeys;
    $intent["ratingAverage"] = $ratingAverage;
    $intent["toalRatingAMount"] = $toalRatingAMount;
    $intent["totalAmount"] = $totalAmount;    
    $intent["last_date"] = $last_date;;
    $intent["menuActive"] = "data_sheet";
    $intent["subMenuActive"]  = "final_billing";
    $intent["headerCss"]   = "view/reports/final_billingCss";
    $intent["mainContent"] = "view/reports/final_billing";
    $intent["footerJs"]    = "view/reports/data_sheet_billingJs";
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
  public function filterReportbilling( $form_id ){
    $trainNo=$this->input->post("trainNo");
    $date=$this->input->post("date");
    $time1=$this->input->post("time1");
    $time2=$this->input->post("time2");

    ini_set('memory_limit', '-1');
    $this->db = $this->load->database("default",TRUE);  
    $form_res = $this->db->get_where("form_created",["form_id"=>$form_id]);
    $form_title = $form_res->row()->form_title;
    $form_for = $form_res->row()->form_for;
    $key_res = $this->db->select("field,field_id")->group_by("field_id")->order_by("field_id")->get_where("form_data",["form_id"=>$form_id]);
    $location = $this->session->userdata('location');

    if( $this->session->userdata("type") == "dept" || $this->session->userdata("type") == "admin" ){
      
      $train_numbers = $this->session->userdata('train_numbers');
      $train_numbers = strlen($train_numbers)>0?$train_numbers:"0";
      $params=[];
      if(isset($trainNo) && !empty($trainNo)){
        $train_numbers=$trainNo;
      }
      $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR approve_id IS NULL) AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      if($form_id=="1690450752274" && !empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND approve_id='%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$this->session->userdata("id"),$train_numbers);
      }
      if($form_id=="1690450752274" && empty($trainNo)){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE approve_id='%s')",$this->session->userdata("id"));
      }
      //family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND ( approve_id='%s' OR (approve_id IS NULL AND value IN (%s)) ))
       if($train_numbers=="0" && $this->session->userdata("type")=="admin"){
        $wherestr = "family_id IN (SELECT DISTINCT family_id FROM form_data)";
      }
      if(!empty($train_numbers) && $this->session->userdata("type")=="admin"){
        $wherestr = sprintf("family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '%s' AND value IN (%s))",TRAIN_NUMBER_FIELD_ID,$train_numbers);

      }
      // echo $wherestr;
      // die();

        $sql = "SELECT child_id, geo_loc, create_datetime, update_datetime, value, req_id, field_id, status, family_id, member_id, location, rating, approve_datetime, rating_datetime,approve_id
        FROM form_data
        WHERE form_id = ?
          AND $wherestr
          AND rating IS NOT NULL
          AND rating > 0 
          AND location LIKE ?";
      $params[]=$form_id;
      $params[]=$location."%";
      if(isset($date) && !empty($date)){
        $sql.=" AND DATE(update_datetime) = ? ";
        $params[]=$date;
        
      }
      if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2)){
        $sql.=" AND TIME(update_datetime)>= ? AND TIME(update_datetime)<= ? ";
        $params[]=$time1;
        $params[]=$time2;
        
      }
      $sql.=" ;";
      $data_res=$this->db->query($sql,$params);
      // echo $sql;
      // die();

    }else{

      $data_res = $this->db->select("child_id,geo_loc,create_datetime,update_datetime,value,req_id,field_id,status,family_id,member_id,location,rating,approve_datetime,rating_datetime,approve_id")
                         ->where("form_id",$form_id)
                         ->where("location like '$location%'",null)
                         ->where("DATE(update_datetime)",$date)
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
    $itemQuery=$this->db->select("item_name,warranty_days")->get("railway_work");
    $itemWithWarranty=$itemQuery->result_array();

    foreach($data_res->result() as $row){

      if(!isset($data[$row->req_id])){
        $location_arr = explode("|", $row->location);

        if( $this->session->userdata("type") == "dept" ){
          if($form_id==USER_WORK_DONE_ACTION){
            $status_1 = '';
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
        $data[$row->req_id]["updated"] = $row->update_datetime!="0000-00-00 00:00:00"?$row->update_datetime:"";
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
      $this->db->select('field, value,DATE(create_datetime) as create_datetime');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value,DATE(create_datetime) as create_datetime');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      $item_name='';
      $item_quantity='';
      $item_list_array=array();
      $item_use_date='';
      foreach ($result as $item) {

        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        $item_name=$item['value'];

        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
              $item_quantity=$item['value'];

          }
        if(!empty($item_name) && !empty($item_quantity)){
          $item_list_array[]=array(
            "item_name"=>$item_name,
            "item_quantity"=>$item_quantity
          );
        }
        if(isset($item['create_datetime']) && !empty($item['create_datetime'])){
          $item_use_date=$item['create_datetime'];
        }
          
      }
      $data[$row->req_id]["item_use_date"]=$item_use_date;
      $data[$row->req_id]["item_list"]=$item_list_array;
      $data[$row->req_id]["rating"]=$row->rating;

      $data[$row->req_id][$row->field_id] = $row->value;
      if(is_null($row->child_id)){
        $data[$row->req_id]["child_id"] ='';
      }else{
        $data[$row->req_id]["child_id"] = $row->child_id;
      }
    }
    $countRatingAvg=1;
    $ratingTotal=0;
    $ratingAverage=0;
    $totalRatingAmount=0;
    $totalAmount=0;
    $uom='';
    foreach($data as $req_id=>$row){
      $work_code='';
      if(isset($row["1690365766_5"]) && !empty($row["1690365766_5"])){
        $workCodeParts=explode("$",$row['1690365766_5']);
        if(count($workCodeParts)>1){
          $work_code=$workCodeParts[1];
        }
      }
      $data[$req_id]["work_code"]=$work_code;
      if(isset($row["1690365766_5"]) && !empty(isset($row["1690365766_5"])) && isset($row["rating"]) && !empty($row['rating'])){
        $ratingTotal+=(int)$row['rating'];
        $ratingAverage=$ratingTotal/$countRatingAvg;
        // echo "Total Rating is ".$ratingTotal." and average rating now is ".$ratingAverage."<br>";
        $countRatingAvg+=1;
        $workList=$row['1690365766_5'];
        $amt='';
        $workListParts=explode("@",$workList);
        if(count($workListParts)>1){
          $amt=(int)$workListParts[1];
          $totalAmount+=$amt;
          $data[$req_id]["amount"]=$amt;
          $rating=(int)$row['rating'];
          $percentage=($rating/3)*100;
            if($percentage>85){
              $final_amt=$amt;
            }else if(($percentage<=85) && ($percentage>75)){
              $final_amt=$amt-($amt*5)/100;
            }else if(($percentage<=75) && ($percentage>65)){
              $final_amt=$amt-($amt*10)/100;
            }else if(($percentage<=65) && ($percentage>=55)){
              $final_amt=$amt-($amt*20)/100;
            }else if($percentage<55){
              $final_amt=$amt-($amt*40)/100;
            }
          $data[$req_id]["final_amt"]=$final_amt;
          $data[$req_id]["amt_before_rating"]=$amt;
          $totalRatingAmount+=$final_amt;
        }else{
          $data[$req_id]["final_amt"]="";
          $data[$req_id]["amount"]="";
          $data[$req_id]["amt_before_rating"]=$amt;
        }
      }else{
        $data[$req_id]["final_amt"]="";
        $data[$req_id]["amount"]="";
        $data[$req_id]["amt_before_rating"]='';

      }
      if(isset($row["1690450752274_2"])){
        if($row['1690450752274_2']=="Done"){
          $data[$req_id]["Work_Done_Status"]="Done";
        }else{
          $data[$req_id]["Work_Done_Status"]="Not Done";
        }
      }
    }
    // print_r(json_encode($data));
    // die();
    if($this->session->userdata("type")=="dept"){
      $typeOfStatus="Rating Status";
    }else{
      $typeOfStatus="Status";
    }
    $new_data=array();
    $TotalamtAfterRatingIntoQuant=0;
    $TotalamtBeforeRatingIntoQuant=0;
    foreach($data as $req_id=>$row){
       $item_name='';
       $item_quantity='';
       $coach_type='';
       $coach_no='';
       $warrantyStatus='';
       $uom='';
       if(isset($row['1690365766_2']) && !empty($row['1690365766_2'])){
           $coachParts=explode("|",$row['1690365766_2']);
           if(count($coachParts)>1){
            $coach_type=$coachParts[1];
            $coach_no=$coachParts[0];
           }else{
            $coach_no=$coachParts[0];
           }
       }
       if(count($row['item_list'])>0){
        foreach($row['item_list'] as $row2){
          $warrantyStatus='';
          $uom='';
          $itemWithUom=explode("|",$row2['item_name']);
          $item_name=$itemWithUom[0];
          $uom=$itemWithUom[count($itemWithUom)-1];
          $item_quantity=$row2['item_quantity'];
          if(isset($row['final_amt']) && !empty($row['final_amt'])){
            $finalAmtIntoQuantity=(int)$item_quantity*(int)$row['final_amt'];
            $TotalamtAfterRatingIntoQuant+=$finalAmtIntoQuantity;
          }else{
            $finalAmtIntoQuantity='';
          }
          
          if(isset($row['amt_before_rating']) && !empty($row['amt_before_rating'])){
            $amtBeforeRatingIntoQuant=(int)$item_quantity*(int)$row['amt_before_rating'];
            $TotalamtBeforeRatingIntoQuant+=$amtBeforeRatingIntoQuant;
          }else{
            $amtBeforeRatingIntoQuant='';
          }
          foreach($itemWithWarranty as $itemWarranty){
              if($itemWarranty['item_name']==$item_name){
                $warrantyDay=(int)$itemWarranty['warranty_days'];
                $currDate=new DateTime();
                $itemUseDate=new DateTime($row['item_use_date']);
                $interval=$currDate->diff($itemUseDate);
                if($interval->days>$warrantyDay){
                  $warrantyStatus=0;
                }else{
                  $warrantyLeftInDays=$warrantyDay-$interval->days;
                      $warrantyStatus="<span class='font-bold col-teal'>{$warrantyLeftInDays}</span>";
                }
              }
          }
          $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "amount"=>$row['amount'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "ratingAverage"=>number_format($ratingAverage,2),
              "totalRatingAmount"=>number_format($totalRatingAmount,2),
              "totalAmount"=>number_format($totalAmount,2),
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "finalAmtIntoQuantity"=>$finalAmtIntoQuantity,
              "amtBeforeRatingIntoQuant"=>$amtBeforeRatingIntoQuant,
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant
          )
          );

        }
      }else{
        $new_data[]=array(
            $req_id=>array(
              $typeOfStatus=>$row[$typeOfStatus],
              "1690450752274_2"=>$row['1690450752274_2'],
              "updated"=>$row['updated'],
              "system_family_id"=>$row['system_family_id'],
              "1690365766_1"=>$row['1690365766_1'],
              "Railway_Status"=>$row['Railway_Status'],
              "Work_Approved_Datetime"=>$row['Work_Approved_Datetime'],
              "1690365766_2"=>$coach_no,
              "coach_type"=>$coach_type,
              "1690365766_3"=>$row['1690365766_3'],
              "1690365766_4"=>$row['1690365766_4'],
              "1690365766_5"=>$row['1690365766_5'],
              "1690365766_6"=>$row['1690365766_6'],
              "Rating_Datetime"=>$row['Rating_Datetime'],
              "item_name"=>$item_name,
              "item_quantity"=>$item_quantity,
              "rating"=>$row['rating'],
              "amount"=>$row['amount'],
              "final_amt"=>$row['final_amt'],
              "Work_Done_Status"=>$row['Work_Done_Status'],
              "work_code"=>$row['work_code'],
              "warranty_status"=>$warrantyStatus,
              "ratingAverage"=>number_format($ratingAverage,2),
              "totalRatingAmount"=>number_format($totalRatingAmount,2),
              "totalAmount"=>number_format($totalAmount,2),
              "uom"=>$uom,
              "child_id"=>$row['child_id'],
              "approve_id"=>$row['approve_id'],
              "finalAmtIntoQuantity"=>"",
              "amtBeforeRatingIntoQuant"=>"",
              "TotalamtAfterRatingIntoQuant"=>$TotalamtAfterRatingIntoQuant,
              "TotalamtBeforeRatingIntoQuant"=>$TotalamtBeforeRatingIntoQuant
          )
          );

      }
    }
    foreach($new_data as $data){
      foreach($data as $req_id=>$row){
        $trainNo=$row['1690365766_1'];
        $coachNo=$row['1690365766_2'];
        $coachLoc=$row['1690365766_3'];
        $toilt_berth=$row['1690365766_4'];
        $workList=$row['1690365766_5'];
        $item_name=$row['item_name'];
        $family_id=$row['system_family_id'];
        $item_use_date=new DateTime($row['updated']);
        foreach($new_data as &$data1){
          foreach($data1 as $req_id1=>&$row1){
            if($row1['1690365766_1']==$trainNo && $row1['1690365766_2']==$coachNo && $row1['1690365766_3']==$coachLoc && $row1['1690365766_4']==$toilt_berth && $row1['1690365766_5']==$workList && $row1['item_name']==$item_name && $row1['system_family_id']!=$family_id && new DateTime($row1['updated'])>$item_use_date){
              if($row1['warranty_status']!=0){
                $row1['warranty_status']="<span class='font-bold col-teal'>In Warranty</span>";
              }else{
                $row1['warranty_status']="<span class='font-bold col-pink'>Not In Warranty</span>";
              }


            }
          }
        }


      }
    }  
    print_r(json_encode($new_data));
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
      $this->db->select('field, value');
      $this->db->where('family_id', $row->family_id);
      $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
      $query = $this->db->get('form_data_update');
      $result = $query->result_array();
      if(count($result)==0){
              $this->db->select('field, value');
              $this->db->where('family_id', $row->family_id);
              $this->db->where_in('field', array('Item List*', 'Item Quantity*'));
              $query = $this->db->get('form_data');
              $result = $query->result_array();
      }
      $i=1;
      $result_str='';
      foreach ($result as $item) {

        # code...
 
        if ($item['field'] == 'Item List*') {
        $result_str .= $i.'. '.$item['value'] . ' ';
        }elseif ($item['field'] == 'Item Quantity*') {
              $result_str .= "(".$item['value'] .")"."<br>";  // Use PHP_EOL for a new line
              $i+=1;
          }
          
      }
      
      $data[$row->req_id]["item_list"]=$result_str;

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
    $keys['item_list']="item_list";
    $key_label["item_list"]="Item List";

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
  public function updateStatusOfReqBulk(){

    $this->db = $this->load->database("default",TRUE);

    $remarks = $this->input->post("remarks");
    $status = $this->input->post("status");
    $datetime = date("Y-m-d H:i:s");
    $id = $this->session->userdata("id");
    if($status=="Verified"){
      foreach($remarks as $row){
          // $this->db->distinct();
          // $this->db->select("family_id");
          // $this->db->where("req_id",$row['req_id']);
          // $family_id_res_req_id=$this->db->get("form_data");
          // $family_id_for_req_id_array=$family_id_res_req_id->row_array();
          // $family_id_for_req_id=$family_id_for_req_id_array['family_id'];
          // if(empty($family_id_for_req_id)){
          //   die();
          // }
          // $this->db->where("req_id",$row['req_id']);
          // $this->db->update("form_data",["status"=>"Verified","approve_datetime"=>$datetime,"approve_id"=>$id,"remarks"=>$row['remark']]);

          $query = $this->db->distinct()
                            ->select('family_id')
                            ->where('req_id',$row['req_id'])
                            ->get('form_data');

          $family_id_result = $query->row_array();
          $family_id=$family_id_result['family_id'];
          if(empty($family_id)){
            die();
          }
          $this->db->where("family_id",$family_id);
          $this->db->update("form_data",["status"=>"Verified","approve_datetime"=>$datetime,"approve_id"=>$id,"remarks"=>$row['remark']]);

          $this->db->where("family_id",$family_id);
          $this->db->update("form_data_update",["status"=>"Verified","approve_datetime"=>$datetime,"approve_id"=>$id,"remarks"=>$row['remark']]);

          $res = $this->db->get_where("form_data_update",["family_id"=>$family_id]);
          $arr = [];
          $form_id = '';
          foreach($res->result_array() as $index => $row1){
            $form_id = $row1["form_id"];
            foreach($row1 as $key => $value){
              if($key!="record_id"){
                $arr[$index][$key] = $value; 
              }
            }
          }
          $this->db->insert_batch("form_data",$arr);

          $this->db->delete("form_data_update",["family_id"=>$family_id]);
      }
    }
    if($status=="Rejected"){
      foreach($remarks as $row1){
          $this->db->where("req_id",$row1['req_id']);
          $this->db->update("form_data",["status"=>"Rejected","approve_datetime"=>$datetime,"approve_id"=>$id,"remarks"=>$row1['remark']]);

          $res = $this->db->get_where("form_data",["req_id"=>$row1['req_id']]);

          $arr = [];
          foreach($res->result_array() as $index => $row){
            foreach($row as $key => $value){
              if($key!="record_id"){
                $arr[$index][$key] = $value; 
              }
            }
          }
          $this->db->insert_batch("form_data_rejected",$arr);

          $this->db->delete("form_data",["req_id"=>$row1['req_id']]);
      }

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

  public function updateStatusOfReqRatingBulk(){

    $this->db = $this->load->database("default",TRUE);
    try{
        $this->db->trans_begin();
        $ratingData = $this->input->post("ratingData");
        $datetime = date("Y-m-d H:i:s");
        $id = $this->session->userdata("id");
        foreach($ratingData as $row){
          if($row['status']=="Verified"){
              $this->db->where("req_id",$row['req_id']);
              $this->db->update("form_data",["status"=>"Verified","remarks"=>$row['remark'],"approve_datetime"=>$datetime]);
              if ($this->db->affected_rows() == 0) {
                    throw new Exception('Update failed for req_id: ' . $row['req_id']);
                }

              $this->db->where("family_id",$row['family_id']);
              $this->db->update("form_data",["rating"=>$row['rating'],"rating_datetime"=>$datetime]);
              if ($this->db->affected_rows() == 0) {
                    throw new Exception('Update failed for family_id: ' . $row['family_id']);
              }
              
          }
        }
      $this->db->trans_commit();
      echo "200";
    }catch(Exception $e){
      $this->db->trans_rollback();
      log_message('error', 'Transaction failed: ' . $e->getMessage());
      echo "500";
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

    // echo "<pre>";
    // print_r($users);
    // die();

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
    foreach($railway_mapping as $row){
      if(count($row->assign)==0){
        $this->db->where("username",$row->username);
        $this->db->delete("railway_mapping");
      }
    }

    if(count($adddata)>0){
      $this->db->where_in("username",$delete_username_data)->delete("railway_mapping");
      $this->db->insert_batch("railway_mapping",$adddata);
    }
    echo "200";

  }


	
} 