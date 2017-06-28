<?php 
session_start();
if (isset($_SESSION["manager"])!="") {
    header("location: admin_index.php"); 
    exit();
}

if (isset($_POST['login'])) {
	include("../storescripts/connect_to_mysql.php");
    $manager = $_POST['username'];
    $password = $_POST['password'];
	
    $result = mysqli_query($con, "SELECT id FROM admin WHERE username = '" . $manager. "' and password = '" . $password . "'");
	$n = $result->num_rows;
	
    if ($n != 0) {
		
		echo "<script language='javascript' type='text/javascript'> location.href='http://localhost/DBproj/storeadmin/admin_index.php' </script>";
        
    } else {
        $errormsg = "Invalid Username or Password!!!";
    }
}
?>

<!doctype html>
<html><head>
<meta charset="UTF-8">
<title>E.CHO Store Manager Login Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="center" class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 well">
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
						<fieldset>
							<legend>LOGIN as Manager</legend>

							<div class="form-group">
								<label for="name">Manager's username</label>
								<br />
								<input type="text" name="username" placeholder="Your Username" required class="form-control" />
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