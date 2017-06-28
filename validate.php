<?php
$cookie_name = "loggedin";
include("../storescripts/connect_to_mysql.php");

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$pass = $_POST['password'];
	
	$phash = md5($pass);
	
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$phash';";
	
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	
	if($count==1){
		$cookie_value = $email;
		setcookie($cookie_name, $cookie_value, time()+(180));
		header("Location: personal.php");
	} else{
		echo "INVALID Email or Password!";
	}
}

?>