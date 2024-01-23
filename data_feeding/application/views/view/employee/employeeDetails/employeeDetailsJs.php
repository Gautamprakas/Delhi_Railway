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

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/tables/jquery-datatable.js"); ?>"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url("assets/layout/js/demo.js"); ?>"></script>




<!--Logic JS-->

<script type="text/javascript">
    
    jQuery(document).ready(function(){           
         
           $.get("<?php echo base_url("Employee/getEmployeesDetails"); ?>",function(data){
                      
                      var response = jQuery.parseJSON(data);

                      if( $.fn.DataTable.isDataTable( '#example' ) ) {
                          $('#example').DataTable().destroy();
                          $('#example').empty();
                      }; 

                      if(response.status_code == "200"){

                        var arr = response.result;
                        var columns = [];
                        var j = 0;

                        columns[j] = {"title" : "Sno","data":"Sno",render: function (data, type, row, meta)             { return meta.row + meta.settings._iDisplayStart + 1; }
                                     };

                        for(var key in arr[0]){
                            columns[++j] = {"title" : key,"data":key};
                        }

                        json = {
                                   "data":sanitizeData(arr),
                                   "columns":sanitizeColumns(columns),
                                   "destroy": true, 
                                   "dom" : "<'row'<'col-sm-3'l><'col-sm-5 'B><'col-sm-3'f>>" +
                                            "<'row'<'col-sm-12'tr>>" +
                                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                                   "buttons" : [
                                                  { "extend": 'copy', "text":'Copy' },
                                                  { "extend": 'excel', "text":'Excel' },
                                                  { "extend": 'csv', "text":'CSV' },
                                                  { "extend": 'pdf', "text":'PDF' },
                                                  { "extend": 'print', "text":'Print' }
                                              ],
                                   "scrollX": false,
                                   "aLengthMenu": [[10 , 20, 50, 100, -1], [10,20, 50, 100, "All"]],
                                   "pageLength": 10,
                                   "colReorder" : true,
                                   "columnDefs" : [{
                                                     "render" : function(data,type,row){
                                                                   if(data.toLowerCase() == "yes"){
                                                                    return "<button class='btn btn-success waves-effect reg'>"+data+"</button>";
                                                                   }else{
                                                                    return "<button class='btn btn-danger waves-effect reg'>"+data+"</button>";
                                                                   }
                                                                },
                                                      "targets" : 6         
                                                   }]

                                };

                      var tab= $('#example').dataTable( json );
                      $('table>thead').addClass("<?php echo MY_CLASS; ?>");

                      }else{
                        console.log("server error");
                        return false;
                      }

           });
     
    });
</script>


<script type="text/javascript">
    
      function sanitizeData(jsonArray) {
        var newKey;
        jsonArray.forEach(function(item) {
            for (key in item) {
                newKey = key.replace(/\s/g, '').replace(/\./g, '');
                if (key != newKey) {
                    item[newKey]=item[key];
                    delete item[key];
                }     
            }    
        })    
        return jsonArray;
    }            
    //remove whitespace and dots from data : <propName> references
    function sanitizeColumns(jsonArray) {
        var dataProp;
        jsonArray.forEach(function(item) {
            dataProp = item['data'].replace(/\s/g, '').replace(/\./g, '');
            item['data'] = dataProp;
        })
        return jsonArray;
    }    

 
</script>


<script type="text/javascript">
  
  jQuery(document).ready(function(){

    $("table").on('click','.reg',function(){
      var btnObj = $(this);
      var emp_id = btnObj.closest('tr').find('td:eq(1)').text();
      $.post("<?php echo base_url('Employee/deregister'); ?>",{uid:emp_id},function(data){
        var response = jQuery.parseJSON(data);
        if(response.status_code == "200"){
          btnObj.removeClass('btn-success');
          btnObj.html("no");
          btnObj.addClass('btn-danger');
        }
      });
    });
  });
</script>

