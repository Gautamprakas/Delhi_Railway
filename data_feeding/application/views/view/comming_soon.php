<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo strtoupper(PROJECT_NAME); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url("assets/layout/plugins/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url("assets/layout/plugins/node-waves/waves.css"); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url("assets/layout/plugins/animate-css/animate.css"); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url("assets/layout/css/style.css"); ?>" rel="stylesheet">

    <style type="text/css">
             
            /* body{
                background: linear-gradient(to right,#607d8b, #7ea7bb, #607d8b);
             }*/

             
             .card{
                width: 96%;
                margin: auto;
                box-shadow: 0px 2.5px 30px black;
             }
             .logo{
                text-shadow: 0px 2.5px 30px black;
                text-transform: uppercase;
                letter-spacing: 1px;
             }
             .login-page .login-box .logo small {
                margin-top: 10px;
                letter-spacing: 1px;
                background-repeat: no-repeat;
             }

             .login-page{
                background: url("<?php echo base_url("assets/background.jpg"); ?>");
                background-position: center;
             }

             
    </style>
</head>
<body class="login-page" >
    <div class="login-box">

        <div class="card">
            <div class="body">
                <h2 style="color: red"> <a href="<?php echo base_url("survey_controller/unset_all"); ?>" class="btn btn-danger pull-right">logout</a></h2>
                <a href="<?php echo base_url("survey_controller/feedback"); ?>"><h4>Click For New Registration</h4></a>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url("assets/layout/plugins/bootstrap/js/bootstrap.js"); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/node-waves/waves.js"); ?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url("assets/layout/plugins/jquery-validation/jquery.validate.js"); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url("assets/layout/js/admin.js"); ?>"></script>
    <script src="<?php echo base_url("assets/layout/js/pages/examples/sign-in.js"); ?>"></script>
</body>

</html>