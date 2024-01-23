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

<script type="text/javascript">
    jQuery(document).ready(function(){
        

        var i = $("#ivalue").val();


        $("form").on("change","select.input_type",function(){
            var input_type = $(this).val();
            var row = $(this).closest(".elements_row");
            row.find(".dynamic").html("");
            $.post("<?php echo base_url("view/CreateForm/getFormElement"); ?>",{
                input_type:input_type,
                i:$(this).attr('name').split('[')[1].split(']')[0]
            },function(data){
                row.find(".dynamic").html(data);
            });
            
        });




        $("button.add_row").on("click",function(){
            i++;
            row = `
                <div class="row clearfix elements_row">
                    <hr style="clear:both;">
                    <div class='col-sm-1'>
                        <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float delete_row">
                            ${i} <i class="material-icons">delete</i>
                        </button>
                    </div>
                    <div class='col-sm-2'>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                                <select class="form-control input_type show-tick" name="input_type[${i}]" data-size="5" required>
                                    <option value="">--Select Input Type--</option>
                                    <option value="edit_text">Text</option>
                                    <option value="spinner">Select</option>
                                    <option value="check_box">Checkbox</option>
                                    <option value="radio">Radio</option>
                                    <option value="date_picker">Date</option>
                                    <option value="label">Label</option>
                                    <option value="choose_image">Choose Image</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="dynamic"></div>
                </div>
            `;
            
            $("form").append(row);
        });

        $("form").on("click","button.delete_row",function(){
            $(this).closest(".elements_row").remove();
        });
    });
</script>
