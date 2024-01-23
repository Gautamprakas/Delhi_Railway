<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

$dbusername = "vdsai_sam";
$dbpass = "Vdai@1234db#";
$dbname = "vdai_website";
$dbhost = "192.168.0.106";
$con = mysqli_connect("$dbhost","$dbusername","$dbpass","$dbname");

//$ip         = get_client_ip();

$datetime   = date("Y-m-d H:i:s");

$fname    = $_POST["fname"];
$lname    = $_POST["lname"];
$email   = $_POST["email"];
$mobile  = $_POST["mobile"];
$thoughts = $_POST["thoughts"];
$ip = $_POST["ip"];
$utype = $_POST["utype"];
$name = $fname." ".$lname;

$data = "Select * from reg_user where name='$name' OR mobile='$mobile' OR email='$email'";
$res = mysqli_query($con,$data);

if (mysqli_num_rows($res)!=0){
	$response["status_code"] = "201";
	echo json_encode($response);
	exit();
}
else{
	$insertQuery = "Insert into reg_user(name,mobile,email,thoughts,datetime,user_ip,utype)values('$name','$mobile','$email','$thoughts','$datetime','$ip','$utype')";
	mysqli_query($con,$insertQuery);
	$response["status_code"] = "200";
	echo json_encode($response);	
	exit();
}

/*function get_client_ip() {
    
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}*/