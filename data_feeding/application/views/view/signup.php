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

    <link rel="stylesheet" href="<?php echo base_url("assets/layout/plugins/jQuery-Plugin-For-Floating-Social-Share-Contact-Sidebar/css/contact-buttons.css"); ?>">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
             
            /* body{
                background: linear-gradient(to right,#607d8b, #7ea7bb, #607d8b);
             }*/

             
             .card{
                width: 96%;
                margin: auto;
                box-shadow: 0px 2.5px 30px black;
                 background: rgba(255, 255, 255, 0.95);
             }
             .form-control{
                background: rgba(255, 255, 255, 0.2);
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
               /* background: url("<?php //echo base_url("assets/vdsai.png"); ?>");*/
               background: url("<?php echo base_url("assets/background.jpg"); ?>");
               /* Full height */
  height: 100%;
background-size: 100% 900px;
background-color: ;
  /* Center and scale the image nicely */
             }

             
    </style>
</head>
<body class="login-page" >
    <div class="login-box">
        <div class="logo" >
            <a href="javascript:void(0);" style="color: black;"><b><?php echo strtoupper(LOGO); ?></title></b></a> 
            <small style="color: black;"><b><?php echo strtoupper(PROJECT_NAME); ?></b></small>
        </div>
        <div class="card">
            <div class="body">
                <form  action="#" method="POST" autocomplete="off" target="_self">
                    
                    
                    <div class="msg">Software Login</div>
    
                    <h6 style="color: red;text-align: center;">
                        <noscript>
                             Please Enable JavaScript.
                             <a href="https://www.enable-javascript.com/" target="_blank">Click Here</a>
                        </noscript>
                        <?php if($authFail = $this->session->flashdata('authFail')) echo $authFail; ?>
                        <span id="error"></span>
                    </h6>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" placeholder="Login Id" required>
                        </div>
                    </div>

                  
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password"  class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    

                    <div class="row">
                        <!--<div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>-->
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" id="actsubmit" type="submit">Login</button>
                        </div>
                    </div>
                </form>
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
    <script src="<?php echo base_url("assets/layout/plugins/jQuery-Plugin-For-Floating-Social-Share-Contact-Sidebar/js/jquery.contact-buttons.js"); ?>"></script>

</body>
<script>

    /*$.contactButtons({
      effect  :'slide-on-scroll',
      buttons : {
        'facebook':   { class:'facebook', use:true, link:'', extras:'target="_blank"' },
        'linkedin':   { class:'linkedin', use:true, link:'' },
        'google':     { class:'gplus',    use:true, link:'' },
        'phone':      { class:'phone separated',    use:true, link:'9936785057' },
        'email':      { class:'email',    use:true, link:'vdaibiosec@gmail.com' }
      }
    });*/

    $("form").on("submit", function (e) {
        e.preventDefault();
        $("#actsubmit").hide();
        var obj = {
            "mobile" : $("input[name=name]").val(),
            "password" : $("input[name=password]").val()
        }

        $.ajax({
          type: "POST",
          url: "http://localhost/trace4security/v3/api/auth/login",
          data: JSON.stringify(obj),
          success: function(msg){
               obj = msg;
               if( obj.status == 200 ){
                $.post("<?php echo base_url("survey_controller/set_signup"); ?>",{
                    mobile:$("input[name=name]").val(),
                    name:obj.data.id,
                    form_id:1589285939267
                },function(data){
                    window.location.href = '<?php echo base_url("Survey_controller/feedback"); ?>';
                });
                
               }else{
                alert("Server Error");
               }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            $("#actsubmit").show();
            obj = JSON.parse(XMLHttpRequest.responseText);
            $("#error").html(obj.error);
          }
        });
    });
</script>
</html>