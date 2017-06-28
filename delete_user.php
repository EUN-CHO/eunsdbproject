<?php
include("../storescripts/connect_to_mysql.php"); 

session_start();
if(isset($_SESSION["manager"])!=""){
	header("location: admin_index.php");
	exit();
}

/*
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 

include("../storescripts/connect_to_mysql.php"); 

$mysql = "SELECT id FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1";
	
$result = mysqli_query($con, $mysql);
$existCount = mysqli_num_rows($result);
		
if ($existCount == 0) {
	 echo "You are not an existing manager.";
     exit();
}
*/
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
 
$id = $_GET['id'];
	mysqli_query($con, "DELETE FROM users WHERE id = '$id' LIMIT 1");

	mysqli_close($con);
	header("Location: user_view_list.php");

?>