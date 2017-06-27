<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: user_index.php");
	exit();
}
 
//check if form is submitted
if (isset($_POST['login'])) {
	include("../storescripts/connect_to_mysql.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
	$_SESSION['login_user']=$email;
    $result = mysqli_query($con, "SELECT name FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");
	$n = $result->num_rows;
    if ($n != 0) {
		echo $n;
		echo "<script language='javascript' type='text/javascript'> location.href='http://localhost/DBproj/storeuser/user_index.php' </script>";
        //$_SESSION['usr_id'] = $row['id'];
        //$_SESSION['usr_name'] = $row['name'];
        //header("Location: user_index.php");
		//exit();
    } else {
        $errormsg = "Invalid Email or Password!!!";
		//header("Location: register.php");
    }
}
?>

<!doctype html>
<html><head>
<meta charset="UTF-8">
<title>E.CHO Store User Login Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="left" class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 well">
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
						<fieldset>
							<legend>LOGIN as User</legend>

							<div class="form-group">
								<label for="name">Email</label>
								<br />
								<input type="text" name="email" placeholder="Your Email" required class="form-control" />
							</div>

							<div class="form-group">
								<label for="name">Password</label>
								<br />
								<input type="password" name="password" placeholder="Your Password" required class="form-control" />
							</div>

							<div class="form-group">
								<br />
								<input type="submit" name="login" value="Login" class="btn btn-primary" />
							</div>
						</fieldset>
					</form>
					<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
				</div>
			</div>
		</div>
    </div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>