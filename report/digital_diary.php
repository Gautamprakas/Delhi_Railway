<?php   
  include('dbconn.php');  

  $category = $_GET['category'];
  $func_name = $_GET['func_name'];
  $disease_name = $_GET['disease_name'];

  if(strpos($disease_name,"2.Down") !== false){
    $disease_name = "2.Down";
  }else{    
    $disease_name = $disease_name;
  }

  if($func_name=="withdisease"){
    $sql = "SELECT * FROM children_list where remark like '$disease_name%' and status='complete' and image!='' group by children_id ORDER BY Rand() limit 60";  
    
  }else{
    $sql = "SELECT * FROM children_list where status='complete' and image!='' group by children_id ORDER BY Rand() limit 60";
  }  

  $result = mysqli_query($connect,$sql);

  $query = "SELECT child_id,diagnosis,child_name FROM child_info WHERE diagnosis!=0";
  $res_diag = mysqli_query($connect_diag,$query);  
?>

<html>
<head>    
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>  

  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Digital Diary</title>  
  <style type="text/css">
    .polaroid {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .bold{
      font-weight: bold;
    }
    img {
      max-width: 100%;
      height: auto;
    }
    .item {
      width: 80%;
      min-height: 80%;
      max-height: auto;;
      margin: 5%;      
    }
    .book::-webkit-scrollbar {
      width: 0 !important 
    }
    .page::-webkit-scrollbar {
      width: 0 !important 
    }
    .book{
      width:75%;
      height:600px;   
      font-family:palatino;
      border: none;
      border-style: outset;
      border-width: 5px 5px 0 0;
      border-top-left-radius: 5px;
      border-top-color: #6f6f6f;
      border-bottom-right-radius: 5px;
      border-right-color: #0e0e0e;
      box-shadow: inset -2px -14px 47px 1px rgba(56,12,12,0.3); 
    }
    .even{
      background:-webkit-gradient(linear, left top, right top, color-stop(0.95, #F9E79F), color-stop(1, #dadada));
      background-image:-webkit-linear-gradient(left, #F9E79F 95%, #dadada 100%);
      background-image:-moz-linear-gradient(left, #F9E79F 95%, #dadada 100%);
      background-image:-ms-linear-gradient(left, #F9E79F 95%, #dadada 100%);
      background-image:-o-linear-gradient(left, #F9E79F 95%, #dadada 100%);
      background-image:linear-gradient(left, #F9E79F 95%, #dadada 100%);
    }

    .odd{
      background:-webkit-gradient(linear, right top, left top, color-stop(0.95, #F9E79F), color-stop(1, #cacaca));
      background-image:-webkit-linear-gradient(right, #F9E79F 95%, #cacaca 100%);
      background-image:-moz-linear-gradient(right, #F9E79F 95%, #cacaca 100%);
      background-image:-ms-linear-gradient(right, #F9E79F 95%, #cacaca 100%);
      background-image:-o-linear-gradient(right, #F9E79F 95%, #cacaca 100%);
      background-image:linear-gradient(right, #F9E79F 95%, #cacaca 100%);
    }
    .page{
      overflow: scroll;
      width:80%;
      height:600px;     
      font-size:100%;
      background-color: #F9E79F;
      text-align:center;      
    }
    .hard{
      width:80%;
      height:600px;   
      background:#1c2d37 !important;
      font-style: italic;
      color:#F9E79F;      
      font-size:200%;
      border-radius: 9px 29px 28px 9px;
      -moz-border-radius: 9px 29px 28px 9px;
      -webkit-border-radius: 9px 29px 28px 9px;
    } 
    .leftBorder{
      position: absolute;
      width: 10%;
      height: 600px;    
      background: -moz-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -webkit-gradient(left top, right top, color-stop(40%, rgba(249,231,159,1)), color-stop(48%, rgba(249,231,159,1)), color-stop(100%, rgba(249,231,159,1)));
      background: -webkit-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -o-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -ms-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: linear-gradient(to right, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a74db', endColorstr='#3b94e8', GradientType=1 );top: 0px;
      left: 0px;
      box-shadow: 1px 1px 2px gray;
    }
    .rightBorder{
      position: absolute;
      width: 10%;
      height: 600px;    
      background: -moz-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -webkit-gradient(left top, right top, color-stop(40%, rgba(249,231,159,1)), color-stop(48%, rgba(249,231,159,1)), color-stop(100%, rgba(249,231,159,1)));
      background: -webkit-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -o-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: -ms-linear-gradient(left, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      background: linear-gradient(to right, rgba(249,231,159,1) 40%, rgba(249,231,159,1) 48%, rgba(249,231,159,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a74db', endColorstr='#3b94e8', GradientType=1 );top: 0px;
      right: 0px;
      box-shadow: 1px 1px 2px gray;
    }
    .page_head{
      font-size: 13px;
      margin: 5%;
      text-transform: uppercase;    
    }
    .page_head_font_color{
      color: #F9E79F;
    }
    .page_img{
      border-radius: 5px;
      margin-left:5%;
    }
    .book_hard_cover{
      color:#F9E79F;
      align-content: center;
      margin-left: 50px;
      margin-top: 90px;
      margin-right: 10px;
      margin-bottom: 10px;
    }
    .book_hard_back{
      color:#F9E79F;
      align-content: center;
      margin-left: 50px;
      margin-top: 50%;
      margin-right: 10px;
      margin-bottom: 10px;
      font-size: 40px;
    }
    .footer_font{
      color: #F9E79F;
      font-size: 12px;      
    }
</style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" class="section-2">
    <div class='preloader'>
      <div class='loaded'>&nbsp;</div>
    </div>
    <div class="site-wrap" id="home-section">
      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>
    </div>

  <div class="container section-2">
    <div class="row justify-content-center mb-5 pb-2">
      <div class="book">
        <div class="hard">
          <div class="book_hard_cover">So,<br/>Here we are </br>with </br>Successful stories of your's...<br/>Let's Begin</div>
          <div style="margin-top: 30%">DIGITAL DIARY</div>
          <div class="leftBorder"></div>
        </div>

        <?php
            while ($row = mysqli_fetch_array($result)){

              $img1 = "http://up.vdsai.com/up_rbsk/assets/children_pic/".$row['image'];
              $img2 = "http://up.vdsai.com/up_rbsk/assets/children_pic/".$row['image2'];

              $final[$row['children_id']]['child_id']     = $row['children_id'];
              $final[$row['children_id']]['child_name']   = $row['children_name'];
              $final[$row['children_id']]['disease_name'] = $row['remark'];
              $final[$row['children_id']]['image']        = $img1;
              $final[$row['children_id']]['image2']       = $img2;
            }

            while ($row_diag = mysqli_fetch_array($res_diag)){
              
              $exp_val = explode("|", $row_diag[1]);
              
              foreach ($exp_val as $value) {
                
                if(strpos($value, $disease_name) !== false){
                  
                  $res_diag_img = mysqli_query($connect_diag,"SELECT child_id,label,media_type,media_url FROM child_media WHERE child_id='$row_diag[0]' and label='full'");                  

                  if(mysqli_num_rows($res_diag_img)>0){

                    $row_diag_img = mysqli_fetch_object($res_diag_img);

                    $img1 = "http://vdsai.com/disease_diagnosis/assets/image/".$row_diag_img->child_id."/full/".$row_diag_img->media_url;
                    $img2 = "";

                    $final[$row_diag_img->child_id]['child_id']     = $row_diag_img->child_id;
                    $final[$row_diag_img->child_id]['child_name']   = $row_diag[2];
                    $final[$row_diag_img->child_id]['disease_name'] = $value;
                    $final[$row_diag_img->child_id]['image']        = $img1;
                    $final[$row_diag_img->child_id]['image2']       = $img2;  
                  }
                  
                }
              }
            }

            foreach ($final as $value) {
            ?>
              <div class="page">
                <div class="section-2" style="margin: 20px;padding: 10px;">
                  <div class="text-center page_head">
                    <h4 class="page_head_font_color"><?php echo $value['disease_name']; ?></h4>
                    <span class="position mb-2 page_head_font_color">Child Name : <?php echo $value['child_name']; ?></span>
                    <div class="page_head_font_color"><p>Previously (Before Treatment)</p></div>
                  </div>
                  <div>
                    <div class="item">
                      <img alt="Child Under Process" onerror="this.onerror=null; this.src='images/no_img.png'" class="page_img" src="<?php echo $value['image']?>">
                    </div>
                  </div>
                </div>
              </div>

              <div class="page">
                <div class="section-2" style="margin: 20px;padding: 10px;">
                  <div class="text-center page_head">
                    <h4 class="page_head_font_color"><?php echo $value['disease_name']; ?></h4>
                    <span class="position mb-2 page_head_font_color">Child Name : <?php echo $value['child_name']; ?></span>
                    <div class="page_head_font_color"><p>Now (After Treatment)</p></div>
                  </div>
                  <div>
                    <div class="item">
                      <img alt="Child Under Process" onerror="this.onerror=null; this.src='images/no_img.png'" class="page_img" src="<?php echo $value['image2']?>">
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          <div class="hard">
            <div class="book_hard_back">Thank You!</div>
            <div class="rightBorder"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="container">
      <div class="row" style="margin-top: 1%;text-align: center;">
        <div class="col-lg-2"><a href="index.php" class="footer_font">Home</a></div>
        <div class="col-lg-2"><a href="blog.php" class="footer_font">Our Blog</a></div>      
        <div class="col-lg-2"><a href="rbsk.php" class="footer_font">UP RBSK</a></div>
        <div class="col-lg-2"><a href="index.php#About_us" class="footer_font">About Us</a></div>      
        <div class="col-lg-2"><a href="index.php#Contact_us" class="footer_font">Contact Us</a></div>
        <div class="col-lg-2"><a href="Register_category.php" class="footer_font">Register</a></div>
      </div>
    </div> -->
  
<script src="js/jquery/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/turn.js"></script>
<script src="js/turn.min.js"></script>
<script type="text/javascript">
$(window).ready(function(){
  $('.book').turn({
    display:'double',
    acceleration:true,
    gradients: !$.isTouch,
    elevation:50,
    autoCenter: true
  });
});

$(window).bind('keydown', function(e){
  if(e.keyCode==37)
    $('.book').turn('previous');
  else if(e.keyCode==39)
    $('.book').turn('next');
});
</script>
<script type="text/javascript">
    $(window).load(function() {
    $(".preloader").fadeOut("slow");
  });
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</body>
</html>