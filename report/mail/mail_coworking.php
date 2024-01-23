<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require '../mailFunctionHelperCoworking.php';

date_default_timezone_set("Asia/Kolkata");

if( $_SERVER["REQUEST_METHOD"] == "GET" && getMailVerificationValidation($_GET) ){

	$host = "192.168.0.106";
	$user = "vdsai_sam";
	$pwd  = "Vdai@1234db#";
	$db   = "vdai_website";
	$port = "3306";
	
	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
	$ip         = get_client_ip();
	$datetime   = date("Y-m-d H:i:s");

 	$con = mysqli_connect($host,$user,$pwd,$db,$port);

	$v = $_GET["v"];

	$search = "select * from request_visit where vid = '$v'";
    
    $res = mysqli_query($con,$search);
    
    if(mysqli_num_rows($res) > 0){
        
        $adminMail = "vdaibiosec@gmail.com";
 	    $adminPwd  = "Vdai@1234#";
    	$row = mysqli_fetch_assoc($res);

    	if($row["status"] == "NO"){
    		

    		$update = "update request_visit set update_datetime = '$datetime',update_user_agent = '$user_agent', update_user_ip = '$ip',status = 'YES' where vid = '$v' ";
    	    mysqli_query($con,$update);
    		sendMailToAdmin( $adminMail , $adminPwd , $row["name"] , $row["mobile"] , $row["email"] , $row["message"] );
    	}
    	echo "<h1 style='text-align:center;color:green'>ThankYou..</h1>";

    }else{

    	echo "<h1 style='text-align:center;color:red'>Invalid Mail ID</h1>";
    }

    exit();

}else if( $_SERVER["REQUEST_METHOD"] == "POST" && postMailValidation($_POST) ){

	


	$host = "192.168.0.106";
	$user = "vdsai_sam";
	$pwd  = "Vdai@1234db#";
	$db   = "vdai_website";
	$port = "3306";
	
	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
	$ip         = get_client_ip();
	$datetime   = date("Y-m-d H:i:s");

 	$con     = mysqli_connect($host,$user,$pwd,$db,$port);
 	
 	$vid     = hash("sha256",$user_agent.$ip.$datetime);
 	$name    = $_POST["name"];
 	$email   = $_POST["email"];
 	$mobile  = $_POST["mobile"];
 	$message = $_POST["message"];
 	$insertQuery = "Insert into request_visit(vid,name,mobile,email,message,datetime,user_agent,user_ip,status) ".
 	               "values('$vid','$name','$mobile','$email','$message','$datetime','$user_agent','$ip','NO')";

 	mysqli_query($con,$insertQuery);

 	$adminMail = "vdaibiosec@gmail.com";
 	$adminPwd  = "Vdai@1234#";

 	sendConfirmationMail( $adminMail , $adminPwd , $email , $name ,  $vid );
 	$response["status_code"] = "200";
    
    echo json_encode($response);
    exit();

 	

}else{

	exit("<h1>Site is temporarily unavailable due to maintenance</h1>");
}









