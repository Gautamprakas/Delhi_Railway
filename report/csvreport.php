<?php
/*
$handle = fopen("../up_rbsk/assets/report/OverAllReferralReport.csv", "r");

print_r($handle);
var_dump($handle);

$conn=mysqli_connect("192.168.0.106","vdsai_sam","Vdai@1234db#","map_db");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$arr = array();

while(!feof($handle))
{    
    $arrOfCSVLine = fgetcsv($handle);
    
    $division = $arrOfCSVLine[0];
    $district = $arrOfCSVLine[1];
    $block = $arrOfCSVLine[2];
    $team = $arrOfCSVLine[3];
    $center_type = $arrOfCSVLine[4];
    $disease = $arrOfCSVLine[5];
    $refer_center = $arrOfCSVLine[6];
    $refer = $arrOfCSVLine[7];
    $complete = $arrOfCSVLine[8];
    $under_process = $arrOfCSVLine[9];
    $pending = $arrOfCSVLine[10];
    $beo_cdpo_call = $arrOfCSVLine[11];
    $month = $arrOfCSVLine[12];
    $year = $arrOfCSVLine[13];
    $enrolled = $arrOfCSVLine[14];
    $screened = $arrOfCSVLine[15];
    $date = date('Y-m-d h:i:s');

    $sql = "INSERT INTO map_data (division,district,block,team,center_type,disease,refer_center,refer,complete,under_process,pending,beo_cdpo_call,month,year,enrolled,screened,insert_date) VALUES ('$division','$district','$block','$team','$center_type','$disease','$refer_center','$refer','$complete','$under_process','$pending','$beo_cdpo_call','$month','$year','$enrolled','$screened','$date')";
    
    $result1 = mysqli_query($conn,$sql);
      
}
print_r("done");*/
?>