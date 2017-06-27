<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "echo_mystore";

mysql_connect("$host", "$username", "$password") or die("Connection Failure");
mysql_select_db("$db_name") or die("NO database");

echo"SUCCESSFUL CONNECTION!"
?>