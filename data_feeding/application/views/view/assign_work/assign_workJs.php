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
        

        var i = 0;


        $("form").on("change","select.input_type",function(){
            var input_type = $(this).val();
            var row = $(this).closest(".elements_row");
            row.find(".dynamic").html("");
            $.post("<?php echo base_url("view/CreateForm/getFormElement"); ?>",{input_type:input_type,i:i},function(data){
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


        var table = $('#example2').DataTable();
        //table.column(24).visible(false);

        $("body").on('click','.view-filter-data',function(){
            table.search($(this).attr("data-class")).draw();
            caption = $(this).attr("data-class").split('-');
            $('caption').text("FILTER : " + caption[0].toUpperCase() + " & " + caption[1].toUpperCase());
             $([document.documentElement, document.body]).animate({
                scrollTop: $("#example2").offset().top
            }, 2000);
        });


        function arraysAreEqual(array1, array2) {
            if (array1.length !== array2.length) {
              return false;
            }

            // Sort the arrays to ensure they have the same order
            array1.sort();
            array2.sort();

            for (var i = 0; i < array1.length; i++) {
              if (array1[i] !== array2[i]) {
                return false;
              }
            }

            return true;
        }


        $("body").on("click","button.save_changes",function(){
            btn = $(this);
            btn.prop('disabled', true);

            var railway_mapping = [];
            var selectele = $("body").find(".train_numbers");
            selectele.each(function() {
              
              var type = $(this).attr("data-type");
              if(typeof type !== "undefined"){
                
                var username = $(this).attr("data-username");

                var assign = $(this).val();
                assign = assign==null?Array():assign;

                var assigned = $(this).attr("data-assigned");
                assigned = assigned.split(", ").filter(Boolean);

                //console.log(assigned,assign);

                if( !arraysAreEqual(assigned,assign) ){
                    railway_mapping = railway_mapping.concat({
                        type : type,
                        username : username,
                        assign : assign
                    });
                }
                
              }
              
            });
            //console.log(railway_mapping);


            swal({
                title: "Are you sure?",
                text: "You want to save changes.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.post("<?php echo base_url("view/CreateForm/railwayMappingSaveChanges"); ?>",{
                    railway_mapping : JSON.stringify(railway_mapping)
                },function(data){
                    // console.log(data);
                    if(data=="200"){
                        swal("Changes Saved Successfully.");
                        location.reload();
                    }else{
                        swal("Something went wrong.");
                    }
                });
                btn.prop('disabled', false);
            });
            
        });

    });
</script>

