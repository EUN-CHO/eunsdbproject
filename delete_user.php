<?php
include("../storescripts/connect_to_mysql.php"); 

session_start();
if(isset($_SESSION["manager"])!=""){
	header("location: admin_index.php");
	exit();
}

?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
 
$id = $_GET['id'];
	mysqli_query($con, "DELETE FROM users WHERE id = '$id' LIMIT 1");

	mysqli_close($con);
	header("Location: user_view_list.php");

?>