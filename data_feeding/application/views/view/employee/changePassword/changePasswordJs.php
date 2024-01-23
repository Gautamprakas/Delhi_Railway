 <!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap/js/bootstrap.js"); ?>"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap-select/js/bootstrap-select.js"); ?>"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-slimscroll/jquery.slimscroll.js"); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/node-waves/waves.js"); ?>"></script>

    <!-- Autosize Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/autosize/autosize.js"); ?>"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/momentjs/moment.js"); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/forms/basic-form-elements.js"); ?>"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url("assets/layout/js/demo.js"); ?>"></script>




<!--Logic JS-->


<script type="text/javascript">
    jQuery(document).ready(function(){
        $.get("<?php echo base_url("Location/getLocationDetails"); ?>",function(data){
            $("#location_id").html("");
            var data = jQuery.parseJSON(data);
            $("#location_id").append($('<option>',{value: "",text: "SELECT LOCATION"}));
            if(data.status_code == '200'){
                $.each(data.result,function(index,value){
                    $("#location_id").append('<option value="'+value.location_id+
                                              '" data-subtext="('+value.location_type+')">'+
                                              value.location_name+'</option>');
                });
            }
            $("#location_id").selectpicker('refresh');
        });
    });
</script>


<script type="text/javascript">
    jQuery(document).ready(function(){
        
        $("#location_id").change(function(){
            var location_id = $("#location_id").val();
            $.post("<?php echo base_url("Office/getOfficesType"); ?>",{location_id:location_id},function(data){
                $("#office_type").html("");
                var data = jQuery.parseJSON(data);
                $("#office_type").append($('<option>',{value: "",text: "SELECT OFFICE TYPE"}));
                if(data.status_code == '200'){
                    $.each(data.result,function(index,value){
                        $("#office_type").append($('<option>',{value: value.office_type,text: value.office_type}));;
                    });
                }
                $("#office_type").selectpicker('refresh');
            });
            
        });
    });
</script>





<script type="text/javascript">
    jQuery(document).ready(function(){
        
        $("#office_type").change(function(){
            var location_id = $("#location_id").val();
            var office_type = $("#office_type").val();
            $.post("<?php echo base_url("Office/getOfficesDetails"); ?>",{location_id:location_id,office_type:office_type},function(data){
                $("#office_id").html("");
                var data = jQuery.parseJSON(data);
                $("#office_id").append($('<option>',{value: "",text: "SELECT OFFICE"}));
                if(data.status_code == '200'){
                    $.each(data.result,function(index,value){
                        $("#office_id").append('<option value="'+value.office_id+
                                                  '" data-subtext="('+value.office_type+')">'+
                                                  value.office_name+'</option>');
                    });
                }
                $("#office_id").selectpicker('refresh');
            });
            
        });
    });
</script>