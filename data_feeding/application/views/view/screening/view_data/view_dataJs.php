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
    <script src="<?php echo base_url("assets/layout/js/pages/tables/jquery-datatable.js"); ?>"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url("assets/layout/js/demo.js"); ?>"></script>




<!--Logic JS-->

<script type="text/javascript">
    
    /*jQuery(document).ready(function(){           

           $.post("<?php //echo base_url("Incidence/getIncidenceDetails"); ?>",
            {
              status : '<?php //echo urldecode($this->uri->segment(3)); ?>'
            },function(data){
                      console.log(data);
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
                                                  { "extend": 'copy', "text":'Copy',  exportOptions: {
                                                        stripHtml: true
                                                      }  },
                                                  { "extend": 'excel', "text":'Excel',  exportOptions: {
                                                        stripHtml: true
                                                      }  },
                                                  { "extend": 'csv', "text":'CSV',  exportOptions: {
                                                        stripHtml: true
                                                      }  },
                                                  /*{ "extend": 'pdf', "text":'PDF', exportOptions: {
                                                        stripHtml: true
                                                      } },*/
                                                  /*{ "extend": 'print', "text":'Print' ,
                                                    exportOptions: {
                                                        stripHtml: true,
                                                        format: {
                                                          body: function ( inner, coldex, rowdex ) {
                                                            if (inner.length <= 0) return inner;
                                                            var el = $.parseHTML(inner);
                                                            var result='';
                                                            $.each( el, function (index, item) {
                                                              if (item.nodeName == '#text') result = result + item.textContent;
                                                              else if (item.nodeName == 'SUP') result = result + item.outerHTML;
                                                              else if (item.nodeName == 'STRONG') result = result + item.outerHTML;
                                                              else if (item.nodeName == 'IMG') result = result + item.outerHTML;
                                                              else result = result + item.innerText;
                                                            });
                                                            return result;
                                                          }
                                                        }
                                                      }
                                                   }
                                              ],
                                   "scrollX": false,
                                   "aLengthMenu": [[10 , 20, 50, 100, -1], [10,20, 50, 100, "All"]],
                                   "pageLength": 10,
                                   "colReorder" : true,
                                  "columnDefs" : [/*{
                                                     "render" : function(data,type,row){
                                                                   if(data != "" && data != null ){
                                                                    return "<img src='<?php //echo base_url();?>"+data+"' width='80' height='80' alt='' />"
                                                                  } else {
                                                                    return "";
                                                                  }
                                                                },
                                                      "targets" : 9        
                                                   },*/
                                                   /*{
                                                     "render" : function(data,type,row){
                                                                   
                                                                    return "<button class='btn btn-danger waves-effect incid' value='"+data+"' >"+data+"</button>";
                                                                  
                                                                  
                                                                },
                                                      "targets" : 1        
                                                   }
                                                   ],
                                  'rowCallback': function(row, data, index){
                                        
                                      cell = $(row).find('td:eq(3)');
                                       if(cell.text().toLowerCase() == "pending"){

                                        $(row).css({"text-transform":"capitalize"});
                                        $(row).addClass('info');

                                       } else if(cell.text().toLowerCase() == "under process"){

                                       $(row).css({"text-transform":"capitalize"});
                                       $(row).addClass('warning');

                                       }if(cell.text().toLowerCase() == "complete"){

                                        $(row).css({"text-transform":"capitalize"});
                                        $(row).addClass('success');

                                       }
                                  }

                                };

                      var tab= $('#example').dataTable( json );
                      $('table>thead').addClass("<?php //echo MY_CLASS; ?>");

                      }else{
                        console.log("server error");
                        return false;
                      }

           });
     
    });*/
</script>


<script type="text/javascript">
    
      /*function sanitizeData(jsonArray) {
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
    }    */

 
</script>


<script type="text/javascript">
  
  /*jQuery(document).ready(function(){

    $("table").on('click','.reg',function(){
      var btnObj = $(this);
      var emp_id = btnObj.closest('tr').find('td:eq(1)').text();
      $.post("<?php //echo base_url('Employee/deregister'); ?>",{uid:emp_id},function(data){
        var response = jQuery.parseJSON(data);
        if(response.status_code == "200"){
          btnObj.removeClass('btn-success');
          btnObj.html("no");
          btnObj.addClass('btn-danger');
        }
      });
    });
  });*/
</script>


<script>
  /*$('#example tbody').on('click', 'td.details-control', function () {
    var tr = $(this).parents('tr');
    var row = table.row( tr );
 
    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row (the format() function would return the data to be shown)
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
} );*/
</script>



<script>
  /*jQuery(document).ready(function(){

      $("#example").on('click','.incid',function(){

        incid = $(this).text();

        $.post("<?php //echo base_url("incidence/getRelatedOfficerDetails"); ?>",
        {
          incidence_id : incid
        },
        function(data){
            console.log(data);
             swal({
                title: "Progress Details",
                text: "<div style='overflow:scroll;height:350px'>"+data+"</div>",
                html: true
            });

        });
      });
  });*/
</script>

