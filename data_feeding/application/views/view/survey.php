<?php
$from_id = $this->session->userdata("form_id");//1583498711793;
$jsonStr = file_get_contents(sprintf("%s/%s/%s.json",APPPATH,"questions/form",$from_id));
$json = json_decode($jsonStr,true);
$title = $json["step1"]["title"];
$fields = $json["step1"]["fields"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo strtoupper(PROJECT_NAME); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url("assets/layout/plugins/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url("assets/layout/plugins/node-waves/waves.css"); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url("assets/layout/plugins/animate-css/animate.css"); ?>" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="<?php echo base_url("assets/layout/plugins/sweetalert/sweetalert.css"); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url("assets/layout/css/style.css"); ?>" rel="stylesheet">

    <style type="text/css">
             
            /* body{
                background: linear-gradient(to right,#607d8b, #7ea7bb, #607d8b);
             }*/

             
             .card{
                width: 100%;
                margin: auto;
                box-shadow: 0px 2.5px 30px black;
               
             }
             .logo{
                text-shadow: 0px 2.5px 30px black;
                text-transform: uppercase;
                letter-spacing: 1px;
             }
             .login-page .login-box .logo small {
                margin-top:10px;
                letter-spacing: 1px;
                background-repeat: no-repeat;                
             }
            .login-page{
                background: url("<?php echo base_url("assets/background.jpg"); ?>");
              background-repeat: no-repeat;
              background-size: cover;
              height: 100%;
             }

             
    </style>
</head>
<body class="login-page" >
    <a href="<?php echo base_url("survey_controller/unset_all"); ?>" class="btn btn-danger pull-right">logout</a>
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b><?php echo $title; ?></title></b></a> 
        </div>
        <div class="card">
            <div class="body">
                <form  action="#" method="POST" autocomplete="off" target="_self" enctype="multipart/form-data">
                    
                    
                    <!-- <div class="msg"><?php //echo $title; ?></div> -->
    
                    <h6 style="color: red;text-align: center;">
                        <noscript>
                             Please Enable JavaScript.
                             <a href="https://www.enable-javascript.com/" target="_blank">Click Here</a>
                        </noscript>

                    </h6>

<!--                     <div class="input-group">
                       <div class="form-line">
                           <p><b> <?php //echo "Name"; ?></b></p>
                           <input type="text" class="form-control" value="<?php //echo $this->session->userdata("name"); ?>" readonly="">
                       </div>
                   </div>
                   
                   <div class="input-group">
                       <div class="form-line">
                           <p><b> <?php //echo "Mobile"; ?></b></p>
                           <input type="text" class="form-control" value="<?php //echo $this->session->userdata("mobile"); ?>" readonly="">
                       </div>
                   </div> -->

                    <?php 
                    $sno=0;
                    $id=0;

                    foreach($fields as $key => $field): ?>
                        <?php //echo "<pre>"; print_r($field); ?>
                        <?php

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
                                                       <?php  if( $val["key"] == $field["value"] ){
                                                          echo "required checked";
                                                          $radio++;
                                                          }
                                                       ?> 
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
                        ?>


                      
                    <?php endforeach; ?>
                    
                    

                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" id="actsubmit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap/js/bootstrap.js"); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/node-waves/waves.js"); ?>"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/sweetalert/sweetalert.min.js"); ?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-validation/jquery.validate.js"); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/examples/sign-in.js"); ?>"></script>
</body>

<script>
    $("form").on("submit", function (e) {
        e.preventDefault();
        $("#actsubmit").hide();
        var datastring = $("form").serializeArray();

        var json = JSON.parse('<?php echo $jsonStr; ?>');
        //console.log(json);
        reqdata = '';
        $.each(datastring,function(index,ans_field){
            ans_key = ans_field.name;
            ans_val = ans_field.value;
            $.each(json.step1.fields,function(form_index,from_field){
                if( ans_key == from_field.key ){
                    switch(from_field.type) {
                      case "edit_text":
                        json.step1.fields[form_index].value = ans_val;
                        break;
                      case "check_box":
                        $.each(json.step1.fields[form_index].options,function(option_index,option_val){
                            if( option_val.key == ans_val ){
                                json.step1.fields[form_index].options[option_index].value = "true";
                            }
                        });
                        break;

                      case "radio":
                        json.step1.fields[form_index].value = ans_val;
                        break;

                      case "spinner":
                        json.step1.fields[form_index].value = ans_val;
                        break;


                      case "choose_image":
                        json.step1.fields[form_index].value = ans_val;
                        break;

                      default:
                        // code block
                    }
                }
            });
        });




        $.each($('.fileupload'),function(index,ans_field){

            ans_key = ans_field.name;

            if(typeof ans_field.files[0] == 'undefined'){
              $.each(json.step1.fields,function(form_index,from_field){
                  if( ans_key == from_field.key ){
                      switch(from_field.type) {

                        case "choose_image":
                          json.step1.fields[form_index].value = '';
                          break;

                        default:
                          // code block
                      }
                  }
              });
              return;
            }

            ans_val = ans_field.files[0].name;

            var fd = new FormData(); 
            var files = ans_field.files[0]; 
            fd.append('file', files);
            fd.append('form_id', '<?php echo $from_id?>');
            fd.append('child_id','<?php echo $this->session->userdata("mobile"); ?>');
            fd.append('field_id', ans_key);
            swal('Please Wait.... File is Uploading...');
            $.ajax({ 
                  url: "<?php echo base_url("api/upload_dynamic_form_files"); ?>", 
                  type: 'post', 
                  data: fd, 
                  contentType: false, 
                  processData: false,
                  async: false,
                  success: function(response){ 
                    console.log(response);
                    var res = JSON.parse(response);
                    if( res.status_code == '200' ){
                          $.each(json.step1.fields,function(form_index,from_field){
                              if( ans_key == from_field.key ){
                                  switch(from_field.type) {

                                    case "choose_image":
                                      json.step1.fields[form_index].value = ans_val;
                                      break;

                                    default:
                                      // code block
                                  }
                              }
                          });

                    }else{
                       alert("File Not Uploaded");
                       $("#actsubmit").show();
                       $.stop();
                    } 
                  }
              }); 



        });

        swal('Please Wait..');


        console.log(json);
        $.get("<?php echo base_url("Survey_controller/current_datetime"); ?>",function(datetime){
            $.post("<?php echo base_url("api/uploadFormData"); ?>",{
                form_id : '<?php echo $from_id?>',
                child_id : '<?php echo $this->session->userdata("mobile"); ?>',
                datetime : datetime,
                form_data : JSON.stringify(json),
                geo_loc : ''
            },function(data){
                data = JSON.parse(data);
                if(data.status==200){
                    $.get("<?php echo base_url("survey_controller/set_feedback"); ?>",function(data){
                        window.location.href = '<?php echo base_url("Survey_controller/comming_soon"); ?>';
                    });
                }else{
                    alert("server error");
                }
                
                //console.log(data);
            });
        });
        
    });



</script>
</html>