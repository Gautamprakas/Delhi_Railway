<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screening extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('session');
		if( ! $this->isLogin() )  
			redirect('view/Login');
		$this->load->model('ScreeningModel');
	}


	private function isLogin(){
        
        $is_login = $this->session->userdata("is_login");
        $base_url = $this->session->userdata("base_url");

        if( $is_login && $base_url == base_url() )
        	return true;
        else
        	return false;
	}


	public function view_data(){
        $intent['data']           = $this->ScreeningModel->getChildsData();
		$intent["menuActive"]     = "screening";
		$intent["subMenuActive"]  = "view_data";
		$intent["headerCss"]      = "view/screening/view_data/view_dataCss";
		$intent["mainContent"]    = "view/screening/view_data/view_data";
		$intent["footerJs"]       = "view/screening/view_data/view_dataJs";
		$this->load->view("view/include/template",$intent);
	}


	public function view_media($child_id){
        $intent['data']           = $this->ScreeningModel->getChildsMedia($child_id);
		$intent["menuActive"]     = "screening";
		$intent["subMenuActive"]  = "view_data";
		$intent["headerCss"]      = "view/screening/view_media/view_mediaCss";
		$intent["mainContent"]    = "view/screening/view_media/view_media";
		$intent["footerJs"]       = "view/screening/view_media/view_mediaJs";
		$this->load->view("view/include/template",$intent);
	}



	public function screening_detail($child_id){
		$intent['data']           = $this->ScreeningModel->getChildsScreeningDetail($child_id);
		$this->load->view('report_format',$intent);
		/*$intent["menuActive"]     = "screening";
		$intent["subMenuActive"]  = "view_data";
		$intent["headerCss"]      = "view/screening/screening_detail/screening_detailCss";
		$intent["mainContent"]    = "view/screening/screening_detail/screening_detail";
		$intent["footerJs"]       = "view/screening/screening_detail/screening_detailJs";
		$this->load->view("view/include/template",$intent);*/
	}



	public function getIncidenceDetails(){

		$status = urldecode($this->input->post("status"));
		$user_id = $this->user_id;
		$res = $this->IncidenceModel->getIncidence( $user_id,$status );
		if( $res ){

			$response["status_code"] = "200";
			$response["status_message"] = "data found";
			$response["result"] = $res;
		}else{

			$response["status_code"] = "404";
			$response["status_message"] = "data not found";
			$response["result"] = null;
		}
		echo json_encode($response);
	}


	public function getIncidenceForDashboard(){

		$data = $this->IncidenceModel->getIncidenceForDashboard($this->user_id);

		$response["status_code"] = "200";
		$response["status_message"] = "data found";
		$response["result"] = $data;
        
        echo json_encode($response);

	}


	public function getRelatedOfficerDetails(){

        $incidence_id = $this->input->post("incidence_id");
		$data = $this->IncidenceModel->getRelatedOfficerDetails( $incidence_id );

	    $this->load->library('table');
	    $template = array(
		        'table_open'            => '<table style="width:100%;font-size:12px;background:#254756;color:white;" border="1" >',

		        'thead_open'            => '<thead>',
		        'thead_close'           => '</thead>',

		        'heading_row_start'     => '<tr>',
		        'heading_row_end'       => '</tr>',
		        'heading_cell_start'    => '<th style="text-align:center;;padding:4px 1px 4px 1px">',
		        'heading_cell_end'      => '</th>',

		        'tbody_open'            => '<tbody>',
		        'tbody_close'           => '</tbody>',

		        'row_start'             => '<tr>',
		        'row_end'               => '</tr>',
		        'cell_start'            => '<td style="text-align:center;padding:4px 1px 4px 1px">',
		        'cell_end'              => '</td>',

		        'row_alt_start'         => '<tr>',
		        'row_alt_end'           => '</tr>',
		        'cell_alt_start'        => '<td style="text-align:center;padding:4px 1px 4px 1px">',
		        'cell_alt_end'          => '</td>',

		        'table_close'           => '</table>'
		);

		$this->table->set_template($template);

	    $this->table->set_heading('Office', 'Name', 'Mobile', 'Action', 'DateTime' );
	    foreach($data as $row){
	    	$this->table->add_row(ucwords($row->office_name), ucwords($row->name), $row->mobile, ucwords($row->action), strtotime($row->action_datetime)>0?$row->action_datetime:"");
	    }
	    echo '<div class="table-responsive">';
	    echo $this->table->generate();
	    echo '<div>';

	} 

	public function uploadFeedback(){

		$post = $this->input->post();
		$post["datetime"] = date("Y-m-d H:i:s");

		if( !empty($post["office_id"]) && !empty($post["location_id"]) && !empty($post["emp_id"]) && !empty($post["status"]) && !empty($post["datetime"]) && !empty($post["incidence_id"])  ){
			
			$this->load->model("IncidenceModel");
			$res = $this->IncidenceModel->uploadFeedback( $post );

			if( $res ){
				$response["status_code"]    = "200";
				$response["status_message"] = "data added successfully";
				$response["result"]         = null;
			} else {
				$response["status_code"]    = "500";
				$response["status_message"] = "server error";
				$response["result"]         = null;
			}

		}else{
			
			$response["status_code"]    = "400";
			$response["status_message"] = "bad request";
			$response["result"]         = null;

		}

		echo json_encode($response);
	}


	public function addIncidence(){

		$intent["menuActive"]     = "incidence";
		$intent["subMenuActive"]  = "addincidence";
		$intent["headerCss"]      = "admin/incidence/addIncidence/addIncidenceCss";
		$intent["mainContent"]    = "admin/incidence/addIncidence/addIncidence";
		$intent["footerJs"]       = "admin/incidence/addIncidence/addIncidenceJs";
		$this->load->view("admin/include/template",$intent);
	}

}