<!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery/jquery.min.js");?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap/js/bootstrap.js");?>"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap-select/js/bootstrap-select.js");?>"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-slimscroll/jquery.slimscroll.js");?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/node-waves/waves.js");?>"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-countto/jquery.countTo.js");?>"></script>

    <!-- Morris Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/raphael/raphael.min.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/morrisjs/morris.js");?>"></script>

    <!-- ChartJs -->
    <script src="<?php echo base_url("assets/layout/plugins/chartjs/Chart.bundle.js");?>"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/flot-charts/jquery.flot.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/flot-charts/jquery.flot.resize.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/flot-charts/jquery.flot.pie.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/flot-charts/jquery.flot.categories.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/plugins/flot-charts/jquery.flot.time.js");?>"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-sparkline/jquery.sparkline.js");?>"></script>

     <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/sweetalert/sweetalert.min.js"); ?>"></script>
    
      <!-- Google Maps API Js -->
    <!--<script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>-->

    <!-- GMaps PLugin Js -->
    <!--<script src="<?php //echo base_url("assets/layout/plugins/gmaps/gmaps.js"); ?>"></script>
    <script src="<?php //echo base_url("assets/layout/js/pages/maps/google.js"); ?>"></script>-->

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/charts/chartjs.js");?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/index.js");?>"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url("assets/layout/js/demo.js");?>"></script>


     <script>
        jQuery(document).ready(function(){
            /*lineGraph();
            initDonutChart();*/
            

            $.post("<?php echo  base_url("incidence/getIncidenceForDashboard"); ?>",
            {},
            function(data){
                console.log(data);
                var respone = JSON.parse(data);
                if(respone.status_code == "200"){
                    
                    $('#newIncidence').countTo({from: 0, to: respone.result.newIncidence, speed: 1000, refreshInterval: 50});
                    $('#underProcess').countTo({form: 0, to: respone.result.underProcess, speed: 1000, refreshInterval: 50});
                    $("#complete").countTo({from: 0, to: respone.result.complete, speed: 1000, refreshInterval: 50});
                    $("#totalIncidence").countTo({from: 0, to: respone.result.total, speed: 1000, refreshInterval: 50});

                    li = '<li>'+respone.result.sparkline.data.curDateCount.date+
                         '<span class="pull-right"><b>'+respone.result.sparkline.data.curDateCount.count+'</b><small>incidence</small></span></li>'+
                         '<li>'+respone.result.sparkline.data.oldDate1Count.date+
                         '<span class="pull-right"><b>'+respone.result.sparkline.data.oldDate1Count.count+'</b><small>incidence</small></span></li>'+
                         '<li>'+respone.result.sparkline.data.oldDate2Count.date+
                         '<span class="pull-right"><b>'+respone.result.sparkline.data.oldDate2Count.count+'</b><small>incidence</small></span></li>';
                    $(".dashboard-stat-list").append(li);
                    initSparkline(respone.result.sparkline.sparklineArr);
                    initDonutChart(respone.result.donutArr);
                    lineGraph(respone.result.lineGraph.lineGraphLabel,
                              respone.result.lineGraph.lineGraphNew,
                              respone.result.lineGraph.lineGraphUndPro,
                              respone.result.lineGraph.lineGraphCom);
                    var i=0;
                    $.each(respone.result.yourAction, function (index, value) {
                        console.log(value);
                        if(value.action == "pending"){
                            row = ' <tr>'+
                                '<td>'+(++i)+'</td>'+
                                '<td><button class="btn btn-info waves-effect incid" value="'+value.incidence_id+'" >'+value.incidence_id+'</button></td>'+
                                '<td>'+value.incidence_type+'</td>'+
                                '<td><span class="label bg-light-blue">Pending</span></td>'+
                                '<td><div class="class="btn-group>'+
                                     '<button class="btn btn-success btn-circle waves-effect action" value="complete">'+
                                     '<i class="material-icons">done</i></button>'+
                                     '<button class="btn btn-warning btn-circle waves-effect action" value="respond">'+
                                     '<i class="material-icons">warning</i></button></div></td>'+
                                '</tr>';
                            }else{
                                row = ' <tr>'+
                                '<td>'+(++i)+'</td>'+
                                '<td><button class="btn btn-info waves-effect incid" value="'+value.incidence_id+'" >'+value.incidence_id+'</button></td>'+
                                '<td>'+value.incidence_type+'</td>'+
                                '<td><span class="label bg-orange">In Progress</span></td>'+
                                '<td><div class="class="btn-group>'+
                                     '<button class="btn btn-success btn-circle waves-effect action" value="complete">'+
                                     '<i class="material-icons">done</i></button>'+
                                     '<button class="btn btn-warning btn-circle waves-effect action" value="respond">'+
                                     '<i class="material-icons">warning</i></button></div></td>'+
                                '</tr>';
                            }
                        $("table>tbody").append(row);
                    });

                } else {
                    console.log("servert error");
                }
            });
        });
    </script>


     <script>

        function lineGraph( lable1 , new1, under, complete){
             config = {
                type: 'line',
                data: {
                    labels: lable1,
                    datasets: [{
                        label: "New Incidence",
                        data: new1,
                        borderColor: 'rgba(0, 188, 212, 0.75)',
                        backgroundColor: 'rgba(0, 188, 212, 0.3)',
                        pointBorderColor: 'rgba(0, 188, 212, 0)',
                        pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                        pointBorderWidth: 1
                    }, {
                            label: "Under Process Incidence",
                            data: under,
                            borderColor: 'rgba(255,193,7, 0.75)',
                            backgroundColor: 'rgba(255,193,7, 0.3)',
                            pointBorderColor: 'rgba(255,193,7, 0)',
                            pointBackgroundColor: 'rgba(255,193,7, 0.9)',
                            pointBorderWidth: 1
                        },
                     {
                            label: "Compplete Incidence",
                            data: complete,
                            borderColor: 'rgba(76,175,80, 0.75)',
                            backgroundColor: 'rgba(76,175,80, 0.3)',
                            pointBorderColor: 'rgba(76,175,80, 0)',
                            pointBackgroundColor: 'rgba(76,175,80, 0.9)',
                            pointBorderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    legend: false,
                     scales: {
                        yAxes: [{
                            ticks: {
                                fixedStepSize: 1
                            }
                        }]
                    }
                }
            }

           new Chart(document.getElementById("line_chart").getContext("2d"), config);
        }
        
       function initSparkline( data ) {
            $(".sparkline").each(function () {
                var $this = $(this);
                $this.text(data.join());
                $this.sparkline('html', $this.data());
            });
        }

        function initDonutChart( data1 ) {
            Morris.Donut({
                element: 'donut_chart',
                data: data1,
                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)', 'rgb(121,85,72)', 'rgb(63,81,181)'],
                formatter: function (y) {
                    return y + '%'
                }
            });
        }


        function showHtmlMessage() {
            swal({
                title: "HTML <small>Title</small>!",
                text: "A custom <span style=\"color: #CC0000\">html<span> message.",
                html: true
            });
        }

    </script>

    <script>
  jQuery(document).ready(function(){

      $("#dashtable").on('click','.incid',function(){

        incid = $(this).text();

        $.post("<?php echo base_url("incidence/getRelatedOfficerDetails"); ?>",
        {
          incidence_id : incid
        },
        function(data){
            
             swal({
                title: "Progress Details",
                text: data,
                html: true
            });

        });
      });


      $("#dashtable").on('click','.action',function(){

        row = $(this).closest("tr");
        office_id    = '<?php echo $this->office_id;?>';
        location_id  = '<?php echo $this->location_id;?>';
        emp_id       = '<?php echo $this->user_id;?>';
        incidence_id = row.find(".incid").val();
        status       = $(this).val();

        if(status == "complete")
            text = "Incidence completed?";
        else
            text = "Incidence In Progress?";

        swal({
            title: "Confirmation!..."+text,
            /*text: text,*/
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
             $.post("<?php echo base_url("incidence/uploadFeedback"); ?>",
            {
              office_id : office_id,
              location_id : location_id,
              emp_id : emp_id,
              incidence_id : incidence_id,
              status : status
            },
            function(data){
                swal("Success","Action Saved Successfully","success");
                row.remove();
            });
        });


      });
  });
</script>


