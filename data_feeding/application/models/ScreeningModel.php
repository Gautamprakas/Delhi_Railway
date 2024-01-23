<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScreeningModel extends CI_Model {

    private  $model_que_relation = array(  //key: model|class => value: ques_id
       "cleft_lip_palate_v2|Normal" => null,
       "cleft_lip_palate_v2|Cleft Lip" => "3",
       "cleft_lip_palate_v2|Cleft Palate" => "3"
    );

    function __construct(){
        parent::__construct();
        $this->db = $this->load->database('default',TRUE);
    }

	public function getChildsData(){

        $this->db->order_by("record_datetime","DESC");
        $res = $this->db->get('child_info');
        return $res->result();
    }

    public function getChildsScreeningDetail($child_id){

        $child_info = $this->db->get_where('child_info',['child_id'=>$child_id]);

        $this->db->select("disease_questions.ques_id");
        $this->db->select("disease_questions.ques_eng");
        $this->db->select("disease_questions.disease");
        $this->db->select("disease_questions.disease_type");
        $this->db->select("child_ques_ans.ans");
        $this->db->from("child_ques_ans");
        $this->db->join("disease_questions","child_ques_ans.ques_id=disease_questions.ques_id");
        $this->db->where("child_ques_ans.child_id",$child_id);
        $child_ques_ans = $this->db->get();

        foreach($child_ques_ans->result() as $row){
            $quiz[$row->ques_id] = $row;
        }

        $this->db->select("child_media.child_id");
        $this->db->select("child_media.label");
        $this->db->select("child_media.media_type");
        $this->db->select("child_media.media_url");
        $this->db->select("child_media_pred.model");
        $this->db->select("child_media_pred.class");
        $this->db->select("child_media_pred.prob");
        $this->db->from("child_media");
        $this->db->join("child_media_pred","child_media.media_url = child_media_pred.media_url");
        $this->db->where("child_media.child_id",$child_id);
        $child_media = $this->db->get();
        

        foreach($child_media->result() as $row){
         
            $index = sprintf("%s|%s",$row->model,$row->class);

            if( isset($this->model_que_relation[$index]) && !empty($this->model_que_relation[$index]) ){
                $temp_ques = explode(',', $this->model_que_relation[$index]);
                foreach($temp_ques as $ques_id_value){
                    if(isset($quiz[$ques_id_value])){
                        if($quiz[$ques_id_value]->ans <= $row->prob){
                            $quiz[$ques_id_value]->ans = $row->prob*100;
                        }
                    }else{
                        $this->db->select("ques_id");
                        $this->db->select("ques_eng");
                        $this->db->select("disease");
                        $this->db->select("disease_type");
                        $this->db->where("ques_id",$ques_id_value);
                        $ques_row = $this->db->get("disease_questions");
                        $quiz[$ques_id_value] = $ques_row->row();
                        $quiz[$ques_id_value]->ans = $row->prob*100;
                    }
                }
            }

        }
        
        $Disease = array();
        $TotalSum = 0;
        $TotalCount = 0;
        foreach($quiz as $ques){
            if(!isset($Disease[$ques->disease])){
                $Disease[$ques->disease] = array("disease"=>$ques->disease,"prob"=>0,"sum"=>0,"count"=>0);
            }
            $Disease[$ques->disease]["sum"] += $ques->ans;
            $Disease[$ques->disease]["count"] += 1;
            $Disease[$ques->disease]["prob"] = round($Disease[$ques->disease]["sum"]/$Disease[$ques->disease]["count"],2);
            $TotalSum += $ques->ans;
            $TotalCount++;
        }

        // echo $TotalSum;
        // echo $TotalCount;

        foreach($Disease as $key=>$value){
            if( $value["prob"]<1 ){
                unset($Disease[$key]);
            }
        }
        /*TODO TASK*/
        $ManualDiagnosis = $this->db->get_where("manual_diagnosis",["child_id"=>$child_id]);
        foreach($ManualDiagnosis->result() as $row){
            $Disease[$row->disease]["disease"] = $row->disease;
            $Disease[$row->disease]["prob"] = 100; 
        }
        /*echo "<pre>";
        print_r(count($quiz));*/
        if(count($Disease)>0){
        	$diagnosis = implode("|", array_keys($Disease));
            $this->db->where("child_id",$child_id);
            $this->db->update("child_info",["diagnosis"=>$diagnosis]);
        }else{
        	$diagnosis = '';
            $this->db->where("child_id",$child_id);
            $this->db->update("child_info",["diagnosis"=>$diagnosis]);
        }

        return array(
            "child_info" => $child_info->row(),
            "child_media" => $child_media->result(),
            "quiz" => $quiz,
            "Disease" => $Disease,
            "TotalRisk" => round($TotalSum/$TotalCount,2)
        );
    }


    public function getChildsMedia( $child_id ){

        $this->db->select("child_media.child_id");
        $this->db->select("child_media.label");
        $this->db->select("child_media.media_type");
        $this->db->select("child_media.media_url");
        $this->db->from("child_media");
        $this->db->where("child_media.child_id",$child_id);
        $child_media = $this->db->get()->result();

        foreach($child_media as $key=>$row){
            $child_media[$key]->media_url = base_url(sprintf("assets/%s/%s/%s/%s",$row->media_type,$row->child_id,$row->label,$row->media_url)); 
        }

        return $child_media;
    }


}