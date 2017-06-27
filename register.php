<?php
ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
	header("Location: user_index.php");
}

include("../storescripts/connect_to_mysql.php"); 

$error = false;

if ( isset($_POST['btn-signup']) ){
  
  // clean user inputs to prevent sql injections
	$name = trim($_POST['name']);
	$name = strip_tags($name);
  	$name = htmlspecialchars($name);
  
  	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);
  
	$pw = trim($_POST['pass']);
	$pw = strip_tags($pw);
	$pw = htmlspecialchars($pw);
  
  // basic name validation
	if (empty($name)){
		$error = true;
		$nameError = "Enter full name.";
	} else if (!preg_match("/^[a-zA-Z ]+$/",$name)){
		$error = true;
		$nameError = "Enter only alphabets, space.";
	}
  
  //basic email validation
	if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
		$error = true;
		$emailError = "Enter a valid email address.";
  	} else{
   // check email exist or not
		$query = "SELECT email FROM user WHERE email='$email'";
		$result = mysqli_query($con, $query);
		$count = mysqli_num_rows($result);
		if($count!=0){
			$error = true;
			$emailError = "Email is already used. Try another email.";
   		}
	}
  // password validation
  	if (empty($pw)){
   		$error = true;
   		$pwError = "Enter a password.";
  	} else if(strlen($pw) < 4){
   		$error = true;
   		$pwError = "Password needs atleast 4 characters.";
  	}
  
  // password encrypt using SHA256();
  	$password = hash('sha256', $pw);
  
  // if there's no error, continue to signup
  	if( !$error ){
   		$sql = "INSERT INTO user(username,email,password) VALUES('$name','$email','$password')";
   		$res = mysqli_query($con, $sql);
    
   		if ($res){
			$errTyp = "success";
			$errMSG = "Sucessfully SIGNED UP! You can LOGIN. Enjoy your shopping :) ";
			unset($name);
			unset($email);
			unset($pw);
		} else{
			$errTyp = "danger";
			$errMSG = "ERROR occurred!!! Please SIGN UP again later."; 
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
		<div align="left" class="container">
			<div id="login-form">
			    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
     				<div class="col-md-12">
        				<div class="form-group">
             				<h2 class="">Sign Up</h2>
           				</div>
        			<div class="form-group">
             			<hr />
           			</div>
            
            		<?php
					if ( isset($errMSG) ) {
    				?>
    				<div class="form-group">
            			<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    						<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                		</div>
             		</div>
                	<?php
   					}
   					?>
            
            		<div class="form-group">
             			<div class="input-group">
               				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             				<input type="text" name="name" class="form-control" placeholder="Enter Your Full Name" maxlength="50" value="<?php echo $name ?>" />
               	 		</div>
                			<span class="text-danger"><?php echo $nameError; ?></span>
            		</div>
            
            		<div class="form-group">
             			<div class="input-group">
                			<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             				<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                		</div>
                			<span class="text-danger"><?php echo $emailError; ?></span>
            		</div>
            
            		<div class="form-group">
             			<div class="input-group">
                			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             				<input type="password" name="pass" class="form-control" placeholder="Enter Your Password" maxlength="15" />
                		</div>
                			<span class="text-danger"><?php echo $pwError; ?></span>
            		</div>
            
            		<div class="form-group">
             			<hr />
            		</div>
            
            		<div class="form-group">
             			<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            		</div>
            
            		<div class="form-group">
             			<hr />
            		</div>        
        			</div>
    			</form>
    		</div> 
		</div>
	</div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>