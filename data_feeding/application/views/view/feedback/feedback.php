<?php
$form_id = 1589285939267;
$jsonStr = file_get_contents(sprintf("%s/%s/%s.json",APPPATH,"questions/form",$form_id));
$json = json_decode($jsonStr,true);
$title = $json["step1"]["title"];
$fields = $json["step1"]["fields"];
?>
<input type="hidden" id='jsonStr' value='<?php echo $jsonStr; ?>'>
<input type="hidden" id='form_id' value='<?php echo $form_id; ?>''>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Create Form -->
                    <small></small>
                </h2>
            </div>


            <div class="row clearfix">
                <div class="col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Feed Data
                            </h2>
                        </div>
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
            </div>





        </div>
    </section>