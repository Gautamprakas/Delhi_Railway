<!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap/js/bootstrap.js"); ?>"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="<?php //echo base_url("assets/layout/plugins/bootstrap-select/js/bootstrap-select.js"); ?>"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-slimscroll/jquery.slimscroll.js"); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/node-waves/waves.js"); ?>"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/jquery.dataTables.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/jszip.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/pdfmake.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/vfs_fonts.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/jquery-datatable/extensions/export/buttons.print.min.js"); ?>"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/sweetalert/sweetalert.min.js"); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/forms/basic-form-elements.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/tables/jquery-datatable.js"); ?>"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url("assets/layout/js/demo.js"); ?>"></script>




<!--Logic JS-->

<script>
    $("form").on("submit", function (e) {
        e.preventDefault();
        $("#actsubmit").hide();
        var datastring = $("form").serializeArray();

        var json = JSON.parse($('#jsonStr').val());
        console.log(json);
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
            fd.append('form_id', $("#form_id").val());
            fd.append('child_id','<?php echo $this->session->userdata("id"); ?>');
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
                form_id : $("#form_id").val(),
                child_id : '<?php echo $this->session->userdata("id"); ?>',
                datetime : datetime,
                form_data : JSON.stringify(json),
                geo_loc : ''
            },function(data){
                data = JSON.parse(data);
                if(data.status==200){
                    swal("Data Uploaded Successfully");
                    setTimeout(function (){location.reload()}, 1000);
                }else{
                    alert("server error");
                }
                
                //console.log(data);
            });
        });
        
    });



</script>
