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
					<form method="post" action="validate.php"> 
						<fieldset>
							<legend>LOGIN as User</legend>

							<div class="form-group">
								<label for="name">Email</label>
								<br />
								<input type="text" id="email" name="email" placeholder="Your Email" required class="form-control" />
							</div>

							<div class="form-group">
								<label for="name">Password</label>
								<br />
								<input type="password" id="password" name="password" placeholder="Your Password" required class="form-control" />
							</div>

							<div class="form-group">
								<br />
								<tr><td colspan="2" align="left">&nbsp;</td></tr>
								<br />
								<input type="submit" name="login" value="Login" />
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