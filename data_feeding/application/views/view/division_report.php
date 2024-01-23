
 <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes" name="viewport">
    <title>TRACE4SECURITY REPORT</title>
    <!-- Favicon-->
    <link rel="icon" href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/animate-css/animate.css" rel="stylesheet" />

     <!-- Sweetalert Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="http://vdsai.com:81/trace4security/data_feeding/assets/layout/css/themes/all-themes.css" rel="stylesheet" />   <style>
    .myClass{
        background: #254756;
        color: white;
    }
    .dataTables_wrapper .dt-buttons a.dt-button{
       background: #254756;
        color: white;
    }
    .pagination li.active a{
        background: #254756;
        color: white;
    }
    body{
         background: url("http://vdsai.com:81/trace4security/data_feeding/assets/background.jpg");
    }
   </style>
</head>

<body class="theme-blue ls-closed">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
             <noscript>
                 Please Enable JavaScript.
                 <a href="https://www.enable-javascript.com/" target="_blank">Click Here</a> <br> 
                 <a href="http://vdsai.com:81/trace4security/data_feeding/Login">Go Back Login Page</a>      
            </noscript>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a> -->
                <a class="navbar-brand" href="#">
                    <b>TRACE4SECURITY REPORT</b>
                </a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <!--<img src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/images/user.png" width="48" height="48" alt="User" />-->
                </div>
                <div class="info-container">
                    <!--<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </div>
                    <div class="email"></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href=""><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
            <!-- #User Info --><!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                     <!-- <li class="">
                        <a href="" onclick="//return false;">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                                         </li> -->

                  <!--  <li class="">View Data</a>
                               </li>
                        </ul>
                   </li> -->


                     <li class="active">
                        <a href="http://vdsai.com:81/trace4security/data_feeding/view/CreateForm/index">
                            <i class="material-icons">create</i>
                            <span>View Data</span>
                        </a>
                    </li>

                     <li class="">
                        <a href="http://vdsai.com:81/trace4security/data_feeding/view/CreateForm/feedback">
                            <i class="material-icons">create</i>
                            <span>Feed Data</span>
                        </a>
                    </li>

                    


                    <!-- <li class="">
                            <i class="material-icons">mode_edit</i>
                            <span>Change Password</span>
                        </a>
                    </li> -->


                    
                    <li class="">
                        <a href="http://vdsai.com:81/trace4security/data_feeding/view/Login/logout">
                            <i class="material-icons">power_settings_new</i>
                            <span>Logout</span>
                        </a>
                    </li>
                   
                    
                </ul>
            </div> 
            <!-- #Menu --> <!-- Footer --> 
            <div class="legal">
                <div class="copyright">
                    <a href="javascript:void(0);">Technical Support By Unicef</a>
                </div>
                <div class="version">
                    <!--<b>Version: </b> 1.0.5-->
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Create Form -->
                    <small></small>
                </h2>
            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                Total & Warning Case Report
                                <small>(Global = Auraiya Division)</small>
                            </h2>
                        </div>
                        <div class="body" id="chart_div">
                           
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section><!-- Jquery Core Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/node-waves/waves.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/js/admin.js"></script>
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/js/pages/forms/basic-form-elements.js"></script>
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="http://vdsai.com:81/trace4security/data_feeding/assets/layout/js/demo.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
        $this->db = $this->load->database("default",TRUE);
        $map = [];
        $map["Global"] = 1; 
        $data[0] =  ['Location', 'Parent', 'Total (size)', 'Warning', 'Warning (color)'];
        $data[1] =  ['Global',    null,      0,       0,    0];
        $i = 2;
        foreach($this->db->where("block_np !=","Total")->get("form_trace4security_report_temp")->result() as $row){
            $index1 = sprintf("%s_%s",$row->division,"Global");
            if(isset($map[$index1])){
                $data[$map[$index1]][2] += ($row->total_normal + $row->total_warning);
                $data[$map[$index1]][3] += ($row->total_warning);
                $data[$map[$index1]][4] += ($row->total_warning);
                $data[$map[$index1]][3] = 100 - (($data[$map[$index1]][3] * 100) / $data[$map[$index1]][2]);
                $data[1][2] += ($row->total_normal + $row->total_warning);
                $data[1][3] += ($row->total_warning);
                $data[1][4] = $data[1][3];
                $data[1][3] = 100 - (($data[1][3] * 100) / $data[1][2]);
            }else{
                $map[$index1] = $i;
                $i++;
                $data[$map[$index1]][0] = "DIVISION : ".strtoupper($row->division);
                $data[$map[$index1]][1] = "Global";
                $data[$map[$index1]][2] = ($row->total_normal + $row->total_warning);
                $data[$map[$index1]][3] = ($row->total_warning);
                $data[$map[$index1]][4] = ($row->total_warning);
                $data[$map[$index1]][3] = 100 - (($data[$map[$index1]][3] * 100) / $data[$map[$index1]][2]);
                $data[1][2] = ($row->total_normal + $row->total_warning);
                $data[1][3] = ($row->total_warning);
                $data[1][4] = $data[1][3];
                $data[1][3] = 100 - (($data[1][3] * 100) / $data[1][2]);
            }

            $index2 = sprintf("%s_%s",$row->district,$row->division);
            if(isset($map[$index2])){
                $data[$map[$index2]][2] += ($row->total_normal + $row->total_warning);
                $data[$map[$index2]][3] += ($row->total_warning);
                $data[$map[$index2]][4] += ($row->total_warning);
                $data[$map[$index2]][3] = 100 - (($data[$map[$index2]][3] * 100) / $data[$map[$index2]][2]);
            }else{
                $map[$index2] = $i;
                $i++;
                $data[$map[$index2]][0] = "DISTRICT : ".strtoupper($row->district);
                $data[$map[$index2]][1] = "DIVISION : ".strtoupper($row->division);
                $data[$map[$index2]][2] = ($row->total_normal + $row->total_warning);
                $data[$map[$index2]][3] = ($row->total_warning);
                $data[$map[$index2]][4] = ($row->total_warning);
                $data[$map[$index2]][3] = 100 - (($data[$map[$index2]][3] * 100) / $data[$map[$index2]][2]);
            }

            $index3 = sprintf("%s_%s",$row->block_np,$row->district);
            if(isset($map[$index3])){
                $data[$map[$index3]][2] += ($row->total_normal + $row->total_warning);
                $data[$map[$index3]][3] += ($row->total_warning);
                $data[$map[$index2]][4] += ($row->total_warning);
                $data[$map[$index3]][3] = 100 - (($data[$map[$index3]][3] * 100) / $data[$map[$index3]][2]);
            }else{
                $map[$index3] = $i;
                $i++;
                $data[$map[$index3]][0] = "BLOCK : ".strtoupper($row->block_np);
                $data[$map[$index3]][1] = "DISTRICT : ".strtoupper($row->district);
                $data[$map[$index3]][2] = ($row->total_normal + $row->total_warning);
                $data[$map[$index3]][3] = ($row->total_warning);
                $data[$map[$index3]][4] = ($row->total_warning);
                $data[$map[$index3]][3] = 100 - (($data[$map[$index3]][3] * 100) / $data[$map[$index3]][2]);

            }
        }
/*        echo "<pre>";
        print_r($data);*/
    ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['treemap']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(JSON.parse('<?php echo json_encode($data); ?>'));

        tree = new google.visualization.TreeMap(document.getElementById('chart_div'));

        tree.draw(data, {
          minColor: '#f00',
          midColor: '#ddd',
          maxColor: '#0d0',
          headerHeight: 15,
          fontColor: 'black',
          showScale: true,
          generateTooltip: showFullTooltip
        });

        function showFullTooltip(row, size, value) {
            console.log(row);
            console.log(value);
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
                   '<span style="font-family:Courier"><b>' + data.getValue(row, 0) +
                   '</b>, ' + data.getValue(row, 1) + '</span><br>' +
               data.getColumnLabel(2) + ': ' + size + '<br>' +
               data.getColumnLabel(4) + ': ' + data.getValue(row, 4) + ' </div>';
          }

      }
    </script>

</body>
</html>