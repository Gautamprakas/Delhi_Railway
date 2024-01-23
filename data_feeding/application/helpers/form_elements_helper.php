<?php

function edit_text($id=0,$hint=null,$v_min_length=null,$v_max_length=null,$v_required=true){

    $v_required = $v_required?"checked":"";

	$element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='hint[{$id}]' required minlength='1' maxlength='500' placeholder='Hint' value='$hint'>
                        
                </div>
            </div>
        </div>  

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='number' class='form-control' name='v_min_length[{$id}]' required min='0' max='500' placeholder='Min Length' value='$v_min_length'>
                       
                </div>
            </div>
        </div>

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='number' class='form-control' name='v_max_length[{$id}]' required min='0' max='500'  placeholder='Max Length' value=$v_max_length>
                        
                </div>
            </div>
        </div>


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
	";
	return $element;
}


function spinner($id=0,$hint=null,$values=null,$v_required=true){

    $v_required = $v_required?"checked":"";

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='hint[{$id}]' required minlength='1' maxlength='500' placeholder='Hint' value='$hint'>
                        
                </div>
            </div>
        </div>  

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <textarea class='form-control' name='values[{$id}]' required placeholder='Comma Separated Values'>$values</textarea>
                    
                </div>
            </div>
        </div>

       


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
    ";
    return $element;
}


function check_box($id=0,$label=null,$options=null,$v_required=true){

    $v_required = $v_required?"checked":"";

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='label[{$id}]' required minlength='1' maxlength='500' placeholder='Label' value='$label'>
                        
                </div>
            </div>
        </div>  

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <textarea class='form-control' name='options[{$id}]' required placeholder='Comma Separated Options' >$options</textarea>
                    
                </div>
            </div>
        </div>

       


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
    ";
    return $element;
}


function radio($id=0,$label=null,$options=null,$v_required=true){

    $v_required = $v_required?"checked":"";

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='label[{$id}]' required minlength='1' maxlength='500' placeholder='Label' value='$label'>
                       
                </div>
            </div>
        </div>  

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <textarea class='form-control' name='options[{$id}]' required placeholder='Comma Separated Options' >$options</textarea>
                    
                </div>
            </div>
        </div>

       


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
    ";
    return $element;
}



function choose_image($id=0,$uploadButtonText=null,$v_required=true){

    $v_required = $v_required?"checked":"";

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='uploadButtonText[{$id}]' required  placeholder='Button Name' value='$uploadButtonText'>
                       
                </div>
            </div>
        </div>    


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
    ";
    return $element;
}

function date_picker($id=0,$hint=null,$v_required=true){

    $v_required = $v_required?"checked":"";

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='hint[{$id}]' required minlength='1' maxlength='500' placeholder='Hint' value='$hint'>
                </div>
            </div>
        </div>    


        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                   <input type='checkbox' name='v_required[{$id}]' id='basic_checkbox_$id' class='filled-in' $v_required />
                    <label for='basic_checkbox_$id'>Required</label>
                </div>
            </div>
        </div>
    ";
    return $element;
}

function label($id=0,$text=null){

    $element = "

        <div class='col-sm-2'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='text' class='form-control' name='text[{$id}]' required minlength='1' maxlength='500' placeholder='Text' value='$text'>
                </div>
            </div>
        </div>    

    ";
    return $element;
}

