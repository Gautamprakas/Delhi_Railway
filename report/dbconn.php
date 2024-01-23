<?php
	$dbusername = "vdsai_sam";$dbpass = "Vdai@1234db#";$dbhost1 = "192.168.0.106";$dbhost2 = "192.168.0.107";

	$con = mysqli_connect("$dbhost1","$dbusername","$dbpass","vdai_website");
  	$conn = mysqli_connect("$dbhost1","$dbusername","$dbpass","trace4security_report");
	$connect = mysqli_connect("$dbhost2","$dbusername","$dbpass","vdsai_up_rbsk_agra");
	$connect_diag = mysqli_connect("$dbhost1","$dbusername","$dbpass","disease_diagnosis");

	mysqli_set_charset($con, 'utf8');
	mysqli_set_charset($conn, 'utf8');
	mysqli_set_charset($connect, 'utf8');
  	mysqli_set_charset($connect_diag, 'utf8');
?>