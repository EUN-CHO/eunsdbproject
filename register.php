<?php
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: user_index.php");
}

include("../storescripts/connect_to_mysql.php"); 

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 4) {
        $error = true;
        $password_error = "Password must be minimum of 4 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $successmsg = "Successfully Registered! You may LOGIN. Enjoy your shopping :) ";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>E.CHO Store User Register Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align='left' class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 well">
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
						<fieldset>
							<legend>Sign Up</legend>

							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
								<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
							</div>

							<div class="form-group">
								<label for="name">Email</label>
								<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
								<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
							</div>

							<div class="form-group">
								<label for="name">Password</label>
								<input type="password" name="password" placeholder="Password" required class="form-control" />
								<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
							</div>

							<div class="form-group">
								<label for="name">Confirm Password</label>
								<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
								<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
							</div>

							<div class="form-group">
								<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
							</div>
						</fieldset>
					</form>
					<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
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