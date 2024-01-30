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
<script>
jQuery(document).ready(function(){
            var trainNo='';
            var date;
            var time1;
            var time2;
            var coachNo='';
            var status='';
            var workList='';
            var itemList='';
            var workStatus='';
            var Area=''
            // var form_id='';
            var workCategory='';
            $("#selectTrain").on("change",function(){
                let selectedOption = $(this).find('option:selected');
                let dataInfoValue = selectedOption.data('info');
                // console.log(dataInfoValue);
                $("#nameHere").text(dataInfoValue);

            });
            var selectedOption = $("#selectTrain option:selected");
            var username = selectedOption.attr("data-info");
            console.log(username);

    $("#submitTrain").click(function(){
         trainNo=$("#selectTrain").val();
         date=$("#date").val();
         var form_id=$("#date").data("info");
         // console.log(form_id);

         time1=$("#time1").val();
         time2=$("#time2").val();
        if(time1!='' && time2==''){
            alert("Enter correct Time");
            location.reload();
        }
        else if(time2!='' && time1==''){
            alert("Enter correct Time");
            location.reload();
        }
        else{
        var url="<?php echo base_url().'/view/CreateForm/filterWorkOrder/'; ?>"+form_id;

        // console.log(trainNo+date+time1+time2+url);
        $.ajax({

            "url":url,
            "method":"POST",
            "data":{
                "trainNo":trainNo,
                "date":date,
                "time1":time1,
                "time2":time2,
            },
            success:function(response){
                $("#example2").DataTable().destroy();
                // alert(response);
                var data = JSON.parse(response); // Assuming 'response' is your JSON data
                var lengthOfData = Object.keys(data).length;
                var tableBody = document.getElementById('myTableBody');
                tableBody.innerHTML = '';
                var tableCol=16;
                if(form_id=="1690450752274"){
                    tableCol=17;
                }
                //return;
                var j=1;
                if(lengthOfData>0){
                data.forEach((data)=>{
                for(var family_id in data){
                  var baseId="tableID"+j;
                  var newRow = document.createElement('tr');
                  newRow.setAttribute('data-class', '');
                  newRow.className = 'all odd';
                  newRow.setAttribute('role', 'row');
                  for (var i = 1;i<=tableCol; i++) {
                        var newCell = document.createElement('td');
                        newCell.className = 'font-12';
                        newCell.style.textTransform = 'capitalize'; // Applying text transformation
                        newCell.id=baseId+"_"+i;
                        //new cell adding
                        newRow.appendChild(newCell);
                    }
                    tableBody.appendChild(newRow);
                    $("#tableID"+j+"_1").text(j);
                     //
                    if(data.hasOwnProperty(family_id)){
                        // console.log("key is "+family_id);
                        for(var value in data[family_id]){
                            // if(data[family_id].hasOwnProperty(value)){
                                if(value=="1690365766_2"){
                                    // console.log("#tableID"+j+"_2"+data[family_id][value]);
                                    $("#tableID"+j+"_4").text(data[family_id][value]);
                                }else if(value=="1690365766_1"){
                                    $("#tableID"+j+"_2").text(data[family_id][value]);
                                }else if(value=="updated"){
                                    $("#tableID"+j+"_3").text(data[family_id][value]);
                                }else if(value=="coach_type"){
                                    $("#tableID"+j+"_5").text(data[family_id][value]);
                                }
                                else if(value=="1690365766_4"){
                                    $("#tableID"+j+"_6").text(data[family_id][value]);
                                }
                                else if(value=="1690365766_5"){
                                    var workList=data[family_id][value].split("|");
                                    if(workList.length>1){
                                        var work=workList[0].split("-");
                                        if(work.length>1){
                                            $("#tableID"+j+"_7").text(work[1]);
                                        }else{
                                            $("#tableID"+j+"_7").text(workList[0]);
                                        }
                                    }else{
                                        $("#tableID"+j+"_7").text("");
                                    }
                                }
                                else if(value=="1690365766_6"){
                                    $("#tableID"+j+"_8").text(data[family_id][value]);
                                }
                                else if(value=="1690365766B_3"){
                                    $("#tableID"+j+"_10").text(data[family_id][value]);
                                }
                                // if(!(data[family_id].hasOwnProperty("1690365766B_2"))){
                                else if (value=="item_name") {
                                    $("#tableID"+j+"_9").html(data[family_id][value]);
                                }else if (value=="item_quantity") {
                                    $("#tableID"+j+"_10").html(data[family_id][value]);
                                }

                                // }
                                else if(value=="Status"){
                                    $("#tableID"+j+"_12").html(data[family_id][value]);
                                }
                                else if(value=="Rating Status"){
                                    $("#tableID"+j+"_16").html(data[family_id][value]);
                                }
                                else if(value=="1690450752274_2"){
                                    $("#tableID"+j+"_12").text(data[family_id][value]);
                                }else if(value=="Work_Done_Status"){
                                    $("#tableID"+j+"_15").text(data[family_id][value]);
                                }else if(value=="work_code"){
                                    $("#tableID"+j+"_13").text(data[family_id][value]);
                                }else if(value=="warranty_status"){
                                    $("#tableID"+j+"_14").html(data[family_id][value]);
                                }else if(value=="uom"){
                                    $("#tableID"+j+"_11").text(data[family_id][value]);
                                }else if(value=="child_id"){
                                    $("#tableID"+j+"_15").html(data[family_id][value]);
                                }else if(value=="approve_id"){
                                    $("#tableID"+j+"_16").text(data[family_id][value]);
                                }
                            
                                
                                
                        }
                        // console.log(data[family_id]);
                    }
                    j+=1;
                    
                }
            });
                $('#example2').DataTable({
                    dom: 'Bfrtip', // Specify where the buttons will appear
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
                }else{
                    alert("No record Found");
                    location.reload();
                }
            },
            error:function(xhr,status,error){
                //console.log(xhr);

                alert("An error occured "+error);
            }

        });
    }
        
    });
});

</script>


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

            swal({
                title: "Are you sure?",
                text: "You want to "+status+ " the data.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.post("<?php echo base_url("view/CreateForm/updateStatusOfReq"); ?>",{
                    req_id:req_id,
                    status:status
                },function(data){
                    if(data=="200"){
                        swal("Data "+status+".");
                        //location.reload();
                        btndiv.html("<span class='font-bold col-teal'>"+status+"</span>");
                    }else{
                        swal("Something went wrong.");
                    }
                    btndiv.find("button.status_action").prop('disabled', false);
                });
            });
        });

        $("body").on("click","button.status_action_rating",function(){
            btn = $(this)
            btndiv = btn.closest('div');
            btndiv.find("button.status_action_rating").prop('disabled', true);
            var req_id = $(this).val();
            var status = $(this).attr("data-status");
            var rating = $(this).attr("data-rating");
            var familyid = $(this).attr("data-familyid");

            swal({
                title: "Are you sure?",
                text: "You want to give "+rating+ " star rating to the work.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.post("<?php echo base_url("view/CreateForm/updateStatusOfReqRating"); ?>",{
                    req_id:req_id,
                    status:status,
                    rating:rating,
                    family_id:familyid
                },function(data){
                    if(data=="200"){
                        swal("Data "+status+".");
                        //location.reload();
                        btndiv.html("<span class='font-bold'>"+rating+"<i class='material-icons'>star_rate</i></span>");
                    }else{
                        swal("Something went wrong.");
                    }
                    btndiv.find("button.status_action_rating").prop('disabled', false);
                });
            });
        });

    });
</script>

