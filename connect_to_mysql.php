<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "echo_mystore";

//mysql_connect("$host", "$username", "$password") or die("Connection Failure");
//mysql_select_db("$db_name") or die("NO database");

//echo"SUCCESSFUL CONNECTION!"

$con = mysqli_connect("$host","$username","$password","$db_name");

// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>