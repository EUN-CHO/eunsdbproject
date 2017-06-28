<?php
$cookie_name = "loggedin";

if(isset($_COOKIE[$cookie_name])) {
	$cookie_value = $_COOKIE[$cookie_name];
    echo "Welcome!";
	echo '<a href = "user_index.php">Enjoy Shopping!</a>';
	echo '<a href = "user_logout.php">Logout</a>';
	exit();
} else{
	echo "You are not logged in!";
}

?>
