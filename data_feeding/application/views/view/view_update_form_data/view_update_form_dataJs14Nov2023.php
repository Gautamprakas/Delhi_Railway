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


        $("body").on("click","button.status_action",function(){
            btn = $(this)
            btndiv = btn.closest('div');
            btndiv.find("button.status_action").prop('disabled', true);
            var req_id = $(this).val();
            var status = $(this).attr("data-status");
            var qty = $(this).closest('div').find("input[name=qty]").val();
            var maxqty = $(this).closest('div').find("input[name=qty]").attr('data-maxqty');
            //console.log(parseInt(qty),parseInt(maxqty));

            if(status=='Verified' && (qty==='' || /^[0-9]+$/.test(qty) === false || parseInt(qty) > parseInt(maxqty))){
                swal("Please Enter Valid Released Quantity.");
                btndiv.find("button.status_action").prop('disabled', false);
                return;
            }

            swal({
                title: "Are you sure?",
                text: "You want to "+status+ " the data.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.post("<?php echo base_url("view/CreateForm/updateStatusOfReq2"); ?>",{
                    req_id:req_id,
                    status:status,
                    qty:qty
                },function(data){
                    if(data=="200"){
                        swal("Data "+status+".");
                        //location.reload();
                        btndiv.html("<span class='font-bold col-teal'>Verified</span>");
                    }else{
                        swal("Something went wrong.");
                    }
                    btndiv.find("button.status_action").prop('disabled', false);
                });
            });
        });

    });
</script>

