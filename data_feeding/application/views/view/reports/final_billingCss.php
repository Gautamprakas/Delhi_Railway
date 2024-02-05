
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url("assets/layout/plugins/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url("assets/layout/plugins/node-waves/waves.css"); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url("assets/layout/plugins/animate-css/animate.css"); ?>" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url("assets/layout/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"); ?>" rel="stylesheet">

     <!-- Sweetalert Css -->
    <link href="<?php echo base_url("assets/layout/plugins/sweetalert/sweetalert.css"); ?>" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url("assets/layout/plugins/bootstrap-select/css/bootstrap-select.css"); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url("assets/layout/css/style.css"); ?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url("assets/layout/css/themes/all-themes.css"); ?>" rel="stylesheet" />
 <!-- Google Fonts -->
 <style>   
body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      align-content: center;
    }
    th, td {
      padding: 8px;
      text-align: center;
    }
    .additional-info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        #printButton {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
        }
        #printButton.hidden {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            table, table * {
                visibility: visible;
            }
        }
</style> 