function form_generate( $CI, $form_id = 0, $dept = '' ){



            $form = array();
            $fields = array();
            $input_type = $CI->input->post("input_type");
            $form["count"] = 1;
            $form["step1"]["title"] = trim($CI->input->post("form_title"));
            $arr_index = 0;
            foreach($input_type as $index => $value){
                $index = (int)$index;
                switch ($value) {
                    case 'edit_text':
                        $hint         = $CI->input->post("hint");
                        $v_min_length = $CI->input->post("v_min_length");
                        $v_max_length = $CI->input->post("v_max_length");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "edit_text";
                        $fields[$arr_index]["hint"] = trim($hint[$index]);
                        if( isset($v_min_length[$index]) ){
                            $fields[$arr_index]["v_min_length"] = [
                                "value"=>$v_min_length[$index],
                                "err"=>sprintf("Min length should be at least %s.",$v_min_length[$index])
                            ];
                        }
                        if( isset($v_max_length[$index]) ){
                            $fields[$arr_index]["v_max_length"] = [
                                "value"=>$v_max_length[$index],
                                "err"=>sprintf("Min length should be at least %s.",$v_max_length[$index])
                            ];
                        }
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please enter a value to proceed."];
                        }

                        break;


                    case 'spinner':
                        $hint         = $CI->input->post("hint");
                        $values       = $CI->input->post("values");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "spinner";
                        $fields[$arr_index]["hint"] = trim($hint[$index]);
                        if( isset($values[$index]) ){
                            $arr = explode(",", $values[$index]);
                            foreach($arr as $i => $val){
                                $arr[$i] = trim($val);
                            }
                            $fields[$arr_index]["values"] = $arr;
                        }
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please choose a value to proceed."];
                        }
                        break;

                    case 'check_box':
                        $label        = $CI->input->post("label");
                        $options       = $CI->input->post("options");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "check_box";
                        $fields[$arr_index]["label"] = trim($label[$index]);
                        if( isset($options[$index]) ){
                            $arr = explode(",", $options[$index]);
                            $newarr = array();
                            foreach($arr as $i => $val){
                                $newarr[$i]["key"] = trim($val);
                                $newarr[$i]["text"] = trim($val);
                                $newarr[$i]["value"] = "false";
                            }
                            $fields[$arr_index]["options"] = $newarr;
                        }
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please check a value to proceed."];
                        }
                        break;

                    case 'radio':
                        $label        = $CI->input->post("label");
                        $options      = $CI->input->post("options");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "radio";
                        $fields[$arr_index]["label"] = trim($label[$index]);
                        $first_value = 'false';
                        if( isset($options[$index]) ){
                            $arr = explode(",", $options[$index]);
                            $newarr = array();
                            
                            foreach($arr as $i => $val){
                                if($i==0){
                                    $first_value = trim($val);
                                }
                                $newarr[$i]["key"] = trim($val);
                                $newarr[$i]["text"] = trim($val);
                            }
                            $fields[$arr_index]["options"] = $newarr;
                        }
                        $fields[$arr_index]["value"] = $first_value;
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please check a value to proceed."];
                        }
                        break;

                    case 'choose_image':
                        $uploadButtonText = $CI->input->post("uploadButtonText");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "choose_image";
                        $fields[$arr_index]["uploadButtonText"] = trim($uploadButtonText[$index]);
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please choose an image to proceed."];
                        }
                        break;

                    case 'date_picker':
                        $hint         = $CI->input->post("hint");
                        $v_required   = $CI->input->post("v_required");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "date_picker";
                        $fields[$arr_index]["hint"] = trim($hint[$index]);
                        if( isset($v_required[$index]) ){
                            $fields[$arr_index]["v_required"] = ["value"=>"true","err"=>"Please select a value to proceed."];
                        }
                        break;

                    case 'label':
                        $text         = $CI->input->post("text");
                        $fields[$arr_index]["key"] = sprintf("%s_%s",$form_id,$index);
                        $fields[$arr_index]["type"] = "label";
                        $fields[$arr_index]["text"] = trim($text[$index]);
                        break;
                    
                    default:
                        # code...
                        break;
                }
                $arr_index++;
            }
            $form["step1"]["fields"] = $fields;
            $fp = fopen(sprintf("./application/questions/form/%s.json",$form_id), 'w');
            fwrite($fp, json_encode($form,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
            fclose($fp);

            $datetime = date("Y-m-d H:i:s");

            if( $CI->db->get_where("form_created",["form_id"=>$form_id])->num_rows()>0 ){
                $CI->db->where("form_id",$form_id);
                $CI->db->update("form_created",[
                    "form_title" => $form["step1"]["title"],
                    "fields_count" => count($fields),
                    "update_datetime"  => $datetime
                ]);
            }else{
                $CI->db->insert("form_created",[
                    "form_id" => $form_id,
                    "form_title" => $form["step1"]["title"],
                    "fields_count" => count($fields),
                    "create_datetime"  => $datetime,
                    "update_datetime"  => $datetime,
                    "dept" => $dept
                ]);
            }

            
            return $form;
}


function update_form_ui($CI,$req_id,$form_id='',$family_id='',$member_id=''){

    //$form_id = 1589370783572;
    $json_file = sprintf("./application/questions/form/%s.json",$form_id);
    $str = file_get_contents($json_file);
    $form_data = json_decode($str,true);
    foreach($form_data["step1"]["fields"] as $index => $field){
        if(isset($req_id)&&!empty($req_id)){
            $res = $CI->db->select("value")->get_where("form_data",["req_id"=>$req_id,"field_id"=>$field["key"]]);
        }else if(isset($family_id)&&!empty($family_id)&&isset($member_id)&&!empty($member_id)){
            $res = $CI->db->select("value")->get_where("form_data",["family_id"=>$family_id,"member_id"=>$member_id,"field_id"=>$field["key"]]);
        }else{
            $res = $CI->db->select("value")->get_where("form_data",["req_id"=>$req_id,"field_id"=>$field["key"]]);
        }
        $value = $res->num_rows() > 0 ? $res->row()->value : '';
        switch ($field["type"]) {

            case 'radio':
                
                $form_data["step1"]["fields"][$index]["value"] = $value;
                break;
            
            default:
                
                $form_data["step1"]["fields"][$index]["value"] = $value;
                break;
        }

    }

    return $form_data;
}

function update_form_ui2($CI,$req_id,$form_id='',$family_id='',$member_id=''){

    //$form_id = 1589370783572;
    $json_file = sprintf("./application/questions/form/%s.json",$form_id);
    $str = file_get_contents($json_file);
    $form_data = json_decode($str,true);
    foreach($form_data["step1"]["fields"] as $index => $field){
        if(isset($req_id)&&!empty($req_id)){
            $res = $CI->db->select("value")->get_where("form_data",["req_id"=>$req_id,"field_id"=>$field["key"]]);
        }else if(isset($family_id)&&!empty($family_id)&&isset($member_id)&&!empty($member_id)){
            $res = $CI->db->select("value")->get_where("form_data",["family_id"=>$family_id,"member_id"=>$member_id,"field_id"=>$field["key"]]);
        }else{
            $res = $CI->db->select("value")->get_where("form_data",["req_id"=>$req_id,"field_id"=>$field["key"]]);
        }
        if($form_data["step1"]["fields"][$index]["hint"]=="Train Number*"){
        $CI->db->select("train_number");
        $CI->db->from("railway_trains");
        $query1=$CI->db->get();
        $result1=$query1->result_array();
        $train_numbers=[];
        foreach($result1 as $row){
            $train_numbers[]=$row['train_number'];
        }
        $form_data["step1"]["fields"][$index]["values"]=$train_numbers;
        }
        if($form_data["step1"]["fields"][$index]["hint"]=="Coach Number*"){
        $CI->db->select("coach_number");
        $CI->db->from("railway_coach");
        $query2=$CI->db->get();
        $result2=$query2->result_array();
        $coach_numbers=[];
        foreach($result2 as $row){
            $coach_numbers[]=$row['coach_number'];
        }
        $form_data["step1"]["fields"][$index]["values"]=$coach_numbers;
        }
        //Toilet/Gallery/ Berth No.*
        if($form_data["step1"]["fields"][$index]["hint"]=="Toilet/Gallery/ Berth No.*"){
        $CI->db->select("berth");
        $CI->db->from("railway_berth");
        $query3=$CI->db->get();
        $result3=$query3->result_array();
        $berth_numbers=[];
        foreach($result3 as $row){
            $berth_numbers[]=$row['berth'];
        }
        $form_data["step1"]["fields"][$index]["values"]=$berth_numbers;
        }
        if($form_data["step1"]["fields"][$index]["hint"]=="Work List*"){
        $CI->db->select("work_name");
        $CI->db->from("railway_work");
        $query4=$CI->db->get();
        $result4=$query4->result_array();
        $works=[];
        foreach($result4 as $row){
            $works[]=$row['work_name'];
        }
        $form_data["step1"]["fields"][$index]["values"]=$works;
        }
        if($form_data["step1"]["fields"][$index]["hint"]=="Work Status*"){
        $CI->db->select("status");
        $CI->db->from("railway_work_status");
        $query5=$CI->db->get();
        $result5=$query5->result_array();
        $works_status=[];
        foreach($result5 as $row){
            $works_status[]=$row['status'];
        }
        $form_data["step1"]["fields"][$index]["values"]=$works_status;
        }
        $value = $res->num_rows() > 0 ? $res->row()->value : '';
        switch ($field["type"]) {

            case 'radio':  
                
                $form_data["step1"]["fields"][$index]["value"] = $value;
                break;
            
            default:
                
                $form_data["step1"]["fields"][$index]["value"] = $value;
                break;
        }
        
        

    }

    return $form_data;
}
function generateData($work_category, $work_name, $item_name,$works_status,$coach_numbers,$berth) {
    $i = 1;
    foreach($coach_numbers as $coach_number){
        foreach($berth as $eachBerth){
            foreach ($work_category as $work_cat) {
                foreach ($work_name as $work) {
                    foreach ($item_name as $item) {
                        foreach($works_status as $status){
                            yield [
                                "sno" => $i,
                                // "train_number" => $train_number['train_number'],
                                "coach_number" => $coach_number['coach_number'],
                                "toilet_gallery_berth_no" => $eachBerth['berth'],
                                "work_category" => $work_cat['category'],
                                "work" => $work['work_name']."@".$work['work_rate'],
                                "work_item" => $item['item_name'],
                                "work_status"=>$status['status']
                            ];
                            $i += 1;
                        }
                    }
                }
            break;} 
        break;}
    break;}

}
function generateData2($coach_numbers,$coach_locations,$berth,$work_category,$work_name,$item_name,$works_status) {
    $i = 1;
    foreach($coach_numbers as $coach_number){
        foreach($coach_locations as $location){
            foreach($berth as $eachBerth){
                foreach ($work_category as $work_cat) {
                    foreach ($work_name as $work) {
                        foreach ($item_name as $item) {
                            foreach($works_status as $status){
                                yield [
                                    "sno" => $i,
                                    "coach_location"=>$location,
                                    // "train_number" => $train_number['train_number'],
                                    "coach_number" => $coach_number['coach_number'],
                                    "toilet_gallery_berth_no" => $eachBerth['berth'],
                                    "work_category" => $work_cat['category'],
                                    "work" => $work['work_name']."@".$work['work_rate'],
                                    "work_item" => $item['item_name'],
                                    "work_status"=>$status['status']
                                ];
                                $i += 1;
                            }
                        }
                    }
                break;} 
            break;}
        break;}
    break;}

}


function generateData3($work_category,$work_name,$item_name) {
    $i = 1;
    foreach ($work_category as $work_cat) {
        foreach ($work_name as $work) {
            foreach ($item_name as $item) {

                    yield [
                        "sno" => $i,
                        "work_category" => $work_cat['work_category'],
                        "work" => $work['work_name']."@".$work['work_rate'],
                        "work_item" => $item['item_name']."|".$item['uom']
                    ];
                    $i += 1;
                
            }
        }
    } 
}