<?php

/*
$host = "localhost";
$username = "root";
$password = "";
$db_name = "echo_mystore";

$con = mysqli_connect("$host","$username","$password","$db_name");

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
*/
//else{
	//echo "mySQL database connected!";
//}

error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$host = "localhost";
$username = "root";
$password = "";
$db_name = "echo_mystore";

$con = mysqli_connect("$host","$username","$password");
$dbcon = mysqli_select_db($con,"$db_name");
 
 if ( !$con ) {
  die("Connection failed : " . mysqli_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysqli_error());
 }

?>