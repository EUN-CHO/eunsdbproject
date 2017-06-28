<?php


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