<?

$myemail = "lvmclr2750@naver.com";
$mypassword = "1111";

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	if($email == $myemail and $password == $mypassword){
		if(isset($_POST['remember'])){
			setcookie('email', $email, time()+60*60*7);
			setcookie('password', $password, time()+60*60*7);
		}
		session_start();
		$_SESSION['email'] = $email;
		header("Location: user_index.php");
	} else{
		echo"Email or Password is INVLID! <br> Click Here to <a href='user_login.php'> LOGIN again. ";
	}
} else{
	header("Location: user_login.php");
}
?>